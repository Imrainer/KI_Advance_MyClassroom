<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Submission;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Score;
use Illuminate\Support\Str;

class SubmissionControllers extends Controller
{
    public function index(request $request)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();
       
        $submission = Submission::with('user','assignment')->get();  

        $score = Score::get(); 
   
        if($request->has('search')){
            $submission = Submission::where('assignment', 'LIKE', '%' .$request->search.'%')->paginate(5);
        } else {
            $submission = Submission::paginate(5);
        }
         return view ('pages/Submission',compact(['admin','submission', 'score']));
     }

     public function byId($uuid)
     {
         $admin = session('id');
         $admin = Admin::where('id', $admin)->first();
         $submission = Submission::with('user', 'assignment')->where('id', $uuid)->firstOrFail();
         
         // Find the Score record based on a specific criterion, e.g., submission_id.
         $score = Score::where('submission_id', $uuid)->first();
     
         // Check if a Score record was found before accessing its properties.
         $scoreId = $score ? $score->id : null;
     
         return view('pages/SubmissionById', compact(['submission', 'admin', 'score', 'scoreId']));
     }
     
 
    }