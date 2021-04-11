<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMembers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('members', function (Blueprint $table) {
      // 01
      $table->id();
      // 02
      $table->string('username', 50)->unique('unique_username');
      // 03
      $table->string('password');
      // 04
      $table->string('name', 50);
      // 05
      $table->unsignedTinyInteger('sex')->index('index_sex')->nullable()->default(2);
      // 06
      $table->date('birthday')->nullable();
      // 07
      $table->string('email')->nullable();
      // 08
      $table->rememberToken();
      // 09
      $table->ipAddress('last_login_ip')->nullable();
      // 10
      $table->timestamp('last_login_at')->nullable();
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
    Schema::dropIfExists('members');
  }
}
