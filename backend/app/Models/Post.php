<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'postContent',
        'user_id',
    ];

    public function Users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
