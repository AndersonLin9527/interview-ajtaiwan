<?php

namespace App\Console\Commands\Schedule;

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
    // 當天日期
    //● 星座名稱
    //● 整體運勢的評分及說明
    //● 愛情運勢的評分及說明
    //● 事業運勢的評分及說明
    //● 財運運勢的評分及說明

    // astros[0]="牡羊座";
    // astros[1]="金牛座";
    // astros[2]="雙子座";
    // astros[3]="巨蟹座";
    // astros[4]="獅子座";
    // astros[5]="處女座";
    // astros[6]="天秤座";
    // astros[7]="天蠍座";
    // astros[8]="射手座";
    // astros[9]="摩羯座";
    // astros[10]="水瓶座";
    // astros[11]="雙魚座";

    // 取得星座資料, 資料來源 https://astro.click108.com.tw/
    $constellations = config('constellations');

    foreach ($constellations as $constellationId => $constellationName) {

      $curl = curl_init();
      $url = 'https://astro.click108.com.tw/daily_10.php?iAstro=' . $constellationId;
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);

      // todo
      if ($response == false) {
        $this->error($constellationName . ' curl failure');
      }

      curl_close($curl);

      $fortunes = [];
      $fortunes['fortune'] = '整體運勢';
      $fortunes['love'] = '愛情運勢';
      $fortunes['career'] = '事業運勢';
      $fortunes['wealth'] = '財運運勢';

      foreach ($fortunes as $fortune) {
        // 運勢
        $fortune_pos_start = strpos($response, $fortune);
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

        $this->comment($constellationName . ' ' . $fortune . ' ' . $fortune_rank . ' ' . $fortune_score);
        $this->info($fortune_description);
      }
      $this->line('===================================================');
    }

    $this->line('exit');
  }
}
