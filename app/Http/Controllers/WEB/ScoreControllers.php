<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\NotifControllers;
use App\Models\Mata_Pelajaran;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ScoreControllers extends Controller
{
    public function score(Request $request)
    {   
        $adminId = session('id'); // $adminId adalah array admin yang login
        $idAdmin = $adminId['id'];

        $score=[
            'score' =>$request->score,
            'comment'=>$request->comment,
            'user_id'=>$request->user_id,
            'submission_id'=>$request->submission_id,
            'admin_id'=>$idAdmin,
        ];
        
        $score['id'] = Str::uuid()->toString();

        $user = User::find($request->user_id);
    
        if ($user) {
            $deviceToken = $user->device_token;
    
            $score['device_token'] = $deviceToken;

            $score['title'] = 'Good News!';

            $score['body'] = 'Your new assignment has been scored, see!';
    
            $response = (new NotifControllers)->getNotify($request, $score);
    
        Score::create($score);
        return redirect('/submission')->with('score baru berhasil ditambahkan');
    }
}

    // <!---MENGEDIT CATALOGUE--!>

    public function editpage($uuid)
    {   
        $assignment = Score::find($uuid);
        
        return view('/pages/assignmentEdit',compact(['assignment']));
    }

    public function edit(Request $request, $uuid)
    {   
        $score = Score::findOrFail($uuid);
        
        $newScore = $request->input('score');
        $newComment = $request->input('comment');
        $newUserId = $request->input('user_id');
        $newAssignmentId = $request->input('assignment_id');
    
        // Periksa apakah nilai-nilai baru ada dalam permintaan
        if (!is_null($newScore)) {
            $score->score = $newScore;
        }
    
        if (!is_null($newComment)) {
            $score->comment = $newComment;
        }
    
        if (!is_null($newUserId)) {
            $score->user_id = $newUserId;
        }
    
        if (!is_null($newAssignmentId)) {
            $score->assignment_id = $newAssignmentId;
        }
    
        $score->save();

        return redirect('/submission')->with('score baru berhasil diperbarui');
    }

    // <!---Menghapus Score--!>
     public function delete(request $request, $uuid)
     {  
        $score = Score::find($uuid);
    
        $score->delete();
        
        return redirect('/submission');
     }
}
