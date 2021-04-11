### Server Environment

此專案建置在 Anderson 個人 Google Cloud Platform 的 VM 中，環境搭建如下：

- Linux Centos 8

- PHP 7.4.11

- Nginx 1.18.1

- MySQL 8.0.23

- Laravel Framework 8.36.2

- SSL (Let's Encrypt)

> P.S 以上服務皆由本人 Anderson 獨立完成建置 & 部署

----------------------------------------------------------

### Topic1

----------------------------------------------------------

### Topic2 星座爬蟲

每日凌晨 02:00 撰寫網路爬蟲並將十二星座資訊儲存至資料庫

- 當天日期
  
- 星座名稱
  
- 整體運勢的評分及說明
  
- 愛情運勢的評分及說明
  
- 事業運勢的評分及說明
  
- 財運運勢的評分及說明

#### 關鍵程式

- 爬蟲程式：app/Console/Commands/Schedule/ConstellationCrawler.php

- Model：app/Models/Constellations_Fortunes.php

  我知道正常物件命名應該採取大駝峰 (ConstellationsFortunes)，但是容易跟其他物件名稱相同，

  所以，個人的習慣是 Model 物件採用大駝峰+蛇底式命名 (Constellations_Fortunes)，
  
  這樣可以快速知道呼叫的物件一定是 Model。

#### DB Schema

請使用 `php artisan migrate` 建立相關 DB

- 資料表：constellation_fortunes

- 資料結構：

| #  | name          | type                | index   | description  | nullable | default | memo                |
|----|---------------|---------------------|---------|--------------|----------|---------|---------------------|
| 01 | id            | unsignedBigInteger  | primary |              | x        |         |                     |
| 02 | name          | string(10)          | index   | 星座名稱     | x        |         |                     |
| 03 | fortune_score | unsignedTinyInteger |         | 整體運勢評分 | o        |         |                     |
| 04 | fortune_desc  | text                |         | 整體運勢說明 | o        |         |                     |
| 05 | love_score    | unsignedTinyInteger |         | 愛情運勢評分 | o        |         |                     |
| 06 | love_desc     | text                |         | 愛情運勢說明 | o        |         |                     |
| 07 | career_score  | unsignedTinyInteger |         | 事業運勢評分 | o        |         |                     |
| 08 | career_desc   | text                |         | 事業運勢說明 | o        |         |                     |
| 09 | wealth_score  | unsignedTinyInteger |         | 財運運勢評分 | o        |         |                     |
| 10 | wealth_desc   | text                |         | 財運運勢說明 | o        |         |                     |
| 11 | status        | tinyInteger         |         | 狀態         | x        |         | 0 => 失敗, 1=> 成功 |
| 12 | memo          | text                |         | 備註         | o        |         |                     |
| 12 | created_date  | date                |         | 新增日期     | x        |         | yyyy-mm-dd          |
| 13 | created_at    | timestamp           |         | 新增於       | x        |         | yyyy-mm-dd hh:mm:ss |
| 14 | updated_at    | timestamp           |         | 更新於       | x        |         | yyyy-mm-dd hh:mm:ss |

- 資料結構說明：

  - 欄位 #03~10 設定 nullable 是為了避免爬蟲失敗，儲存 DB 失敗 (sql error)
  
  - 欄位 #11 status 會記錄每次爬蟲的狀態 ( 0 => 失敗, 1=> 成功 )
  
  - 欄位 #12 memo 當爬蟲失敗 (#11 status = 0) 記錄失敗原因
