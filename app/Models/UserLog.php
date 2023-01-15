<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class UserLog extends Model
{
    
    protected $collection = 'user_logs';
    protected $primaryKey = '_id';
}
