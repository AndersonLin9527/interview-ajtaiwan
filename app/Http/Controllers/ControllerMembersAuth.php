<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
   * @param Request $request
   * @return RedirectResponse
   * @author Anderson 2021-04-11
   */
  public function register(Request $request): RedirectResponse
  {
    $username = $request->input('username');
    $password = $request->input('password');
    $name = $request->input('name');
    $sex = $request->input('sex');
    $birthday = $request->input('birthday_year') . '-' . $request->input('birthday_month') . '-' . $request->input('birthday_day');
    $email = $request->input('email');

    $validateData = [
      'username' => $username,
      'password' => $password,
      'password_confirm' => $request->input('password_confirm'),
      'name' => $name,
      'sex' => $sex,
      'birthday' => $birthday,
      'email' => $email,
    ];

    $validateRules = [
      'username' => ['required', 'string', 'max:50', 'min:5', 'unique:members,username',],
      'password' => ['required', 'string', 'min:5'],
      'password_confirm' => ['required', 'string', 'min:5', 'same:password'],
      'name' => ['required', 'string', 'max:50'],
      'sex' => ['nullable', 'in:0,1'],
      'birthday' => ['nullable', 'date_format:Y-m-d'],
      'email' => ['nullable', 'email'],
    ];

    $validateMessages = [
      'username.required' => '帳號是必填的',
      'username.max' => '帳號最多為 50 個字',
      'username.min' => '帳號最少需 5 個字',
      'username.unique' => '帳號 ' . $username . ' 已被使用',
      'password.required' => '密碼是必填的',
      'password.min' => '密碼最少需 5 個字',
      'password_confirm.min' => '密碼確認最少需 5 個字',
      'password_confirm.same' => '密碼與確認密碼不相符',
      'name.required' => '姓名是必填的',
      'name.max' => '姓名最多為 50 個字',
      'sex.in' => '性別不合法',
      'birthday.date_format' => '生日格式錯誤',
      'email.email' => '信箱格式錯誤',
    ];

    // 資料驗證
    $Validator = Validator::make($validateData, $validateRules, $validateMessages);

    // 資料驗證驗證失敗時
    if (!$Validator->passes()) {
      return redirect()->back()->withInput($request->all())->withErrors($Validator->getMessageBag());
    }

    $Members = new Members();

    $Members->create([
      'username' => $username,
      'password' => bcrypt($password),
      'name' => $name,
      'sex' => $sex,
      'birthday' => $birthday,
      'email' => $email,
      'remember_token' => null,
      'last_login_at' => null,
      'last_login_ip' => null,
    ]);

    session()->flash('message', 'registerSuccess');
    return redirect()->route('membersAuth.loginPage');
  }

}
