<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrgyOfficial;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\SKOfficial;


class OfficialController extends Controller
{
    public function indexRes () {
        $authUser = auth()->user();
        if ($authUser->roles === 'user') {
            abort(403, 'Unauthorized');
        }
        $officials = BrgyOfficial::all();
        ActivityLog::create([
            'activity' => 'Visiting List of Official page.',
            'user_id' => auth()->id(),
        ]);
        $colors = ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#343a40', '#6610f2'];
        return view('resident.view-official',compact('officials', 'colors'));
    }
    public function index() {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        $officials = BrgyOfficial::all();
        ActivityLog::create([
            'activity' => 'Visiting List of Official page.',
            'user_id' => auth()->id(),
        ]);
        $colors = ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#343a40', '#6610f2'];
        return view('official.index',compact('officials', 'colors'));
    }
    public function indexSKResident() {
        $authUser = auth()->user();
        if ($authUser->roles === 'user') {
            abort(403, 'Unauthorized');
        }
        $officials = SKOfficial::all();
        ActivityLog::create([
            'activity' => 'Visiting List of Official page.',
            'user_id' => auth()->id(),
        ]);
        $colors = ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#343a40', '#6610f2'];
        return view('resident.view-skofficial',compact('officials', 'colors'));
    }
    public function indexSK() {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        $officials = SKOfficial::all();
        ActivityLog::create([
            'activity' => 'Visiting List of Official page.',
            'user_id' => auth()->id(),
        ]);
        $colors = ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#343a40', '#6610f2'];
        return view('official.sk',compact('officials', 'colors'));
    }

    // Store method for BrgyOfficial
    public function store(Request $request) {
    // Validate incoming request
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contact' => 'required|string|max:20',
        'description' => 'nullable|string|max:500',
        'term' => 'required|string|max:50',
    ], [
        'photo.required' => 'Please upload a photo of the official.', // Custom error message
        'photo.image' => 'The photo must be an image.',
        'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
        'photo.max' => 'The photo must not be greater than 2MB.',
    ]);

    try {
        $path = null; 
        if ($request->hasFile('photo')) {
            // Store the photo using Storage facade
            $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = 'official_photos/' . $photoName; // Path where photo will be stored
            Storage::disk('public_html')->putFileAs('official_photos', $request->file('photo'), $photoName);
        }

        // Create a new official record
        BrgyOfficial::create([
            'photo' => $path, 
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'contact' => $request->contact,
            'description' => $request->description,
            'term' => $request->term, 
        ]);

        // Optionally log the activity
        ActivityLog::create([
            'activity' => 'Added new official: ' . $request->name,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Official added successfully!']);
    } catch (Exception $e) {
        \Log::error('Error adding official: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to add official.'], 500);
    }
}

    // Store method for SKOfficial
    public function storeSK(Request $request) {
        // Validate incoming request
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contact' => 'required|string|max:20',
        'description' => 'nullable|string|max:500',
        'term' => 'required|string|max:50',
    ], [
        'photo.required' => 'Please upload a photo of the official.', // Custom error message
        'photo.image' => 'The photo must be an image.',
        'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
        'photo.max' => 'The photo must not be greater than 2MB.',
    ]);

    try {
        $path = null; 
        if ($request->hasFile('photo')) {
            // Store the photo using Storage facade
            $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = 'official_photos/' . $photoName; // Path where photo will be stored
            Storage::disk('public_html')->putFileAs('official_photos', $request->file('photo'), $photoName);
        }

        // Create a new SK official record
        SKOfficial::create([
            'photo' => $path, 
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'contact' => $request->contact,
            'description' => $request->description,
            'term' => $request->term, 
        ]);

        // Optionally log the activity
        ActivityLog::create([
            'activity' => 'Added new SK official: ' . $request->name,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Official added successfully!']);
    } catch (Exception $e) {
        \Log::error('Error adding official: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to add official.'], 500);
    }
}

    // Update method for BrgyOfficial
    public function update(Request $request, $id) {   
        try {
        // Find the official by ID or fail
        $official = BrgyOfficial::findOrFail($id);

        // Validate the request data
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:11',
            'description' => 'nullable|string',
            'term' => 'required|string|max:50',
        ]);

        // Initialize the path for the photo
        $path = null; 

        // Check if a new photo is being uploaded
        if ($request->hasFile('photo')) {
            // Generate a new photo name and move the uploaded file using Storage facade
            $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = 'official_photos/' . $photoName; 

            // Store the new photo
            Storage::disk('public_html')->putFileAs('official_photos', $request->file('photo'), $photoName);
            // Update photo if a new one is uploaded
            $official->photo = $path;
        }

        // Update other official's data regardless of photo upload
        $official->name = $request->name;
        $official->position = $request->position;
        $official->email = $request->email;
        $official->contact = $request->contact;
        $official->description = $request->description;
        $official->term = $request->term;

        // Save the updated official
        $official->save();

        // Return a success response
        return response()->json(['message' => 'Official updated successfully!'], 200);
        
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error updating official: ' . $e->getMessage()], 500);
    }
}


    public function destroy($id)
    {
        $official = BrgyOfficial::findOrFail($id);
        $official->delete();

        return response()->json(['success' => 'Official deleted successfully.']);
    }

    public function updateSK(Request $request, $id)
    {   
    try {
        // Find the SK official by ID or fail
        $official = SKOfficial::findOrFail($id);

        // Validate the request data
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:11',
            'description' => 'nullable|string',
            'term' => 'required|string|max:50',
        ]);

        // Initialize the path for the photo
        $path = null; 

        // Check if a new photo is being uploaded
        if ($request->hasFile('photo')) {
            // Generate a new photo name
            $photoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            // Store the photo using Storage facade
            $path = 'official_photos/' . $photoName; 

            // Store the new photo in public_html directory
            Storage::disk('public_html')->putFileAs('official_photos', $request->file('photo'), $photoName);
            // Update the photo if a new one is uploaded
            $official->photo = $path;
        }

        // Update other official's data regardless of photo upload
        $official->name = $request->name;
        $official->position = $request->position;
        $official->email = $request->email;
        $official->contact = $request->contact;
        $official->description = $request->description;
        $official->term = $request->term;

        // Save the updated official
        $official->save();

        // Return a success response
        return response()->json(['message' => 'Official updated successfully!'], 200);
        
    } catch (\Exception $e) {
        // Return an error response if something goes wrong
        return response()->json(['message' => 'Error updating official: ' . $e->getMessage()], 500);
    }
}


    public function destroySK($id)
    {
        $official = SKOfficial::findOrFail($id);
        $official->delete();

        return response()->json(['success' => 'Official deleted successfully.']);
    }

}
