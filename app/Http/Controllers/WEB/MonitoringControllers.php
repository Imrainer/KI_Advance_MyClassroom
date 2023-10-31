<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Lampiran;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Score;
use App\Models\Mata_Pelajaran;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class MonitoringControllers extends Controller
{   

    public function GetSessionCount() {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $sessionCount = $user->sessions()->count();

        return $sessionCount;
    }

    public function monitoring (request $request)
    {  
       $admin = session('id');
       $admin = Admin::where('id', $admin)->first();
       $userCount = User::count();
       $mapelCount = Mata_Pelajaran::count();
       $assignmentCount = Assignment::count();
       
       return view('pages/Monitoring', compact('admin','userCount', 'mapelCount', 'assignmentCount'));
    }

}
