<?php
/**
 * Parameter from Controller
 * @var string $googleReCaptchaV3SiteKey config('google.reCAPTCHAv3.site_key');
 * @var string $googleReCaptchaV3InputName config('google.reCAPTCHAv3.input_name');
 * @var Illuminate\Support\ViewErrorBag $errors
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
  @if(session('message')=='registerSuccess')
    {{-- Modal 註冊成功 --}}
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
  @elseif($errors->has('loginFailureCode'))
    <?php
    $loginFailureCode = $errors->first('loginFailureCode');
    ?>
    @if($loginFailureCode == 'Members_is_null')
      {{-- Modal 登入失敗 (帳號不存在) --}}
      <div class="modal fade" id="modal-loginFailure-Members_is_null" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header alert-danger">
              <h5 class="modal-title">登入失敗</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              會員資料不存在,是否進行會員註冊？
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">取消</button>
              <a class="btn btn-success" href="<?=route('membersAuth.registerPage');?>">會員註冊</a>
            </div>
          </div>
        </div>
      </div>
      <script>
        let modalId = 'modal-loginFailure-Members_is_null';
        let modalRegisterSuccess = new bootstrap.Modal(document.getElementById(modalId), {
          backdrop: 'static',
          keyboard: false
        });
        modalRegisterSuccess.show();
      </script>
    @elseif($loginFailureCode == 'Members_invalid_password')
      {{-- Modal 登入失敗 (密碼錯誤) --}}
      <div class="modal fade" id="modal-loginFailure-Members_invalid_password" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header alert-warning">
              <h5 class="modal-title">登入失敗</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              密碼錯誤，請重新輸入。
            </div>
          </div>
        </div>
      </div>
      <script>
        let modalId = 'modal-loginFailure-Members_invalid_password';
        let modalRegisterSuccess = new bootstrap.Modal(document.getElementById(modalId));
        modalRegisterSuccess.show();
      </script>
    @elseif($loginFailureCode == 'Google_ReCaptchaV3_failure')
      {{-- Modal 登入失敗 (Google ReCaptchaV3 驗證失敗) --}}
      <div class="modal fade" id="modal-loginFailure-Members_invalid_password" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header alert-danger">
              <h5 class="modal-title">登入失敗</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Google ReCaptchaV3 驗證失敗
            </div>
          </div>
        </div>
      </div>
      <script>
        let modalId = 'modal-loginFailure-Members_invalid_password';
        let modalRegisterSuccess = new bootstrap.Modal(document.getElementById(modalId));
        modalRegisterSuccess.show();
      </script>
    @endif
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
