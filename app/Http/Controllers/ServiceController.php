<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\ActivityLog;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
 
class ServiceController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $serviceTypes = ServiceType::all();
        return view('service.index', compact('serviceTypes'));
    }
    public function create()
    {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Return the create view
        return view('service.create'); 
    }

    public function store(Request $request)
    {
    try {
        $authUser = auth()->user();
        if (!in_array($authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }

        // Validate the request data
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'request_type' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('service_type_imgs', $filename, 'public_html');
            $encodedFilename = base64_encode($filename);
        } else {
            return back()->withErrors(['photo' => 'No file uploaded']);
        }

        // Create a new ServiceType record
        $srtype = ServiceType::create([
            'photo' => $encodedFilename,
            'request_type' => base64_encode($request->request_type),
            'description' => base64_encode($request->description),
            'user_id' => auth()->user()->id,
        ]);

        // Log the creation activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Created a new Service Type, ' . base64_decode($srtype->request_type)
        ]);

        return redirect()->route('servicetype.adminview')->with('success', 'Service Type created successfully.');
    } catch (QueryException $e) {
        \Log::error('Error occurred while registering service type: ' . $e->getMessage(), [
            'request' => $request->all(),
            'exception' => $e
        ]);

        return redirect()->back()->with('error', 'An error occurred while registering the program.');
    }
}

    public function edit($id)
    {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        $service = ServiceType::findOrFail($id);
        $service->request_type = base64_decode($service->request_type);
        $service->description = base64_decode($service->description);
        $service->photo = base64_decode($service->photo);
        return view('service.edit', [
            'service' => $service,
            'photo' => $service->photo,
            'request_type' => $service->request_type,
            'description' => $service->description,
        ]);
    }
    
    public function update(Request $request, $id)
{
    $authUser = auth()->user();
    if (!in_array($authUser->roles, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'request_type' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $service = ServiceType::findOrFail($id);
    $title = base64_decode($service->request_type);

    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'activity' => 'Edited a service named, ' . $title
    ]);

    // Handle file upload
    $filename = base64_decode($service->photo);
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $oldCoverPath = 'service_type_imgs/' . $filename;

        if ($filename && Storage::disk('public_html')->exists($oldCoverPath)) {
            Storage::disk('public_html')->delete($oldCoverPath);
        }

        $filename = $file->getClientOriginalName();
        $file->storeAs('service_type_imgs', $filename, 'public_html');
    }

    $service->update([
        'photo' => base64_encode($filename),
        'request_type' => base64_encode($request->input('request_type')),
        'description' => base64_encode($request->input('description')),
    ]);

    return redirect()->route('servicetype.adminview')->with('success', 'Service updated successfully.');
}

    public function delete(Request $request, $id)
{
    try {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Fetch the service to be deleted
        $service = ServiceType::findOrFail($id);
        $title = base64_decode($service->request_type);

        // Log the deletion activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Deleted a service type named, '.$title
        ]);

        // Delete the service (soft delete)
        $service->forceDelete();
        return redirect()->route('servicetype.adminview')->with('success', 'Service Type deleted successfully.');
    } catch (\Exception $e) {
        \Log::error('Error deleting service: '.$e->getMessage());

        // Redirect back with error message
        return redirect()->route('servicetype.adminview')->with('error', 'Failed to delete the service types. Please try again.');
    }
}


}
