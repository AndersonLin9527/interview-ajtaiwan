<?php

namespace Database\Seeders;

use App\Models\Members;
use Illuminate\Database\Seeder;

class SeederMembers extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $Members = new Members();
    $Members->create([
      'username' => 'admin',
      'password' => bcrypt('admin'),
      'name' => 'Anderson',
      'sex' => 1,
      'birthday' => '1990-12-26',
      'email' => 'henxo9527@gmail.com',
      'remember_token' => null,
      'last_login_at' => null,
      'last_login_ip' => null,
    ]);
  }
}
