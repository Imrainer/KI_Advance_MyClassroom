<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Helpers\Notification;
use App\Models\Mata_Pelajaran;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotifControllers extends ApiController
{   
    function getNotify (Request $request) {
  
    $deviceToken = $request->input('to');
  
    $data = [
        'title' => $request->input('title'),
        'body' => $request->input('body'),
    ];
  
    $headers = [
        'Authorization: key=AAAA8ymW3kU:APA91bGcV7WX8jFB0hxr0i4RKqNk5ZYGJopVs2tzxSj6b1KVpGdjm1IND-70UjAxGNtqvM8WWee65c3cZpC-SFN-BMc2EiFjYPs0k-GM4rRmEgA-UsuG54aXDfTO2a_49VNBuSoIDFbJ',
        'Content-Type: application/json',
    ];
  
    $options = [
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode([
            'to' => $deviceToken,
            'notification' => $data,
        ]),
    ];
  
    $ch = curl_init();
    curl_setopt_array($ch, $options);
  
    $response = curl_exec($ch);
  
    curl_close($ch);
    if ($response === false) {
        die('cURL error: ' . curl_error($ch));
    }
  
    $responseData = json_decode($response, true);
  
    if (isset($responseData['error'])) {
        die('FCM API error: ' . $responseData['error']);
    }
    return Api::createApi(200, 'successfully sent', $data);
     
     }
  
  
         public function NewTask (request $request) {
          
            $notificationData = [
                'to' => $request->input('to'), // Device Token
                'title' => 'New Assignment!',
                'body' => 'You have a new assignment: ' . $request->input('title'),
            ];

            $response = $this->getNotify($notificationData);

            return  Api::createApi(200, 'successfully created score', $notificationData);

         }

         public function Reminder (request $request) {
            $notificationData = [
                'to' => $request->input('to'), // Device Token
                'title' => 'Reminder!',
                'body' => 'Do not be late to submit : ' . $request->input('task_description'),
            ];
           
            $response = $this->getNotify($notificationData);

            return  Api::createApi(200, 'successfully created score', $notificationData);

         }

}