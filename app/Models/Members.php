<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;

/**
 * Class Members
 * @package App\Models
 * @mixin Builder
 * @property mixed $id
 * @property mixed $username
 * @property mixed $password
 * @property mixed $name
 * @property mixed $sex
 * @property mixed $birthday
 * @property mixed $email
 * @property mixed $remember_token
 * @property mixed $last_login_at
 * @property mixed $last_login_ip
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Members extends AuthUser
{
  use HasFactory;

  // 設定 guard
  protected $guard = 'members';
  // 設定 table
  protected $table = 'members';
  // 設定 table PK
  protected $primaryKey = 'id';
  // 設定 table 可異動 column
  protected $fillable = [
    'username',
    'password',
    'name',
    'sex',
    'birthday',
    'email',
    'remember_token',
    'last_login_at',
    'last_login_ip',
    'created_at',
    'updated_at',
  ];
}
