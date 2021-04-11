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
          <input class="form-control" id="username" name="username" required type="text">
        </div>
      </div>
      {{-- 密碼 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="password">密碼 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="password" name="password" required type="password">
        </div>
      </div>
      {{-- 密碼確認 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="password_confirm">密碼確認 <span class="text-danger">*</span></label>
        <div class="col-sm-9">
          <input class="form-control" id="password" name="password_confirm" required type="password">
        </div>
      </div>
      {{-- 性別 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="sex">性別</label>
        <div class="col-sm-9 pt-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="0">
            <label class="form-check-label" for="inlineRadio1">女</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="1">
            <label class="form-check-label" for="inlineRadio2">男</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sex" id="inlineRadio3" value="2" disabled>
            <label class="form-check-label" for="inlineRadio3">公司</label>
          </div>
        </div>
      </div>
      {{-- 生日 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="sex">生日</label>
        <div class="col-sm-9">
          <div class="input-group">
            <input type="number" class="form-control" name="birthday_year" maxlength="4" placeholder="西元"
                   aria-label="Birthday Year">
            <span class="input-group-text">年</span>
            <select class="form-select form-select-sm" name="birthday_month" aria-label="Birthday Month">
              @foreach(range(1,12) as $month)
                <option value="{{str_pad($month,2,'0',STR_PAD_LEFT )}}">{{$month}}</option>
              @endforeach
            </select>
            <span class="input-group-text">/</span>
            <select class="form-select form-select-sm" name="birthday_day" aria-label="Birthday Day">
              @foreach(range(1,30) as $day)
                <option value="{{str_pad($day,2,'0',STR_PAD_LEFT )}}">{{$day}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      {{-- 信箱 --}}
      <div class="mb-2 row">
        <label class="col-sm-3 col-form-label" for="username">信箱</label>
        <div class="col-sm-9">
          <input class="form-control" id="username" name="username" placeholder="abc@def.com" type="email">
        </div>
      </div>
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
