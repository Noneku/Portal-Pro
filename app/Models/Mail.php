<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mail extends Model
{
  use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'body',
        'from_email',
        'to_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }  //
}
