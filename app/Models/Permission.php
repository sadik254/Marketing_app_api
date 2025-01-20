<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'role_id',
        'module_id',
        'read_permission',
        'write_permission',
        'delete_permission',
    ];
}
