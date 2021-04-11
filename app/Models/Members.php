<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;

/**
 * Class Members
 * @package App\Models
 * @mixin Builder
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
