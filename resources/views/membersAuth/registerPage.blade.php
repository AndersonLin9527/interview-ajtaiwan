<?php
/**
 * @var Illuminate\Support\ViewErrorBag $errors
 */
?>
@extends('_templates.extends.extends_membersAuth')
@section('htmlHeadTitle','註冊頁 - '.config('env.APP_NAME'))
@section('htmlBody')
  <main class="form-signin">
    <form action="<?=route('membersAuth.register')?>" enctype="multipart/form-data" method="post">
      <h1 class="h3 mb-4 fw-normal text-center text-success">會員註冊</h1>
      {{-- 帳號 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="username">帳號 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="username" maxlength="50" minlength="5" name="username" required type="text"
                 value="<?=old('username');?>">
        </div>
      </div>
      {{-- 密碼 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="password">密碼 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="password" minlength="5" name="password" required type="password"
                 value="<?=old('password');?>">
        </div>
      </div>
      {{-- 密碼確認 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="password_confirm">密碼確認 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="password_confirm" minlength="5" name="password_confirm" required
                 type="password" value="<?=old('password_confirm');?>">
        </div>
      </div>
      {{-- 姓名 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="name">姓名 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="name" maxlength="50" name="name" required type="text"
                 value="<?=old('name');?>">
        </div>
      </div>
      {{-- 性別 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="sex">性別</label>
        <div class="col-sm-9 pt-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="inlineRadio1" name="sex" type="radio" value="0">
            <label class="form-check-label" for="inlineRadio1">女</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="inlineRadio2" name="sex" type="radio" value="1">
            <label class="form-check-label" for="inlineRadio2">男</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" disabled id="inlineRadio3" name="sex" type="radio" value="2">
            <label class="form-check-label" for="inlineRadio3">公司</label>
          </div>
        </div>
        @if(!is_null(old('sex')))
          <script>
            $('input[name="sex"][type="radio"][value="<?=old('sex');?>"]').prop('checked', true);
          </script>
        @endif
      </div>
      {{-- 生日 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label">生日</label>
        <div class="col-sm-9">
          <div class="input-group">
            <label>
              <input class="form-control" maxlength="4" name="birthday_year"
                     onkeyup="value=value.replace(/[^\d]/g,'')" pattern="\d*" placeholder="西元" type="text"
                     value="<?=old('birthday_year');?>">
            </label>
            <span class="input-group-text"></span>
            <label>
              <select class="form-select form-select-sm" name="birthday_month">
                <option value="">- 請選擇 -</option>
                @foreach(range(1,12) as $month)
                  <option value="{{str_pad($month,2,'0',STR_PAD_LEFT )}}">{{$month}}</option>
                @endforeach
              </select>
            </label>
            @if(!is_null(old('birthday_month')))
              <script>
                $('select[name="birthday_month"] option[value="<?=old('birthday_month');?>"]').prop('selected', true);
              </script>
            @endif
            <span class="input-group-text">/</span>
            <select class="form-select form-select-sm" name="birthday_day" aria-label="Birthday Day">
              <option value="">- 請選擇 -</option>
              @foreach(range(1,30) as $day)
                <option value="{{str_pad($day,2,'0',STR_PAD_LEFT )}}">{{$day}}</option>
              @endforeach
            </select>
            @if(!is_null(old('birthday_day')))
              <script>
                $('select[name="birthday_day"] option[value="<?=old('birthday_day');?>"]').prop('selected', true);
              </script>
            @endif
          </div>
        </div>
      </div>
      {{-- 信箱 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="email">信箱</label>
        <div class="col-sm-9">
          <input class="form-control" id="email" name="email" placeholder="abc@def.com" type="email"
                 value="<?=old('email');?>">
        </div>
      </div>
      {{-- 錯誤訊息 --}}
      @if($errors->isNotEmpty())
        <div class="mb-2 row">
          <label class="col-sm-3 col-form-label text-danger pt-0">錯誤訊息</label>
          <div class="col-sm-9">
            @foreach ($errors->getMessages() as $messages)
              @foreach ($messages as $message)
                <span class="d-block mb-1 text-danger">※ {{$message}}</span>
              @endforeach
            @endforeach
          </div>
        </div>
      @endif
      {{-- 會員登入 --}}
      <div class="row mb-3 g-3 align-items-center">
        <div class="col text-end">
          <a class="text-primary" href="<?=route('membersAuth.loginPage')?>">
            會員登入
          </a>
        </div>
      </div>
      {{-- 註冊 --}}
      <button class="w-100 btn btn-lg btn-success" type="submit">註冊</button>
      @csrf
    </form>
    <p class="mt-5 mb-3 text-muted text-center">&copy; <?=date('Y')?></p>
  </main>
@endsection
