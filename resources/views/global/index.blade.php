@extends('_templates.extends.extends_membersAuth')
@section('body')
  <h1>Hello, Index!</h1>
@endsection
@section('htmlBodyClass','text-center')
@section('htmlBody')
  <main class="form-signin">
    <form>
      <h1 class="h3 mb-3 fw-normal">歡迎登入!!</h1>
    </form>
    <?php
    dump(session()->all());
    ?>
  </main>
@endsection
