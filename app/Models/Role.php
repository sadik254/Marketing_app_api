<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name',
    ];

    // Role relation
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Module relation
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
