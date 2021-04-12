<?php
/**
 * Parameter from Component slot
 * @var Illuminate\Contracts\Pagination\LengthAwarePaginator $constellationsFortunes
 */
$constellationsFortunes = $constellationsFortunes ?? [];

if (empty($constellationsFortunes)) {
  echo 'Please use @slot(\'constellationsFortunes\',$constellationsFortunes)';
  return null;
}

$currentPage = $constellationsFortunes->currentPage();
$lastPage = $constellationsFortunes->lastPage();
?>
{{--$constellationsFortunes--}}
<div class="row">
  <div class="col-7">
    每頁 <?=$constellationsFortunes->perPage();?> 筆 |
    共 <?=$constellationsFortunes->total();?> 筆 |
    分 <?=$lastPage;?> 頁
  </div>
  <div class="col-5 justify-content-end">

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        @if($currentPage <= 1)
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> < </a>
          </li>
        @else
          <li class="page-item">
            <button class="page-link" onclick="pageSwitch($(this),'previous');" type="button"> <</button>
          </li>
        @endif
        <li class="page-item">
          <span class="page-text"><?=$currentPage;?> / <?=$lastPage;?></span>
        </li>
        @if($currentPage < $lastPage)
          <li class="page-item">
            <button class="page-link" onclick="pageSwitch($(this),'next');" type="button"> ></button>
          </li>
        @else
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> > </a>
          </li>
        @endif
      </ul>
    </nav>

    <div class="input-group d-none">
      @if($currentPage <= 1)
        <button class="btn btn-outline-secondary" disabled type="button"> <</button>
      @else
        <button class="btn btn-outline-secondary" onclick="pageSwitch($(this),'previous');" type="button"> <</button>
      @endif
      <div class="form-control border-dark border-end-0 text-center">
        <?=$currentPage;?> / <?=$lastPage;?>
      </div>
      @if($currentPage < $lastPage)
        <button class="btn btn-outline-secondary" onclick="pageSwitch($(this),'next');" type="button"> ></button>
      @else
        <button class="btn btn-outline-secondary" disabled type="button"> ></button>
      @endif
    </div>
  </div>
</div>
