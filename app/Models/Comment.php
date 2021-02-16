<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package App\Models
 * post_id
 * body
 * user_id
 * timestamps
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    public $timestamps = true;

    protected $fillable = [
        'body',
        'post_id'
    ];
}
