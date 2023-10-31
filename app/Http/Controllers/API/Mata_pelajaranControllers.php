<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Helpers\Api;
use App\Models\Mata_Pelajaran;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Mata_pelajaranControllers extends ApiController
{
     // <!--MENAMPILKAN MAPEL--!>
     public function index()
     {   $mapel = Mata_Pelajaran::with('admin')->get();
     
         $formattedProduct = $mapel->map(function ($mapel) {
 
             $mapel->created_at_formatted = date('Y-m-d H:i:s', strtotime($mapel->created_at));
             $mapel->updated_at_formatted = date('Y-m-d H:i:s', strtotime($mapel->updated_at));
 
             $photo = $mapel->photo_thumbnail;
             if ($photo === null) {
                 $mapel->photo_thumbnail= null;
             } else {
                 $mapel->photo_thumbnail = 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $photo;
             }

             $teacher = $mapel->admin;

             if ($teacher) {
                 $mapel->teacher_name = $teacher->name;
                 $mapel->teacher_photo = $teacher->photo
                     ? 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $teacher->photo
                     : null;
             } else {
                 $mapel->teacher_name = null;
                 $mapel->teacher_photo = null;
             }
 
             return $mapel;
         });
 
         return Api::createApi(200, 'success', $mapel);
     }
 
     // <!--MENAMPILKAN MAPEL BY ID--!>
     public function byId($uuid)
     {   
         $mapel = Mata_Pelajaran::with('assignment','admin')->where('id', $uuid)->first();
         $mapel->created_at_formatted = date('Y-m-d H:i:s', strtotime($mapel->created_at));
         $mapel->updated_at_formatted = date('Y-m-d H:i:s', strtotime($mapel->updated_at));
 
         $photo = $mapel->photo_thumbnail;
         if ($photo === null) {
             $mapel->photo_thumbnail= null;
         } else {
             $mapel->photo_thumbnail = 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $photo;
         }

        //  $teacher = $mapel->admin;
        // if ($teacher !== null) {
        //     foreach ($teacher as $admin) {
        //         $guru = $admin->user;
        //         $admin->teacher_name = $guru->name;
        //         $admin->teacher_photo = 'https://magang.crocodic.net/ki/Rainer/KI_Advance_Classroom/public/storage/' . $guru->photo; 
        //     }
        // }
         $assignments = $mapel->assignment->map(function ($assignment) {
            $tugas = $assignment->user;
        
            if ($tugas !== null) {
                $assignment->title = $tugas->title;
                $assignment->date = $tugas->due_date;
            } 
        
            return $assignment;
        });
   
        $mapel->assignment = $assignments;
        //$mapel->teacher = $teacher;

         return Api::createApi(200, 'success', $mapel);
     }
 
     // <!---MEMBUAT MAPEL---!>
     public function create(Request $request)
     {
         $validatedData = $request->validate([
             'photo_thumbnail' => 'nullable|image|max:3072'
             ]);

        $adminId = Auth::id();
 
         $mapel=[
             'name'=>$request->name,
             'nama_sekolah'=>$request->product_description,
             'admin_id'=>$adminId,
         ];
 
         if ($request->file('photo_thumbnail')) {
             $photo_thumbnail = $request->file('photo_thumbnail')->store('mapel-thumbnail_picture');
             $mapel['photo_thumbnail'] = $photo_thumbnail;
     }
         $mapel['id'] = Str::uuid()->toString();
         
         Mata_Pelajaran::create($mapel);
         return Api::createApi(200, 'successfully created mapel', $mapel);
     }
 
     // <!---MENGEDIT MAPEL--!>
     public function edit(Request $request, $uuid)
     {   
         $mapel = Mata_Pelajaran::findOrFail($uuid);
         $validatedData = $request->validate([
             'photo_thumbail' => 'nullable|image|max:3072'
             ]);
        
         if ($request->file('photo_thumbnail')) {
             $photo_thumbnail = $request->file('photo_thumbnail')->store('mapel-thumbnail_picture');
         } else {
             $photo_thumbnail = $mapel['photo-thumbnail'];
         }
 
         if ($request->input('name')) {
             $name = $request->input('name');
         } else {
             $name = $mapel['name'];
         }
 
         if ($request->input('nama_sekolah')) {
             $nama_sekolah = $request->input('nama_sekolah');
         } else {
             $nama_sekolah = $mapel['nama_sekolah'];
         }
 
         $mapel->update([
             'name'=>$name,
             'nama_sekolah'=>$nama_sekolah,
             'photo_thumbnail' => $photo_thumbnail,
             
         ]);
 
         return Api::createApi(200, 'successfully updated mapel', $mapel);
 
     }
 
     // <!---MENGHAPUS MAPEL--!>
     public function delete(Request $request, $id)
     {   
         $mapel = Mata_Pelajaran::findOrFail($id);
     
         $mapel->delete();
 
         return Api::createApi(200, 'mapel successfully deleted');
     }
 
}
