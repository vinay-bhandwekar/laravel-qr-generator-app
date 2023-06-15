<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_qr_code extends Model
{
    use HasFactory;
    protected $table = 'user_qr_code_details';

    protected $fillable = [
        'user_id',
        'title',        
        'UUID',
        'type',
        'resource_type',
        'resource',
        'is_locked',
        'owner',
        'owner_details',
        'access_count'
    ];
    
}
