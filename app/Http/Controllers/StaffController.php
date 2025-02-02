<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Service;
use App\Models\ActivityLog;
use App\Models\Event;
use App\Models\User;

class StaffController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->roles !== 'staff') {
            abort(403, 'Unauthorized');
        }

        // Fetch programs and format them
        $programs = Program::orderBy('id')->get()->toArray();
        $formattedPrograms = [];
        for ($i = 0; $i < count($programs); $i += 2) {
            $prog1 = $programs[$i];
            $prog1['title'] = base64_decode($prog1['title']);
            $prog1['cover'] = base64_decode($prog1['cover']);
            $prog1['content'] = base64_decode($prog1['content']);

            $prog2 = $i + 1 < count($programs) ? $programs[$i + 1] : $programs[0];
            $prog2['title'] = base64_decode($prog2['title']);
            $prog2['cover'] = base64_decode($prog2['cover']);
            $prog2['content'] = base64_decode($prog2['content']);

            $formattedPrograms[] = ['prog1' => $prog1, 'prog2' => $prog2];
        }

        // Fetch pending requests
        $pendingRequests = Service::where('status', 'pending')->latest()->get()->map(function ($service) {
            return [
                'id' => $service->id,
                'request_type' => $service->request_type,
                'date_created' => $service->created_at,
            ];
        });

        $calendarEvents = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_datetime,
                'end' => $event->end_datetime,
                'description' => $event->description,
                'type' => $event->type,
            ];
        });
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Visited Staff Dashboard page.'
        ]);
        return view('staff.index', [
            'programs' => $formattedPrograms,
            'pendingRequests' => $pendingRequests,
            'calendarEvents' => $calendarEvents,
        ]);
    }

    public function staffSettings()
    {
    $user = auth()->user();
    if ($user->roles !== 'staff') {
        abort(403, 'Unauthorized');
    }
    $userInfo = $user->userinfos()->first(); 
    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'activity' => 'Visited Staff Settings page.'
    ]);
    return view('staff.settings', [
        'user_photo' => $userInfo ? $userInfo->profile_pic : 'default.jpg', // Handle case where userInfo is null
        'firstname' => $user->fname,
        'middlen' => $user->middlename,
        'lastname' => $user->lname,
        'email' => $user->email,
    ]);
}

    public function residentList() {
    $user = auth()->user();
    
    // Ensure only users with the 'staff' role can access this page
    if ($user->roles !== 'staff') {
        abort(403, 'Unauthorized');
    }

    // Fetch only verified residents
    $users = User::where('roles', 'resident')
        ->where('verified', true) // Check if verified is true
        ->get()
        ->map(function ($user) {
            return [
                'Firstname' => $user->fname,
                'Lastname' => $user->lname,
                'Email' => $user->email,
                'Date created' => $user->created_at->format('Y-m-d'),
                'Action' => '<div id="' . $user->id . '" class="w-100 d-flex justify-content-center">
                                <button class="mx-1 btn btn-sm btn-outline-danger act-btn" onclick="delete_resident(\'' . $user->id . '\');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                             </div>',
            ];
        });

    // Log the activity of visiting the resident page
    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'activity' => 'Visited View Residents page.'
    ]);

    // Return the view with the filtered residents
    return view('staff.resident', compact('users'));
}

}
