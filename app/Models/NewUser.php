<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 *
 * @property int $id
 * @property string $fullname
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $profile_picture
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewUser whereUsername($value)
 * @mixin \Eloquent
 */
class NewUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'createusers';

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}