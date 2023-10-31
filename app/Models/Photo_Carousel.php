<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo_Carousel extends Model
{
    use HasFactory;

    protected $table = "photo_carousel";

    protected $fillable = [
        'id', 'photo', 'mata-pelajaran_id'
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

     public function matapelajaran()
    {
        return $this->belongsTo(Mata_pelajaran::class, 'mata-pelajaran_id');
    }
}
