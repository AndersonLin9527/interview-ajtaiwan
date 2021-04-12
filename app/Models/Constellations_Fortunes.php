<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Constellations_Fortunes
 * @package App\Models
 * @mixin Builder
 * @property mixed id
 * @property mixed name
 * @property mixed fortune_score
 * @property mixed fortune_desc
 * @property mixed love_score
 * @property mixed love_desc
 * @property mixed career_score
 * @property mixed career_desc
 * @property mixed wealth_score
 * @property mixed wealth_desc
 * @property mixed status
 * @property mixed memo
 * @property mixed created_date
 * @property mixed created_at
 * @property mixed updated_at
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
