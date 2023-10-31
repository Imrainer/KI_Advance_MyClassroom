<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = "score";

    protected $fillable = [
        'id',  'score', 'comment', 'submission_id','user_id','admin_id'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    } 

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function submission()
    {
        return $this->hasOne(submission::class, 'submission_id');
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
