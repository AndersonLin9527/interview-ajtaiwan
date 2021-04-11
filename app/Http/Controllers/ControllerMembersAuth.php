<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerMembersAuth extends Controller
{
  /**
   * 會員登入頁
   *
   * @return View
   * @author Anderson 2021-04-11
   */
  public function loginPage()
  {
    return view('membersAuth.loginPage');
  }

  /**
   * 會員登入
   *
   * @param Request $request
   * @return RedirectResponse
   * @author Anderson 2021-04-11
   * 注意 ! 此 method 不要用 dump(), dd() 否則無法成功登入
   */
  public function login(Request $request): RedirectResponse
  {
    $username = $request->input('username');
    $password = $request->input('password');
    $remember_me = $request->input('remember_me');
    $remember_me = $remember_me == '1';

    // 確認帳號大小寫吻合
    $Members = new Members();
    $loginMember = $Members->whereRaw("BINARY `username`= ?", [$username])->first();

    // 登入錯誤訊息
    $loginErrorCode = null;

    if (is_null($loginMember)) {
      // 帳號不存在
      $loginErrorCode = 'Members_is_null';
    } elseif (!password_verify($password, $loginMember->password)) {
      // 密碼錯誤
      $loginErrorCode = 'Members_invalid_password';
    }

    if (!is_null($loginErrorCode)) {
      return redirect()->back()->withErrors(['loginErrorCode' => $loginErrorCode]);
    }

    $loginMember->update([
      'last_login_ip' => $request->getClientIp(),
      'last_login_at' => date('Y-m-d H:i:s'),
    ]);

    Auth::guard('members')->login($loginMember, $remember_me);
    return redirect()->intended(route('global.index'));
  }

  /**
   * 會員登出
   *
   * @return RedirectResponse
   * @author Anderson 2021-04-11
   */
  public function logout(): RedirectResponse
  {
    Auth::guard('members')->logout();
    return redirect()->route('membersAuth.loginPage');
  }

  /**
   * 會員註冊頁面
   *
   * @return View
   * @author Anderson 2021-04-11
   */
  public function registerPage(): View
  {
    return view('membersAuth.registerPage');
  }

  /**
   * 會員註冊
   *
   * @author Anderson 2021-04-11
   */
  public function register()
  {
    return 'register';
  }

}
