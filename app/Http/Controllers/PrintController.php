<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Response;
use App\Models\Service;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PrintController extends Controller
{
    //
    public function getPrint($id)
{
    try {
        $authUser = auth()->user();
        if (!in_array($authUser->roles, ['admin', 'staff'])) {
            abort(403, 'Unauthorized');
        }

        // Fetch the appointment data
        $req = Service::findOrFail($id);
        if (!$req) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        // Decode JSON from the $req object
        $data = json_decode($req->data, true);  
        // Initialize the template path
        $templateFilePath = '';
        $templateProcessor = null;
       // Get current day and month
       $currentDay = Carbon::today()->format('j'); 
        $suffix = match ($currentDay) {
            1, 21, 31 => 'st',
            2, 22 => 'nd',
            3, 23 => 'rd',
            default => 'th',
        };
    // Combine the day and suffix
       $currentDayWithSuffix = $currentDay . $suffix;
       $currentMonthWord = Carbon::today()->format('F');
       $currentYear = Carbon::now()->year;
       $nextYear = $currentYear + 1;
        // Determine the template and extract data based on request_type
        switch ($req->request_type) {
            case 'Certificate of Residency':
                 $templateFilePath = Storage::disk('public_html')->path('template/RESIDENCY-2024.docx');
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                // Convert DOB to "Month Day, Year"
                    $dates = Carbon::parse($data['residency_date']);
                    $formattedDateofRes = $dates->format('F j, Y');
                // Populate template with relevant data
                $templateProcessor->setValue('{{FULL_NAME}}', $data['residency_fullname']);
                $templateProcessor->setValue('{{HOUSE_ADDRESS}}', $data['residency_houseAddress']);
                $templateProcessor->setValue('{{DATESS}}', $formattedDateofRes);
                $templateProcessor->setValue('{{PURPOSE}}', $data['residency_purpose']);
                $templateProcessor->setValue('{{CURRENT_DAY}}', $currentDayWithSuffix);
                $templateProcessor->setValue('{{CIR}}',$currentDay);
                    $templateProcessor->setValue('{{CURRENT_MONTH}}', $currentMonthWord);
                    $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                break;

                case 'Barangay Clearance':
                    $templateFilePath = Storage::disk('public_html')->path('template/CLEARANCE-2024.docx');
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                    
                    // Convert DOB to "Month Day, Year"
                    $dob = Carbon::parse($data['barangay_dob']);
                    $formattedDob = $dob->format('F j, Y');
    
                    // Populate template with relevant data
                    $templateProcessor->setValue('{{FULL_NAME}}', $data['barangay_fullname']);
                    $templateProcessor->setValue('{{AGE}}', $data['barangay_age']);
                    $templateProcessor->setValue('{{@STATS}}', $data['barangay_civilStatus']);
                    $templateProcessor->setValue('{{BORN}}', $formattedDob);
                    $templateProcessor->setValue('{{HOUSE_ADDRESS}}', $data['barangay_houseAddress']);
                    Log::info('Barangay Purpose: ' . $data['barangay_purpose']);
                    $templateProcessor->setValue('{{PUOSE}}', $data['barangay_purpose']);                    
                    $templateProcessor->setValue('{{CURRENT_DAY}}', $currentDayWithSuffix);
                    $templateProcessor->setValue('{{CURRENT_MONTH}}', $currentMonthWord);
                    $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                    break;

            case 'First Time Job Seeker Certification':
                $templateFilePath = Storage::disk('public_html')->path('template/FIRST-TIME-NEW-FORMAT.docx');
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                // Populate template with relevant data
                $templateProcessor->setValue('{{FULL_NAME}}', $data['job_seeker_fullname']);
                $templateProcessor->setValue('{{HOUSE_ADDRESS}}', $data['job_seeker_houseAddress']);
                $templateProcessor->setValue('{{PURPOSE}}', $data['job_seeker_purpose']);
                $templateProcessor->setValue('{{CURRENT_DAY}}', $currentDayWithSuffix);
                $templateProcessor->setValue('{{CURRENT_MONTH}}', $currentMonthWord);
                $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                //$templateProcessor->setValue('{{NXT_YEAR}}', $nextYear);
                break;

            case 'Certificate of Indigency':
                $templateFilePath = Storage::disk('public_html')->path('template/INDIGENCY-2024.docx');
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                // Populate template with relevant data
                $templateProcessor->setValue('{{FULL_NAME}}', $data['indigency_fullname']);
                $templateProcessor->setValue('{{HOUSE_ADDRESS}}', $data['indigency_houseAddress']);
                $templateProcessor->setValue('{{PUROSE}}', $data['indigency_purpose']);
                $templateProcessor->setValue('{{CURRENT_DAY}}', $currentDayWithSuffix);
                    $templateProcessor->setValue('{{CURRENT_MONTH}}', $currentMonthWord);
                    $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                break;

            case 'Barangay Business Clearance':
                $templateFilePath = Storage::disk('public_html')->path('template/BUSINESS-PERMIT.docx');
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                // Populate template with relevant data
                $templateProcessor->setValue('{{BUSINESS_NAME}}', $data['business_name']);
                $templateProcessor->setValue('{{BUSINESS_ADDRESS}}', $data['business_address']);
                $templateProcessor->setValue('{{OWNER_NAME}}', $data['owner_name']);
                $templateProcessor->setValue('{{CIR}}',$currentDay);
                    $templateProcessor->setValue('{{CURRENT_MONTH}}', $currentMonthWord);
                    $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                break;

            default:  // Barangay ID
                $templateFilePath = Storage::disk('public_html')->path('template/BRGY_ID.docx');
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateFilePath);
                $dob = Carbon::parse($data['barangay_id_bdate']);
                $formattedDob = $dob->format('M j, Y');
                // Populate template with relevant data
                $templateProcessor->setValue('{{SURNAME}}', $data['barangay_id_surname']);
                $templateProcessor->setValue('{{FIRST_NAME}}', $data['barangay_id_firstName']);
                $templateProcessor->setValue('{{MIDDLE_NAME}}', $data['barangay_id_middleName']);
                $templateProcessor->setValue('{{HOUSE_ADDRESS}}', $data['barangay_id_address']);
                // $templateProcessor->setValue('{{PURPOSE}}', $data['barangay_id_purpose']);
                $templateProcessor->setValue('{{SIBILZ}}', $data['barangay_id_civilStatus']);
                $templateProcessor->setValue('{{REGL}}', $data['barangay_id_religion']);
                $templateProcessor->setValue('{{BIRPLACE}}', $data['barangay_id_BirthPlace']);
                $templateProcessor->setValue('{{BTYPEZ}}', $data['barangay_id_bloodtype']);
                $templateProcessor->setValue('{{MOBINUM}}', $data['barangay_id_mobilenum']);
                $templateProcessor->setValue('{{BDDATE}}', $formattedDob);
                $templateProcessor->setValue('{{CONTPERSON}}', $data['barangay_id_contactperson']);
                $templateProcessor->setValue('{{KONTAK}}', $data['barangay_id_contnum']);
                $templateProcessor->setValue('{{RELATONS}}', $data['barangay_id_relationship']);
                $templateProcessor->setValue('{{CURRENT_YEAR}}', $currentYear);
                break;
        }

       // Save the modified document
        $outputFilePath = Storage::disk('public_html')->path('export-doc/Output.docx');
        $templateProcessor->saveAs($outputFilePath);

        // Log activity
        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => "Generated a document for request ID: $id"
        ]);

        // Return the generated document for download
        return response()->download($outputFilePath)->deleteFileAfterSend(true);

    } catch (\Exception $e) {
        Log::error('Error in generating the document: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error in generating the document. Please try again later.');
    }
}

}