<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscriber
 * @package App\Models
 * user_id
 * subscriber_id
 */
class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'subscribers';
    public $timestamps = true;

    protected $fillable = [
        'subscriber_id',
        'user_id'
    ];
}
