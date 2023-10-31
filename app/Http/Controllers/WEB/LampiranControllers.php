<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Lampiran;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LampiranControllers extends Controller
{
     // <!--MENAMPILKAN Carousel--!>
     public function index(request $request)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();
        $assignment = Assignment::all();
        $lampiran = Lampiran::with('assignment')->get();   
     
        if($request->has('search')){
            $lampiran = Lampiran::where('file', 'LIKE', '%' .$request->search.'%')->paginate(5);
        } else {
            $lampiran = Lampiran::paginate(5);
        }
        
         return view ('pages/Lampiran',compact(['admin','lampiran','assignment']));
     }
 
     // <!---MEMBUAT CAROUSEL---!>
     public function create(Request $request)
      {    $validatedData = $request->validate([
              'file' => 'nullable|image|max:3072'
          ]);
      
          $lampiran = [
              'assignment_id' => $request->assignment_id,
          ];
      
          if ($request->file('file')) {
            $file = $request->file('file')->store('assignment_lampiran');
            $lampiran['file'] = $file;
        }
    
      
          $lampiran['id'] = Str::uuid()->toString();
          
          Lampiran::create($lampiran);
     
         return redirect("/assignment")->with('success', 'Lampiran baru berhasil ditambahkan');
     }
     
     // <!---MENGHAPUS CAROUSEL--!>
     public function delete(Request $request, $id)
  {   
      $lampiran = Lampiran::findOrFail($id);
  
      $lampiran->delete();

         return redirect('/assignment')->with('lampiran berhasil dihapus');
     }
 
}
