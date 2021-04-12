<?php

namespace App\Http\Controllers;

use App\Models\Constellations_Fortunes;
use Illuminate\Http\Request;

class ControllerConstellationsFortunes extends Controller
{
  // 星座運勢 列表頁
  public function index(Request $request)
  {
    $Constellations_Fortunes = new Constellations_Fortunes();
    $constellationsFortunes = $Constellations_Fortunes
      ->orderBy('id', 'desc')
      ->paginate(12);

    $data = [
      'constellationsFortunes' => $constellationsFortunes,
    ];

    return view('constellationsFortunes.index', $data);
  }
}
