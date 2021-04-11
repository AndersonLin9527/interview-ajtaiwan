<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Support\Facades\Auth;

class ControllerGlobal extends Controller
{
  // 首頁
  public function index()
  {
    /** @var Members $member */
    $member = Auth::guard('members')->user();
    $memberSexText = $member->sex == 0 ? '美人' : '帥哥';

    $data = [
      'member' => $member,
      'memberSexText' => $memberSexText,
    ];

    return view('global.index', $data);
  }
}
