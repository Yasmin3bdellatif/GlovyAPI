<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'Dpq',
        'user_id',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
