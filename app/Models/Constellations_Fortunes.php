<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Constellations_Fortunes
 * @package App\Models
 * @mixin Builder
 */
class Constellations_Fortunes extends Model
{
  use HasFactory;

  // 設定 table
  protected $table = 'constellations_fortunes';
  // 設定 table PK
  protected $primaryKey = 'id';
  // 設定 table 可異動 column
  protected $fillable = [
    'name',
    'fortune_score',
    'fortune_desc',
    'love_score',
    'love_desc',
    'career_score',
    'career_desc',
    'wealth_score',
    'wealth_desc',
    'status',
    'memo',
    'created_date',
    'created_at',
    'updated_at',
  ];

}
