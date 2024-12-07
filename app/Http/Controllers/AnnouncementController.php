<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        $announcements = Announcement::orderBy('id', 'desc')->get();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Visited Announcement List page.'
        ]);
        return view('announcement.index', compact('announcements'));
    }

    public function create()
    {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        return view('announcement.create');
    }

public function store(Request $request)
{   
    $authUser = auth()->user();
    
    if (!in_array($authUser->roles, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }

    $validated = $request->validate([
        'event-title' => 'required|string|max:255',
        'event-content' => 'required|string',
        'imageFilez' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $title = base64_encode($validated['event-title']);
    $content = base64_encode($validated['event-content']);
    $cover = 'bg-img2.jpg';

    if ($request->hasFile('imageFilez')) {
        $file = $request->file('imageFilez');
        $destinationPath = 'announcement_img';

        // Ensure the directory exists (for local storage on public_html)
        if (!Storage::disk('public_html')->exists($destinationPath)) {
            Storage::disk('public_html')->makeDirectory($destinationPath, 0755, true);
        }

        // Generate the filename and store the file in the public_html path
        $filename = time() . '-' . $file->getClientOriginalName();
        $filePath = $file->storeAs($destinationPath, $filename, 'public_html');

        // Save the filename as cover
        $cover = base64_encode($filename);
    }

    Announcement::create([
        'cover' => $cover,
        'title' => $title,
        'content' => $content,
    ]);

    $titlezx = $validated['event-title'];

    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'activity' => 'Created a new announcement entitled ' . $titlezx
    ]);

    // Fetch all users with the role 'resident'
    $residents = User::where('roles', 'resident')->get();

    // Debugging information
    \Log::info('Number of residents found: ' . $residents->count());

    // Log each resident's information
    foreach ($residents as $resident) {
        \Log::info('Resident ID: ' . $resident->id . ', Name: ' . $resident->name);
    }

    // Create a notification for each resident
    foreach ($residents as $resident) {
        Notification::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $resident->id,
            'message' => 'A new announcement named "' . $titlezx . '" has been posted.',
            'is_read' => 0, 
        ]);
    }

    \Log::info("Added new announcement with title '$titlezx'");

    return response()->json([
        'status' => 'success',
        'message' => 'Announcement created successfully.',
        'redirect' => route('announcements.indexpage')
    ]);
}

    public function edit($id)
    {   
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Fetch the announcement to edit
        $announcement = Announcement::findOrFail($id);

        // Return the view to edit the announcement
        return view('announcement.edit', compact('announcement'));
    }


    public function update(Request $request, $id)
    {
    try {
        $authUser = auth()->user();
        if (!in_array($authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'event-title' => 'required|string|max:255',
            'event-content' => 'required|string',
            'imageFilez' => 'nullable|image|mimes:jpg,png,gif,jpeg|max:2048',
        ]);

        // Find the announcement or fail
        $announcement = Announcement::findOrFail($id);

        // Handle image file upload
        if ($request->hasFile('imageFilez')) {
            // If there is an existing image, delete it
            if ($announcement->cover && Storage::disk('public_html')->exists('announcement_img/' . base64_decode($announcement->cover))) {
                Storage::disk('public_html')->delete('announcement_img/' . base64_decode($announcement->cover));
            }

            // Store the new image with its original filename
            $image = $request->file('imageFilez');
            $originalImageName = $image->getClientOriginalName();
            $filePath = $image->storeAs('announcement_img', $originalImageName, 'public_html');

            // Encrypt the filename and update the announcement's cover
            $encryptedImageName = base64_encode($originalImageName);
            $announcement->cover = $encryptedImageName;
        }

        // Update the announcement details
        $announcement->title = base64_encode($validatedData['event-title']);
        $announcement->content = base64_encode($validatedData['event-content']);
        $announcement->save();

        // Log the activity
        ActivityLog::create([
            'user_id' => $authUser->id,
            'activity' => 'Updated an announcement entitled ' . $validatedData['event-title']
        ]);

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Announcement updated successfully.',
            'redirect' => route('announcements.indexpage')
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Announcement not found.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update the announcement.'
        ]);
    }
}

    public function destroy(Request $request)
{
    try {
        $authUser = auth()->user();
        if (!in_array( $authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }
        // Validate the input
        $id = intval($request->input('id'));

        // Find the announcement or fail
        $announcement = Announcement::findOrFail($id);

        // Log the activity
        $title = base64_encode($announcement->title);
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Deleted an announcement entitled ' . $title
        ]);

        // Delete the announcement
        $announcement->forceDelete();

        // Redirect back with success message
        return redirect()->route('announcements.indexpage')->with('success', 'Announcement deleted successfully.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Redirect back with error message
        return redirect()->route('announcements.indexpage')->with('error', 'Announcement not found.');
    } catch (\Exception $e) {
        // Redirect back with error message
        return redirect()->route('announcements.indexpage')->with('error', 'Failed to delete the announcement.');
    }
}

}
