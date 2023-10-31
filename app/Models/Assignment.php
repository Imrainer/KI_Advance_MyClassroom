<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = "assignment";

    protected $fillable = [
        'id',  'title', 'description','due_date','mata_pelajaran_id','admin_id'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    } 

    public function mata_pelajaran() {
        return $this->belongsTo(Mata_Pelajaran::class, 'mata_pelajaran_id');
    } 

    public function submission() {
        return $this->hasMany(Submission::class);
    } 

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'assignment_id');
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
