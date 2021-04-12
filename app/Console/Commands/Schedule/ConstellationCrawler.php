<?php

namespace App\Console\Commands\Schedule;

use App\Services\ConstellationsFortunes\ServiceConstellationCrawler;
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
    $ServiceConstellationCrawler = new ServiceConstellationCrawler();
    $ServiceConstellationCrawler->crawl();
  }

}
