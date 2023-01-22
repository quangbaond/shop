<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait;

    protected string $guard = 'admin';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

}
