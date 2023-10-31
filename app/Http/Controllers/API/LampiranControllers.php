<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Helpers\Api;
use App\Models\Lampiran;
use App\Models\Admin;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class LampiranControllers extends ApiController
{
     // <!--MEMBUAT LAMPIRAN--!>

    public function create(Request $request)
      {    $validatedData = $request->validate([
              'file' => 'nullable|image|max:3072'
          ]);
      
          $lampiran = [
              'assignment_id' => $request->assignment_id,
          ];
      
          if ($request->file('file')) {
              $file = $request->file('file')->store('Assignment_lampiran');
              $lampiran['file'] =  $file;
          }
      
          $lampiran['id'] = Str::uuid()->toString();
          
          Lampiran::create($lampiran);
          return Api::createApi(200, 'successfully created lampiran', $lampiran);
      }

  // <!---MENGHAPUS LAMPIRAN--!>
  public function delete(Request $request, $id)
  {   
      $lampiran = Lampiran::findOrFail($id);
  
      $lampiran->delete();

      return Api::createApi(200, 'lampiran successfully deleted');
  }

}
