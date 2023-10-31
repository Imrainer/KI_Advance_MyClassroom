<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mata_Pelajaran extends Model
{
    use HasFactory;

    protected $table = "mata_pelajaran";

    protected $fillable = [
        'id',  'name', 'nama_sekolah','admin_id','photo_thumbnail','photos_id'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    } 

    public function assignment() {
        return $this->hasMany(Assignment::class,'mata_pelajaran_id');
    } 

    public function getCreatedAtAttribute($value)
    {
        return date('YmdHis', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('YmdHis', strtotime($value));
    }
}
