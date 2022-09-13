<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Table
    protected $table = 'posts';

    // Primary Key
    public $primaryKey = 'id';

    // Timestamp
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User');    // relationship [a post belongs to a user]
    }
}
