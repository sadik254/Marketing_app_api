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

    protected $casts = [
        'read_permission' => 'boolean',
        'write_permission' => 'boolean',
        'delete_permission' => 'boolean',
    ];

    // Define relationship with permissions
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
}
