<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table='post';
    public $fillable=[
        'name',
        'authorname',
        'status'
    ];
    use HasFactory;
}
