<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Helpers\Api;
use App\Models\Submission;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ScoreControllers extends ApiController
{
    public function score(Request $request)
    {   
       $adminId = Auth::id();

        $score=[
            'score' =>$request->score,
            'comment'=>$request->comment,
            'user_id'=>$request->user_id,
            'submission_id'=>$request->submission_id,
            'admin_id'=>$adminId,
        ];
        
        $score['id'] = Str::uuid()->toString();
        
        Score::create($score);
        return Api::createApi(200, 'successfully created score', $score);
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
    
        return Api::createApi(200, 'Successfully updated score', $score);
    }

    public function delete(Request $request, $id)
    {   
        $score = Score::findOrFail($id);
    
        $score->delete();

        return Api::createApi(200, 'score successfully deleted');
    }
}
