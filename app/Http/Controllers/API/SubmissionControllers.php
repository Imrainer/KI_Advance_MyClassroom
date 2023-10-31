<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Models\Submission;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Mata_Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubmissionControllers extends ApiController
{
    public function file_submission(Request $request)
{   
   $userId = Auth::id();

   if ($request->hasFile('file_path')) {
       $file = $request->file('file_path');
       $file_path = $file->store('Assignment_Submission'); // Simpan berkas dalam penyimpanan Laravel

       $submission = [
           'file_path' => $file_path, // Simpan path berkas yang diunggah
           'assignment_id' => $request->assignment_id,
           'user_id' => $userId,
       ];

       $submission['id'] = Str::uuid()->toString();

       Submission::create($submission);

       return Api::createApi(200, 'Successfully created submission', $submission);
   } else {
       return Api::createApi(400, 'File not uploaded');
   }
}


    public function link_submission(Request $request)
    {   
       $userId = Auth::id();

        $submission=[
            'link'=>$request->link,
            'assignment_id'=>$request->assignment_id,
            'user_id'=>$userId,
        ];
        
        $submission['id'] = Str::uuid()->toString();
        
        Submission::create($submission);
        return Api::createApi(200, 'successfully created submission', $submission);
    }


    public function delete(Request $request, $id)
    {   
        $submission = Submission::findOrFail($id);
    
        $submission->delete();

        return Api::createApi(200, 'submission successfully deleted');
    }
}
