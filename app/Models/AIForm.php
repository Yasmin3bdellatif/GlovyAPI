<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fo',
        'Fio',
        'Fhi',
        'Jitter',
        'Rap',
        'Ppq',
        'Shimmer',
        'Dpq'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
