<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\NotifControllers;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Models\Lampiran;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Score;
use App\Models\Mata_Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssignmentControllers extends ApiController
{
     // <!--MENAMPILKAN ASSIGNMENT MENURUT TERBARU KE TERLAMA--!>
     public function index()
     {   $assignment = Assignment::with('lampiran')->get();
     
         $formattedassignment = $assignment->map(function ($assignment) {
 
             $assignment->created_at_formatted = date('Y-m-d H:i:s', strtotime($assignment->created_at));
             $assignment->updated_at_formatted = date('Y-m-d H:i:s', strtotime($assignment->updated_at));
 
             $lampiran = $assignment->lampiran;
             if ($lampiran === null) {
                 $assignment->lampiran= null;
             } else {
                 $assignment->lampiran = 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $lampiran;
             }
 
             return $assignment;
         });
 
         return Api::createApi(200, 'success', $assignment);
     }
 
     // <!--MENAMPILKAN ASSIGNMENT BY ID--!>
     public function byId($uuid)
{
    $user_id = Auth::id(); // Get the ID of the currently logged-in user
    $assignment = Assignment::with('lampiran', 'submission')->where('id', $uuid)->first();

    if (!$assignment) {
        return Api::createApi(404, 'Assignment not found');
    }

    // Format created_at and updated_at as requested
    $assignment->created_at_formatted = date('Y-m-d H:i:s', strtotime($assignment->created_at));
    $assignment->updated_at_formatted = date('Y-m-d H:i:s', strtotime($assignment->updated_at));

    // Check if the user has submitted the assignment
    $submission = $assignment->submission->where('user_id', $user_id)->first();

    if ($submission) {
        // If the user has submitted the assignment, include the submission URL
        $assignment->submission_url = 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $submission->file_path;
    } else {
        // If the user has not submitted the assignment, set submission_url to null
        $assignment->submission_url = null;
    }

    // Extract the lampiran information and create an array of URLs
    $lampiranUrls = $assignment->lampiran->map(function ($lamp) {
        return 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $lamp->file;
    });

    if ($lampiranUrls->isNotEmpty()) {
        $assignment->lampiran_urls = $lampiranUrls;
    } else {
        // If there are no lampiran files, set lampiran_urls to null
        $assignment->lampiran_urls = null;
    }

    // Get the user's score for the assignment, if it exists
    $score = Score::where('submission_id', $submission->id)
        ->where('user_id', $user_id)
        ->first();

    if ($score) {
        $assignment->score = $score->score;
        $assignment->comment = $score->comment;
    } else {
        // If there is no score for the assignment, set score and comment to null
        $assignment->score = null;
        $assignment->comment = null;
    }

    // Return the modified assignment object as the API response
    return Api::createApi(200, 'Success', $assignment);
}
 
     // <!---MEMBUAT ASSIGNMENT---!>
     public function create(Request $request)
     {   
        $adminId = Auth::id();

         $assignment=[
             'title'=>$request->title,
             'description'=>$request->description,
             'mata_pelajaran_id'=>$request->mata_pelajaran_id,
             'due_date'=>$request->due_date,
             'admin_id'=>$adminId,
         ];
         
         $assignment['id'] = Str::uuid()->toString();
         
         Assignment::create($assignment);

         $response = $this->NotifControllers($assignment);

         return Api::createApi(200, 'successfully created assignment', $assignment);
     }
 
     // <!---MENGEDIT PRODUCT--!>
     public function edit(Request $request, $uuid)
     {   
         $assignment = Assignment::findOrFail($uuid);
        
         if ($request->input('title')) {
             $title = $request->input('title');
         } else {
             $title = $assignment['title'];
         }
 
         if ($request->input('description')) {
             $description = $request->input('description');
         } else {
             $description = $assignment['description'];
         }
 
         if ($request->input('mata_pelajaran_id')) {
             $mata_pelajaran_id = $request->input('mata_pelajaran_id');
         } else {
             $mata_pelajaran_id = $assignment['mata_pelajaran_id'];
         }
 
         if ($request->input('due_date')) {
             $due_date = $request->input('due_date');
         } else {
             $due_date = $assignment['due_date'];
         }
     
 
         $assignment->update([
             'title'=>$title,
             'description'=>$description,
             'mata_pelajaran_id'=>$mata_pelajaran_id,
             'due_date'=>$due_date,
         ]);
 
         return Api::createApi(200, 'successfully updated assignment', $assignment);
 
     }
 
     // <!---MENGHAPUS ASSIGNMENT--!>
     public function delete(Request $request, $id)
     {   
         $assignment = Assignment::findOrFail($id);
     
         $assignment->delete();
 
         return Api::createApi(200, 'assignment successfully deleted');
     }
}
