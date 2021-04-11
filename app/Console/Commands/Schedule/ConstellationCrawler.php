<?php

namespace App\Console\Commands\Schedule;

use App\Models\Constellations_Fortunes;
use Illuminate\Console\Command;

class ConstellationCrawler extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'schedule:ConstellationCrawler';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Constellation Crawler';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   * @author Anderson 2021-04-11
   */
  public function handle()
  {
    $Constellations_Fortunes = new Constellations_Fortunes();

    // 取得星座資料, 資料來源 https://astro.click108.com.tw/
    $constellations = config('constellations');

    foreach ($constellations as $constellationId => $constellationName) {

      $constellationsFortunesData = [];
      $constellationsFortunesData['name'] = $constellationName;
      $constellationsFortunesData['fortune_score'] = null;
      $constellationsFortunesData['fortune_desc'] = null;
      $constellationsFortunesData['love_score'] = null;
      $constellationsFortunesData['love_desc'] = null;
      $constellationsFortunesData['career_score'] = null;
      $constellationsFortunesData['career_desc'] = null;
      $constellationsFortunesData['wealth_score'] = null;
      $constellationsFortunesData['wealth_desc'] = null;
      $constellationsFortunesData['status'] = 1;
      $constellationsFortunesData['memo'] = null;
      $constellationsFortunesData['created_date'] = date('Y-m-d');

      $curl = curl_init();
      $url = 'https://astro.click108.com.tw/daily_10.php?iAstro=' . $constellationId;
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_TIMEOUT, 5);
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
      $response = curl_exec($curl);
      // curl 失敗時
      if ($response == false) {
        $constellationsFortunesData['status'] = 0;
        $constellationsFortunesData['memo'] = curl_error($curl);
        $Constellations_Fortunes->create($constellationsFortunesData);
        continue;
      }
      curl_close($curl);

      $fortunes = [];
      $fortunes['fortune'] = '整體運勢';
      $fortunes['love'] = '愛情運勢';
      $fortunes['career'] = '事業運勢';
      $fortunes['wealth'] = '財運運勢';

      foreach ($fortunes as $fortuneKey => $fortuneName) {
        // 運勢
        $fortune_pos_start = strpos($response, $fortuneName);
        $fortune_pos_close = $fortune_pos_start + 12;
        // 運勢評分 ★★★☆☆
        $fortune_rank = substr($response, $fortune_pos_close, 15);
        // 運勢得分 (0~5)
        $fortune_score = substr_count($fortune_rank, "★");
        // 運勢說明
        $fortune_description_pos_start = strpos($response, '<p>', $fortune_pos_close) + 3;
        $fortune_description_pos_close = strpos($response, '</p>', $fortune_description_pos_start);
        $fortune_description_length = $fortune_description_pos_close - $fortune_description_pos_start;
        $fortune_description = substr($response, $fortune_description_pos_start, $fortune_description_length);

        $constellationsFortunesData[$fortuneKey . '_score'] = $fortune_score;
        $constellationsFortunesData[$fortuneKey . '_desc'] = $fortune_description;

//        for debug
//        $this->comment($constellationName . ' ' . $fortuneName . ' ' . $fortune_rank . ' ' . $fortune_score);
//        $this->info($fortune_description);
      }
      $Constellations_Fortunes->create($constellationsFortunesData);
    }
  }
}
