<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    use HasFactory;

    /**
     * The attributes that should are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'birthdate',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
