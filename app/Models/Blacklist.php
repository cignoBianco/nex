<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Blacklist
 * @package App\Models
 * user_id, blocked_id
 */
class Blacklist extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'blacklists';
    public $timestamps = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'blocked_id',
        'user_id'
    ];
}
