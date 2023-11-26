<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\NotifControllers;
use App\Models\Lampiran;
use App\Models\Admin;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Score;
use App\Models\Mata_Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssignmentControllers extends Controller
{
     // <!--MENAMPILKAN ASSIGNMENT--!>
     public function index(request $request)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();

        $assignment = Assignment::all();   
        $mapel= Mata_Pelajaran::get();

        if($request->has('search')){
            $assignment = Assignment::where('title', 'LIKE', '%' .$request->search.'%')->paginate(5);
        } else {
            $assignment = Assignment::paginate(5);
        }
         return view ('pages/Assignment',compact(['admin','assignment','mapel']));
     }
 
     // <!--MENAMPILKAN ASSIGNMENT BY ID--!>
     public function byId($uuid)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();
        $assignment = Assignment::with('mata_pelajaran','lampiran')->where('id', $uuid)->firstOrFail();
        
         return view ('pages/AssignmentById',compact(['assignment','admin']));
     }
 
     // <!---MEMBUAT ASSIGNMENT---!>
     public function create(Request $request, NotifControllers $notifControllers)
     {
        $adminId = session('id'); // $adminId adalah array admin yang login
         $idAdmin = $adminId['id'];

        $assignment=[
            'title'=>$request->title,
            'description'=>$request->description,
            'mata_pelajaran_id'=>$request->mata_pelajaran_id,
            'due_date'=>$request->due_date,
            'admin_id'=>$idAdmin,
        ];
          
        $assignment['id'] = Str::uuid()->toString();
        Assignment::create($assignment);
         $response = (new NotifControllers)->NewTask($request, $assignment);
        
	     return redirect('/assignment')->with('Assignment baru berhasil ditambahkan');
     }

     
     // <!---MENGEDIT ASSIGNMENT--!>

     public function editpage($uuid)
    {   
        $assignment = Assignment::find($uuid);
        $mapel= Mata_Pelajaran::get();

        
        return view('/pages/EditAssignment',compact(['assignment','mapel']));
    }

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
 
         return redirect('/assignment')->with('assignment berhasil diperbarui');
 
     }
 
     // <!---MENGHAPUS CATALOGUE--!>
     public function delete(Request $request, $id)
     { $assignment = Assignment::findOrFail($id);
     
        $assignment->delete();
 
         return redirect('/assignment')->with('assignment berhasil dihapus');
     }
 
 
}
