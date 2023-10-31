<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $table = "lampiran";

    protected $fillable = [
        'id', 'file', 'assignment_id'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

     public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
