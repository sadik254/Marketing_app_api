<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'module_name',
        'module_file',
        'model_name',
    ];

    // Define relationship with permissions
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id');
    }

    // Dynamically get the related Eloquent model
    public function getModelInstance()
    {
        if (class_exists($this->model_name)) {
            return app($this->model_name);
        }

        throw new \Exception("Model class {$this->model_name} does not exist.");
    }
}
