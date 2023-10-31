<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = "submission";

    protected $fillable = [
        'id',  'assignment_id', 'user_id','file_path','link'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    } 

    public function assignment() {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    } 

    public function score()
    {
        return $this->hasMany(Score::class);
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
