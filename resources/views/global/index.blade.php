<?php
/**
 * Parameter from Controller
 * @var App\Models\Members $member
 * @var string $memberSexText
 */
?>
@extends('_templates.extends.extends_master')
@section('htmlBodyContain')
  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">歡迎登入!! {{$member->name}} {{$memberSexText}}</h1>
    <p class="px-3 fs-5 text-muted text-start">
      感謝您抽空查看我的作品，不管未來是有機會到貴司服務，<br>
      都希望您不吝嗇給予任何需要改善的專業建議，謝謝您。<br>
      - 懇請查看 <a href="https://github.com/AndersonLin9527/interview-ajtaiwan/blob/main/README.md" target="_blank">GitHub
        README.md</a> 感恩。<br>
      - 題目二在右上角 NavBar <a href="<?=route('constellationsFortunes.index')?>">星座運勢</a><br>
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
@endsection
