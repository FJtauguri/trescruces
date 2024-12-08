<?php

namespace App\Http\Controllers;

use App\Events\Monitoring;
use Illuminate\Http\Request;
use App\Models\Service;
use Auth;
use App\Models\GeneralConf;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;

class RequestFileController extends Controller
{
    public function store(Request $request)
    {
        try {
            $userID = Auth::id();

            // Fetch the maximum allowed requests directly
            $maxRequests = GeneralConf::query()->value('max_requests');

            if ($maxRequests === null) {
                Log::warning('Max requests configuration not found.');
                $maxRequests = 1000;
            }

            $maxRequests = (int) $maxRequests;

            $userRequestCount = Service::where('user_id', $userID)->count();
            if ($userRequestCount >= $maxRequests || $maxRequests <= 0) {
                return redirect()->back()->with('error', 'Max requests configuration is invalid.');
            }

            $serviceData = $request->only([
                'residency_fullname',
                'residency_houseAddress',
                'residency_date',
                'residency_purpose',
                'barangay_fullname',
                'barangay_dob',
                'barangay_age',
                'barangay_pob',
                'barangay_civilStatus',
                'barangay_houseAddress',
                'barangay_purpose',
                'indigency_fullname',
                'indigency_houseAddress',
                'indigency_purpose',
                'job_seeker_fullname',
                'job_seeker_houseAddress',
                'job_seeker_purpose',
                'business_name',
                'business_address',
                'owner_name',
                'barangay_id_surname',
                'barangay_id_firstName',
                'barangay_id_middleName',
                'barangay_id_address',
                'barangay_id_purpose',
                'barangay_id_civilStatus',
                'barangay_id_bdate',
                'barangay_id_religion',
                'barangay_id_BirthPlace',
                'barangay_id_bloodtype',
                'barangay_id_contactperson',
                'barangay_id_mobilenum',
                'barangay_id_contnum',
                'barangay_id_relationship'
            ]);

            // Create a new Service instance
            $service = new Service();
            $service->user_id = $userID;
            $service->request_type = $request->input('request_type', 'Unknown');
            $service->tracking_code = $request->input('tracking_code');
            $service->status = 'pending';
            $service->comment = $request->input('comment', '');
            $service->data = json_encode($serviceData);

            if (!$service->save()) {
                Log::error('Failed to save service request', ['user_id' => $userID]);
                return redirect()->back()->with('error', 'Failed to save your request.');
            }

            // Log the activity
            ActivityLog::create([
                'user_id' => $userID,
                'activity' => 'Sent a request for ' . $request->input('request_type', 'Unknown'),
            ]);

            // Fetch to staff
            $pendingRequests = Service::with('users') //newly added
                ->where('status', 'pending')
                ->latest()
                ->get();

            // Format of data
            $pendingRequests = $pendingRequests->map(function ($request) {
                return [
                    'full_name' => $request->full_name,
                    'tracking_code' => $request->tracking_code,
                    'request_type' => $request->request_type,
                    'status' => $request->status,
                    'created_at' => $request->created_at->format('Y-m-d H:i:s'),
                ];
            });

            \Log::info('Pending Requests Data:', $pendingRequests->toArray());

            // Broadcasting : will see at lister.js
            event(new Monitoring([
                'message' => 'The request sucessfully submitted!',
                'pendingRequests' => $pendingRequests
            ]));
            
            return redirect()->route('requestfile.index')->with('success', 'Request submitted successfully!');

        } catch (\Exception $e) {
            Log::error('RequestFileController store method error: ' . $e->getMessage());
            Log::error('RequestFileController store method error details: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
        
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->roles !== 'resident') {
            abort(403, 'Unauthorized');
        }
        $userID = auth()->user()->id;
        $requests = Service::where('user_id', $userID)
            ->latest()
            ->paginate(10);
        // Return view with the 'requests' variable
        return view('resident.request-file', compact('requests'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->roles !== 'resident') {
            abort(403, 'Unauthorized');
        }
        return view('resident.make-request');
    }
}
