<?php
/**
 * @var App\Models\Members $member
 * @var string $memberSexText
 */
?>
  <!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Anderson">
  <title>@yield('htmlHeadTitle',config('env.APP_NAME'))</title>

  {{-- Bootstrap CSS --}}
  <link href="<?=asset('plugin/bootstrap/5.0.0-beta3/css/bootstrap.min.css');?>" rel="stylesheet">
  {{-- Bootstrap bundle JS --}}
  <script src="<?=asset('plugin/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js');?>"></script>

  <meta name="theme-color" content="#7952b3">

  <style>

    body {
      background-image: linear-gradient(180deg, #eee, #fff 100px, #fff);
    }

    .container {
      max-width: 960px;
    }

    .pricing-header {
      max-width: 700px;
    }

    table th {
      white-space: nowrap !important;
    }

    table th.fit-content,
    table td.fit-content {
      white-space: nowrap !important;
      width: 1px;
    }
  </style>
</head>
<body>

<div class="container py-3">

  <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="<?=route('global.index');?>" class="d-flex align-items-center text-dark text-decoration-none">
      <span class="fs-4"><?=config('env.APP_NAME');?></span>
    </a>
    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <a class="btn btn-outline-primary text-decoration-none me-3" href="<?=route('global.index');?>">個人資料</a>
      {{-- todo --}}
      <a class="btn btn-outline-primary text-decoration-none me-3" href="#">星座運勢</a>
      <a class="btn btn-outline-dark text-decoration-none" href="<?=route('membersAuth.logout');?>">登出</a>
    </nav>
  </header>

  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">歡迎登入!! {{$member->name}} {{$memberSexText}}</h1>
    <p class="px-3 fs-5 text-muted text-start">
      感謝您抽空查看我的作品，不管未來是有機會到貴司服務，<br>
      都希望您不吝嗇給予任何需要改善的專業建議，謝謝您。<br>
      - 懇請查看 <a href="https://github.com/AndersonLin9527/interview-ajtaiwan/blob/main/README.md" target="_blank">GitHub README.md</a> 感恩。<br>
      - 題目二在右上角 NavBar 星座運勢<br>
    </p>
  </div>

  <main>
    <h2 class="display-6 text-start mb-4">{{$member->name}} 的個人資料</h2>
    <div class="table-responsive">
      <table class="table">
        <tbody>
        <tr>
          <th class="fit-content">id</th>
          <td>{{$member->id}}</td>
        </tr>
        <tr>
          <th class="fit-content">帳號</th>
          <td>{{$member->username}}</td>
        </tr>
        <tr>
          <th class="fit-content">姓名</th>
          <td>{{$member->name}}</td>
        </tr>
        <tr>
          <th class="fit-content">性別</th>
          <td>{{$memberSexText}}</td>
        </tr>
        <tr>
          <th class="fit-content">生日</th>
          <td>{{$member->birthday}}</td>
        </tr>
        <tr>
          <th class="fit-content">信箱</th>
          <td>{{$member->email}}</td>
        </tr>
        <tr>
          <th class="fit-content">最後登入於</th>
          <td>{{$member->last_login_ip}}</td>
        </tr>
        <tr>
          <th class="fit-content">最後登入於</th>
          <td>{{$member->last_login_at}}</td>
        </tr>
        <tr>
          <th class="fit-content">新增於</th>
          <td>{{$member->created_at}}</td>
        </tr>
        <tr>
          <th class="fit-content">更新於</th>
          <td>{{$member->updated_at}}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="pt-4 my-md-5 pt-md-5">
    <p class="mt-5 mb-3 text-muted text-center">&copy; <?=date('Y')?></p>
  </footer>

</div>

</body>
</html>
