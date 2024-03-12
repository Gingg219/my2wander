<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthAuthenticatable
{
    use HasFactory;
    use Authenticatable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function getRoleNameAttribute()
    {
        return UserRole::getKey(intval($this->role));
    }
}
