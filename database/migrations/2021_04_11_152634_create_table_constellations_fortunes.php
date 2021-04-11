<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConstellationsFortunes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('constellations_fortunes', function (Blueprint $table) {
      // 01
      $table->id();
      // 02
      $table->string('name', 10);
      // 03
      $table->unsignedTinyInteger('fortune_score')->nullable();
      // 04
      $table->text('fortune_desc')->nullable();
      // 05
      $table->unsignedTinyInteger('love_score')->nullable();
      // 06
      $table->text('love_desc')->nullable();
      // 07
      $table->unsignedTinyInteger('career_score')->nullable();
      // 08
      $table->text('career_desc')->nullable();
      // 09
      $table->unsignedTinyInteger('wealth_score')->nullable();
      // 10
      $table->text('wealth_desc')->nullable();
      // 11
      $table->tinyInteger('status');
      // 12
      $table->text('memo')->nullable();
      //
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('constellations_fortunes');
  }
}
