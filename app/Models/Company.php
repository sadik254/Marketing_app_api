<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'company_name',
        'company_address',
        'email',
        'phone',
        'logo',
        'remarks',
    ];

    /**
     * Get the logo URL.
     *
     * @return string|null
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo; // Directly return the stored URL
    }
}