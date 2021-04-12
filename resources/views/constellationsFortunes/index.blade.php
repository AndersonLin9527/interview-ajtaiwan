<?php
/**
 * Parameter from Controller
 * @var Illuminate\Contracts\Pagination\LengthAwarePaginator $constellationsFortunes
 */
?>
@extends('_templates.extends.extends_master')
@section('htmlHeadPlugin')
  <script>
    function pageSwitch(thisButton, action) {
      let form = thisButton.closest('form');
      let formPage = form.find('input[name="page"]');
      let formPageValue = parseInt(formPage.val())
      if (action === 'previous') {
        formPage.val(formPageValue - 1);
      } else if (action === 'next') {
        formPage.val(formPageValue + 1);
      }
      form.submit();
    }
  </script>
@endsection
@section('htmlBodyContain')
  <main>
    <h2 class="display-6 text-start mb-4">星座運勢</h2>
    <form method="get">
      <input name="page" type="hidden" value="<?=$constellationsFortunes->currentPage();?>">
      @component('constellationsFortunes.index_paginator')
        @slot('constellationsFortunes',$constellationsFortunes)
      @endcomponent
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th>id</th>
            <th>日期</th>
            <th>星座</th>
            <th>運勢</th>
          </tr>
          </thead>
          <tbody>
          @foreach($constellationsFortunes as $constellationsFortune)
            <?php
            /**
             * @var App\Models\Constellations_Fortunes $constellationsFortune
             */
            ?>
            <tr>
              <td>{{$constellationsFortune->id}}</td>
              <td>{{$constellationsFortune->created_date}}</td>
              <td>{{$constellationsFortune->name}}</td>
              <td class="text-wrap">
                <span class="fw-bolder">整體運勢 {{$constellationsFortune->fortune_score}}</span><br>
                {{$constellationsFortune->fortune_desc}}<br>
                <span class="fw-bolder">愛情運勢 {{$constellationsFortune->love_score}}</span><br>
                {{$constellationsFortune->love_desc}}<br>
                <span class="fw-bolder">事業運勢 {{$constellationsFortune->career_score}}</span><br>
                {{$constellationsFortune->career_desc}}<br>
                <span class="fw-bolder">財運運勢 {{$constellationsFortune->wealth_score}}</span><br>
                {{$constellationsFortune->wealth_desc}}<br>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      @component('constellationsFortunes.index_paginator')
        @slot('constellationsFortunes',$constellationsFortunes)
      @endcomponent
    </form>
  </main>
@endsection