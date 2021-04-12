<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Anderson">
  <meta name="theme-color" content="#7952b3">
  <title>@yield('htmlHeadTitle',config('env.APP_NAME'))</title>
  {{-- Bootstrap CSS --}}
  <link href="<?=asset('plugin/bootstrap/5.0.0-beta3/css/bootstrap.min.css');?>" rel="stylesheet">
  {{-- Bootstrap bundle JS --}}
  <script src="<?=asset('plugin/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js');?>"></script>
  {{-- jQuery 3.3.1 --}}
  <script src="<?=asset('plugin/jquery/3.3.1/jquery.min.js');?>"></script>
  <link href="<?=asset('css/style_master.css');?>" rel="stylesheet">
  @yield('htmlHeadPlugin')
</head>
<body>
<div class="container py-3">
  <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="<?=route('global.index');?>" class="d-flex align-items-center text-dark text-decoration-none">
      <span class="fs-4"><?=config('env.APP_NAME');?></span>
    </a>
    <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <a class="btn btn-outline-primary text-decoration-none me-3" href="<?=route('global.index');?>">個人資料</a>
      <a class="btn btn-outline-primary text-decoration-none me-3" href="<?=route('constellationsFortunes.index');?>">星座運勢</a>
      <a class="btn btn-outline-dark text-decoration-none" href="<?=route('membersAuth.logout');?>">登出</a>
    </nav>
  </header>
  @yield('htmlBodyContain')
  <footer class="pt-4 my-md-5 pt-md-5">
    <p class="mt-5 mb-3 text-muted text-center">&copy; <?=date('Y')?></p>
  </footer>
</div>
</body>
</html>
