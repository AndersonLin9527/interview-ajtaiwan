<?php
/**
 * Parameter from Controller
 * @var string $googleReCaptchaV3SiteKey config('google.reCAPTCHAv3.site_key');
 * @var string $googleReCaptchaV3InputName config('google.reCAPTCHAv3.input_name');
 */
?>
@extends('_templates.extends.extends_membersAuth')
@section('htmlHeadTitle','登入頁 - '.config('env.APP_NAME'))
@section('htmlHeadPlugin')
  <script src="https://www.google.com/recaptcha/api.js?render=<?=$googleReCaptchaV3SiteKey;?>"></script>
@endsection
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
      {{-- google reCaptchaV3 token --}}
      <input name="<?=$googleReCaptchaV3InputName;?>" type="hidden">
    </form>
    <p class="mt-5 mb-3 text-center text-muted">&copy; <?=date('Y')?></p>
  </main>
  {{-- Modal 註冊成功 --}}
  @if(session('message')=='registerSuccess')
    <div class="modal fade" id="modal-registerSuccess" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header alert-success">
            <h5 class="modal-title" id="exampleModalLabel">註冊成功</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            請使用方才註冊的帳號密碼進行登入！
          </div>
        </div>
      </div>
    </div>
    <script>
      let modalRegisterSuccess = new bootstrap.Modal(document.getElementById('modal-registerSuccess'));
      modalRegisterSuccess.show();
    </script>
  @endif
  <script>
    let form = $('form');
    form.submit(function (event) {
      event.preventDefault();
      grecaptcha.ready(function () {
        grecaptcha.execute('<?=$googleReCaptchaV3SiteKey;?>', {action: 'login'})
          .then(function (token) {
            $('input[name="<?=$googleReCaptchaV3InputName;?>"]').val(token);
            form.unbind('submit').submit();
          });
      });
    });
  </script>
@endsection
