@extends('_templates.extends.extends_membersAuth')
@section('htmlHeadTitle','註冊頁 - '.config('env.APP_NAME'))
@section('htmlHeadStyle')
  <style>
    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .checkbox {
      font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
@endsection
@section('htmlBodyClass','text-center')
@section('htmlBody')
  <main class="form-signin">
    <form action="<?=route('membersAuth.login')?>" enctype="multipart/form-data" method="post">
      <h1 class="h3 mb-4 fw-normal">會員註冊</h1>

      <div class="form-floating">
        <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">帳號</label>
      </div>

      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">密碼</label>
      </div>

      <div class="form-floating">
        <input name="password_confirm" type="password" class="form-control" id="floatingPasswordConfirm"
               placeholder="Password">
        <label for="floatingPasswordConfirm">密碼確認</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input name="remember_me" type="checkbox" value="1"> 記住我
        </label>
      </div>

      <button class="w-100 btn btn-lg btn-success" type="submit">註冊</button>
      @csrf
      <?php
      //      dump(session()->all());
      ?>
    </form>
    <p class="mt-5 mb-3 text-muted">&copy; <?=date('Y')?></p>
  </main>
@endsection
