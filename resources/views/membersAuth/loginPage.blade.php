@extends('_templates.extends.extends_membersAuth')
@section('htmlHeadTitle','登入頁 - '.config('env.APP_NAME'))
@section('htmlBody')
  <main class="form-signin">
    <form action="<?=route('membersAuth.login')?>" enctype="multipart/form-data" method="post">
      <h1 class="h3 mb-4 fw-normal text-center text-primary">會員登入</h1>
      {{-- 帳號 --}}
      <div class="form-floating mb-3">
        <input name="username" type="text" class="form-control" id="username" placeholder="帳號" required>
        <label for="username">帳號</label>
      </div>
      {{-- 密碼 --}}
      <div class="form-floating mb-3">
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">密碼</label>
      </div>
      {{-- 記住我 & 會員註冊--}}
      <div class="row mb-3 g-3 align-items-center">
        <div class="col-6 text-start">
          <div class="checkbox text-start">
            <label>
              <input name="remember_me" type="checkbox" value="1"> 記住我
            </label>
          </div>
        </div>
        <div class="col-6 text-end">
          <a class="text-success" href="<?=route('membersAuth.registerPage')?>">
            會員註冊
          </a>
        </div>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">登入</button>
      @csrf
      <?php
//      dump(session()->all());
      ?>
    </form>
    <p class="mt-5 mb-3 text-center text-muted">&copy; <?=date('Y')?></p>
  </main>
@endsection
