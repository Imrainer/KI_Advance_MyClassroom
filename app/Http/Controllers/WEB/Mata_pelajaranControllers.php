<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Lampiran;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Score;
use App\Models\Admin;
use App\Models\Mata_Pelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Mata_pelajaranControllers extends Controller
{
     // <!--MENAMPILKAN MAPEL--!>
     public function index(request $request)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();

        $mapel = Mata_Pelajaran::with('admin')->firstOrFail();
    
        if($request->has('search')){
            $mapel = Mata_Pelajaran::where('name', 'LIKE', '%' .$request->search.'%')->paginate(5);
        } else {
            $mapel = Mata_Pelajaran::paginate(5);
        }
         return view ('pages/Mapel',compact(['admin','mapel']));
     }
 
     // <!--MENAMPILKAN MAPEL BY ID--!>
     public function byId($uuid)
     {  
        $admin = session('id');
        $admin = Admin::where('id', $admin)->first();
        $mapel = Mata_Pelajaran::with('admin')->where('id', $uuid)->firstOrFail();  
        
         return view ('pages/Mapel_id',compact(['mapel','admin']));
     }
 
     // <!---MEMBUAT MAPEL---!>
     public function create(Request $request)
     {  
         // Dapatkan ID admin yang sedang login dari sesi
         $adminId = session('id'); // $adminId adalah array admin yang login
         $idAdmin = $adminId['id'];
     
         $validatedData = $request->validate([
             'photo_thumbnail' => 'nullable|image|max:3072'
         ]);
     
         $mapel = [
             'name' => $request->name,
             'nama_sekolah' => 'SMKN 11 Semarang',
             'admin_id' => $idAdmin, // Isi dengan ID admin yang sedang login
         ];
     
         if ($request->file('photo_thumbnail')) {
             $photo_thumbnail = $request->file('photo_thumbnail')->store('mapel-thumbnail_picture');
             $mapel['photo_thumbnail'] = $photo_thumbnail;
         }
     
         $mapel['id'] = Str::uuid()->toString();
         
         Mata_Pelajaran::create($mapel);
     
         return redirect('/mapel')->with('mapel baru berhasil ditambahkan');
     }
     
     // <!---MENGEDIT CATALOGUE--!>

     public function editpage($uuid)
    {   
        $mapel = Mata_Pelajaran::find($uuid);
        
        return view('/pages/EditMapel',compact(['mapel']));
    }

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
 
         return redirect('/mapel')->with('mapel berhasil diperbarui');
 
     }
 
     // <!---MENGHAPUS MAPEL--!>
     public function delete(Request $request, $id)
     {  $mapel = Mata_Pelajaran::findOrFail($id);
     
        $mapel->delete();
 
         return redirect('/mapel')->with('mata pelajaran berhasil dihapus');
     }
 
 
}
