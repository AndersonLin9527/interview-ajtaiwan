<?php
/**
 * Parameter from Controller
 * @var Illuminate\Contracts\Pagination\LengthAwarePaginator $constellationsFortunes
 */

/**
 * 轉換分數為星級
 *
 * @param int $score
 * @return string
 * @author Anderson 2021-04-12
 */
function convertScoreToStar(int $score): string
{
  return str_pad(str_repeat('★', $score), 15, '☆');
}
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

    function buttonLoading(thisButton, loadingStatus) {
      if (loadingStatus) {
        thisButton.prop('disabled', true);
        thisButton.find('span.ready').addClass('d-none');
        thisButton.find('span.spinner-border').removeClass('d-none');
        thisButton.find('span.loading').removeClass('d-none');
      } else {
        thisButton.prop('disabled', false);
        thisButton.find('span.spinner-border').addClass('d-none');
        thisButton.find('span.loading').addClass('d-none');
        thisButton.find('span.ready').removeClass('d-none');
      }
    }

    // 執行 執行爬蟲
    function ConstellationCrawler(thisButton) {

      buttonLoading(thisButton, true);

      const deferAjax = ConstellationCrawlerDefer();

      $.when(deferAjax).then(
        // resolve
        function () {
          buttonLoading(thisButton, false);
          let modalId = 'modal-ConstellationCrawlerSuccess';
          let modalRegisterSuccess = new bootstrap.Modal(document.getElementById(modalId), {
            backdrop: 'static',
            keyboard: false
          });
          modalRegisterSuccess.show();
        },
        // reject
        function () {
          buttonLoading(thisButton, false);
          let modalId = 'modal-ConstellationCrawlerFailure';
          let modalRegisterSuccess = new bootstrap.Modal(document.getElementById(modalId), {
            backdrop: 'static',
            keyboard: false
          });
          modalRegisterSuccess.show();
        }
      );
    }

    // 執行 執行爬蟲 Defer
    function ConstellationCrawlerDefer() {

      const ajaxDefer = $.Deferred();
      const data = {
        '_token': '<?=csrf_token();?>',
        '_method': 'post',
      };

      $.ajax({
        url: '<?=route('constellationsFortunes.crawl');?>',
        method: 'post',
        data: data,
        success: function (response) {
          ajaxDefer.resolve(response);
        },
        error: function (response) {
          ajaxDefer.reject(response);
        }
      });

      return ajaxDefer.promise();
    }
  </script>
@endsection
@section('htmlBodyContain')
  <main>
    <h2 class="display-6 text-start mb-4">
      星座運勢
      <button class="btn btn-info ms-3" onclick="ConstellationCrawler($(this));">
        <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
        <span class="ready">執行爬蟲</span>
        <span class="loading d-none">Loading...</span>
      </button>
    </h2>
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
                @if($constellationsFortune->status==1)
                  <span class="fw-bolder">
                    整體運勢 <?=convertScoreToStar($constellationsFortune->fortune_score);?>
                  </span><br>
                  {{$constellationsFortune->fortune_desc}}<br>
                  <span class="fw-bolder">愛情運勢 <?=convertScoreToStar($constellationsFortune->love_score);?></span><br>
                  {{$constellationsFortune->love_desc}}<br>
                  <span class="fw-bolder">事業運勢 <?=convertScoreToStar($constellationsFortune->career_score);?></span><br>
                  {{$constellationsFortune->career_desc}}<br>
                  <span class="fw-bolder">財運運勢 <?=convertScoreToStar($constellationsFortune->wealth_score);?></span><br>
                  {{$constellationsFortune->wealth_desc}}<br>
                  <div class="text-end">
                    <small class="text-muted text-end">更新於：{{$constellationsFortune->updated_at}}</small>
                  </div>
                @else
                  <div class="text-danger">Crawler Failure</div>
                  <div>{{$constellationsFortune->memo}}</div>
                @endif
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

  {{-- Modal 爬蟲成功 --}}
  <div class="modal fade" id="modal-ConstellationCrawlerSuccess" data-bs-backdrop="static" data-bs-keyboard="false"
       tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header alert-success">
          <h5 class="modal-title" id="staticBackdropLabel">爬蟲成功</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          請重新整理頁面查看最新星座運勢資料！
        </div>
      </div>
    </div>
  </div>

  {{-- Modal 爬蟲失敗 --}}
  <div class="modal fade" id="modal-ConstellationCrawlerFailure" data-bs-backdrop="static" data-bs-keyboard="false"
       tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header alert-danger">
          <h5 class="modal-title" id="staticBackdropLabel">爬蟲失敗</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          請自行前往 <a href="https://astro.click108.com.tw/" target="_blank">click108 星座</a> 查看最新運勢。
        </div>
      </div>
    </div>
  </div>
@endsection
