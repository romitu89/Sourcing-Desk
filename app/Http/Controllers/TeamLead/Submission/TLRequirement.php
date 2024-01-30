<?php

namespace App\Http\Controllers\TeamLead\Submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\RequestCreation;

class TLRequirement extends Controller
{
    public function create(string $id)
    {

        $am = RequestCreation::Select('request_id', 'subject_line', 'requirement_name', 'requirement_num', 'client_name', 'client_manager', 'created_by')->distinct()->where('request_id', $id)
            ->first();
        //dd($am);

        return response()->json($am);
    }

    public function store(Request $request, string $id)
    {

        //dd($request->all());
        $request->validate([
            'subject' => 'required',
            'requestnum' => 'required',
            'requirename' => 'required',
            'work' => 'required',
            'client' => 'required',
            'manager' => 'required',
            'candName' => 'required',
            'primary' => 'required',

            'totexperience.value' => 'required|numeric',
            'relexperience.value' => 'required|numeric',
            'notice.value' => 'required|integer',
            'currentctc.value' => 'required|numeric',
            'expectctc.value' => 'required|numeric',
            'mobile' => 'required',
            'email' => 'required|email',

            'location' => 'required',
            'joblocation' => 'required',
            'communication' => 'required',
            'technical' => 'required',

            'fileProfile' => 'required|file|mimes:pdf,doc,docx|max:5048',
            'fileVendor' =>  'required|file|mimes:xls,xlsx|max:2048',

            'fileIdProof' => 'file|mimes:pdf,doc,docx,jpeg,jpg,png|max:2048',
            'fileEmail' =>  'file|mimes:pdf,doc,docx,jpeg,jpg,png|max:2048',


        ]);

        $totexp = $request->input('totexperience.value') . " " . $request->input('totexperience.unit');
        $relexp = $request->input('relexperience.value') . " " . $request->input('relexperience.unit');
        $notice = $request->input('notice.value') . " " . $request->input('notice.unit');
        $cuctc = $request->input('currentctc.value') . " " . $request->input('currentctc.unit');
        $exctc = $request->input('expectctc.value') . " " . $request->input('expectctc.unit');

        $fileVendor = $request->file('fileVendor');
        $fileVendorName = time() . '_' . $fileVendor->getClientOriginalName();
        $fileVendorPath = $fileVendor->storeAs('trackers', $fileVendorName, 'public');

        $fileProfile = $request->file('fileProfile');
        $fileProfileName = time() . '_' . $fileProfile->getClientOriginalName();
        $fileProfilePath = $fileProfile->storeAs('candidatetrackers', $fileProfileName, 'public');
        $fileEmailPath = "";
        if ($request->file('fileEmail')) {
            $fileEmail = $request->file('fileEmail');
            $fileEmailName = time() . '_' . $fileEmail->getClientOriginalName();
            $fileEmailPath = $fileEmail->storeAs('emailConfirm', $fileEmailName, 'public');
        }
        $fileIdProofPath = "";
        if ($request->file('fileIdProof')) {
            $fileIdProof = $request->file('fileIdProof');
            $fileIdProofName = time() . '_' . $fileIdProof->getClientOriginalName();
            $fileIdProofPath = $fileIdProof->storeAs('idproof', $fileIdProofName, 'public');
        } // Store file in 'public/uploads' directory
        $clientManagerName = ucwords($request->manager);
        $candName = ucwords($request->candName);


        $submission = new Submission([


            'subject' =>  $request->subject,
            'request_no' => $request->requestnum,
            'requirement_name' => $request->requirename,
            'work_assigned_by' => $request->work,
            'client_name' =>  $request->client,
            'client_manager' => $clientManagerName,
            'candidate_name' => $candName,
            'primary_skills' => $request->primary,
            'secondary_skills' =>  $request->secondary,
            'rate_communication' => $request->communication,
            'rate_technicality' => $request->technical,
            'total_experience' => $totexp,
            'relevant_experience' =>   $relexp,
            'notice_period' => $notice,
            'current_ctc' => $cuctc,
            'expected_ctc' => $exctc,
            'mobile_number' => $request->mobile,
            'email_id' => $request->email,
            'candidate_profile_path' => $fileProfilePath,
            'vendor_tracker_path' => $fileVendorPath,
            'id_proof_path' =>  $fileIdProofPath,
            'email_confirmation_path' => $fileEmailPath,
            'pan_card' => $request->pancard,
            'current_location' => $request->location,
            'job_location' => $request->joblocation,
            'submitted_by' =>  auth()->user()->email_id,
            'location' => auth()->user()->location,

        ]);

        $submission->save();

        return response()->json(['message' => 'Submission created successfully']);
    }
}
