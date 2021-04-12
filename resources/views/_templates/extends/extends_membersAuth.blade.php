<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
  {{-- Required meta tags --}}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('htmlHeadTitle',config('env.APP_NAME'))</title>
  {{-- Bootstrap CSS --}}
  <link href="<?=asset('plugin/bootstrap/5.0.0-beta3/css/bootstrap.min.css');?>" rel="stylesheet">
  {{-- Bootstrap bundle JS --}}
  <script src="<?=asset('plugin/bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js');?>"></script>
  {{-- jQuery 3.3.1 --}}
  <script src="<?=asset('plugin/jquery/3.3.1/jquery.min.js');?>"></script>
  <link href="<?=asset('css/style_membersAuth.css');?>" rel="stylesheet">
  @yield('htmlHeadPlugin')
</head>
<body class="@yield('htmlBodyClass')">
@yield('htmlBody')
</body>
</html>
