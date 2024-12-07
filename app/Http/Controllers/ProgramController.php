<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        // Fetch all programs ordered by ID in descending order
        $programs = Program::orderBy('id', 'asc')->get();
        
        // Return the view with programs data
        return view('prog.program', compact('programs'));
    }

    public function create()
    {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Return the create view
        return view('prog.create-program'); // Create this view to include a form for creating a new program
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
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'program_date' => 'required|date',
        ]);

        // Handle file upload
        $encodedFilename = null;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('program_upload_img', $filename, 'public_html');
            $encodedFilename = base64_encode($filename);
        }

        // Create a new program record
        $program = Program::create([
            'cover' => $encodedFilename,
            'title' => base64_encode($request->title),
            'content' => base64_encode($request->content),
            'program_date' => $request->program_date,
            'user_id' => auth()->user()->id,
        ]);

        // Decode the title for logging purposes
        $title = base64_decode($program->title);

        // Log the creation activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Created a program named, ' . $title
        ]);

        // Fetch all users with the role 'resident' and create notifications
        $residents = User::where('roles', 'resident')->get();
        foreach ($residents as $resident) {
            Notification::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $resident->id,
                'message' => 'A new program named "' . $title . '" has been created.',
                'is_read' => 0,
            ]);
        }

        return redirect()->route('program.adminview')->with('success', 'Program created successfully and notifications sent.');
    } catch (\Exception $e) {
        \Log::error('Error occurred while registering program: ' . $e->getMessage(), [
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
        // Fetch the specific program
        $program = Program::findOrFail($id);

        // Decode base64 fields
        $program->title = base64_decode($program->title);
        $program->content = base64_decode($program->content);
        // $program->program_date = base64_decode($program->program_date);
        $program->cover = base64_decode($program->cover);

        // Return the edit view with program data
        return view('prog.edit-program', [
            'program' => $program,
            'cover' => $program->cover,
            'title' => $program->title,
            'content' => $program->content,
            'pd' => $program->program_date,
        ]);
    }

   public function update(Request $request, $id)
{
    $authUser = auth()->user();
    if (!in_array($authUser->roles, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'event-title' => 'required|string|max:255',
        'event-content' => 'required|string',
        'program-date' => 'required|date',
        'imageFilez' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $program = Program::findOrFail($id);
    $title = base64_decode($program->title);

    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'activity' => 'Edited a program named, ' . $title
    ]);

    // Handle file upload
    $filename = base64_decode($program->cover);
    if ($request->hasFile('imageFilez')) {
        $file = $request->file('imageFilez');
        $oldCoverPath = 'program_upload_img/' . $filename;

        if ($filename && Storage::disk('public_html')->exists($oldCoverPath)) {
            Storage::disk('public_html')->delete($oldCoverPath);
        }

        $filename = $file->getClientOriginalName();
        $file->storeAs('program_upload_img', $filename, 'public_html');
    }

    $program->update([
        'cover' => base64_encode($filename),
        'title' => base64_encode($request->input('event-title')),
        'content' => base64_encode($request->input('event-content')),
        'program_date' => $request->input('program-date'),
    ]);

    return redirect()->route('program.adminview')->with('success', 'Program updated successfully.');
}

    public function delete(Request $request, $id)
{
    try {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Fetch the program to be deleted
        $program = Program::findOrFail($id);
        $title = base64_decode($program->title);

        // Log the deletion activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Deleted a program named, '.$title
        ]);

        // Delete the program (soft delete)
        $program->forceDelete();
        return redirect()->route('program.adminview')->with('success', 'Program deleted successfully.');
    } catch (\Exception $e) {
        \Log::error('Error deleting program: '.$e->getMessage());

        // Redirect back with error message
        return redirect()->route('program.adminview')->with('error', 'Failed to delete the program. Please try again.');
    }
}

}
