### Server Environment

[專案 GitHub](https://github.com/AndersonLin9527/interview-ajtaiwan)

[專案網址 https://interview-ajtaiwan.henxo9527.com/](https://interview-ajtaiwan.henxo9527.com/)

此專案建置於本人 Anderson 申請的 Google Cloud Platform 的 VM 中，環境搭建如下：

- Linux Centos 8

- PHP 7.4.11
    
- Nginx 1.18.1

- MySQL 8.0.23

- Laravel Framework 8.36.2

  請留意 Required PHP 7.3 以上

- SSL (Let's Encrypt)

以上服務皆由本人 Anderson 獨立完成建置 & 部署, DNS 也是自己的

> 若您嘗試在您的主機測試此專案，
> 
> **請記得更新專案 .env 的 GOOGLE_RECAPTCHA_V3_SITE_KEY & GOOGLE_RECAPTCHA_V3_SECRET_KEY**
>
> 或者
>
> 修改您本機的 hosts 將 interview-ajtaiwan.henxo9527.com 指向您的主機

----------------------------------------------------------

### 題目 1 使用 Laravel Auth,撰寫簡易登入與註冊平台

內容描述:

透過資料庫查詢後,若無資料則進行註冊作業。

若已有該使用者,則進行資料驗證,查驗該使用者資料是否正確,於正確結果中顯示登入後頁面,若資料不正確則顯示錯誤結果。

#### 技術運用

- Laravel Blade

- BootStrap v5.0.0-beta3

- jQuery v3.3.1

  有使用 AJAX Defer (resources/views/constellationsFortunes/index.blade.php)

- Google reCaptchaV3

#### 操做說明

- 會員註冊有使用 Laravel Validator 做資料防呆 (app/Http/Controllers/ControllerMembersAuth::register)

#### DB Schema

請使用 `php artisan migrate` 建立相關 DB

- 資料表：members

- 資料結構：

| #  | name           | type                | index   | description | nullable | default | memo                |
|----|----------------|---------------------|---------|-------------|----------|---------|---------------------|
| 01 | id             | unsignedBigInteger  | primary |             | x        |         |                     |
| 02 | username       | string(50)          | unique  | 會員帳號    | x        |         |                     |
| 03 | password       | string(255)         |         | 會員密碼    | x        |         |                     |
| 04 | name           | string(50)          |         | 會員姓名    | x        |         |                     |
| 05 | sex            | unsignedTinyInteger | index   | 會員性別    | o        |         | 0 => 女, 1=> 男     |
| 06 | birthday       | date                |         | 會員生日    | o        |         | yyyy-mm-dd          |
| 07 | email          | string(255)         |         | 會員信箱    | o        |         |                     |
| 08 | remember_token | string(100)         |         | 記住我      | o        |         |                     |
| 09 | last_login_ip  | string(45)          |         | 最後登入ip  | o        |         |                     |
| 10 | last_login_at  | timestamp           |         | 最後登入於  | o        |         | yyyy-mm-dd hh:mm:ss |
| 11 | created_at     | timestamp           |         | 新增於      | x        |         | yyyy-mm-dd hh:mm:ss |
| 12 | updated_at     | timestamp           |         | 更新於      | x        |         | yyyy-mm-dd hh:mm:ss |

----------------------------------------------------------

### 題目二

使用 Laravel 排程,撰寫網路爬蟲並將十二星座資訊儲存至資料庫

內容描述:

請將 [http://astro.click108.com.tw/](http://astro.click108.com.tw/) 當日的十二星座資料以爬蟲方式抓取,並在解析後儲存至資料庫內

- 當天日期

- 星座名稱

- 整體運勢的評分及說明

- 愛情運勢的評分及說明

- 事業運勢的評分及說明

- 財運運勢的評分及說明

#### 操做說明

每日凌晨 02:00 會執行爬蟲程式

也可以於[介面](https://interview-ajtaiwan.henxo9527.com/constellationsFortunes/index)中手動執行，

這是我唯一想到能做 Laravel Service 的地方了。

#### 技術運用

- php curl

#### 關鍵程式

- 爬蟲程式：app/Services/ConstellationsFortunes/ServiceConstellationCrawler.php

  使用 curl 做爬蟲工具，再透過原生 php 語言進行 parser，儲存資料

  我知道有套件可以透過 dom 的方式更精準的進行爬蟲作業 ( [DomCrawler](https://symfony.com/doc/current/components/dom_crawler.html) )

  但經過研究該網站的結構，發現透過 curl + php 單純的方式就能處理

  > 本人開發原則，非必要情況下，能不使用套件就別使用，理由是若未來專案轉手維護，對方沒有套件經驗，就需要比較多時間進行交流。

- Model：app/Models/Constellations_Fortunes.php

  我知道正常物件命名應該採取大駝峰 (ConstellationsFortunes)，但是容易跟其他物件名稱相同，

  所以，個人的習慣是 Model 物件採用大駝峰+蛇底式命名 (Constellations_Fortunes)，
  
  理由是只要看到大駝峰+蛇底式命名的物件就可以快速知道呼叫的是 Model。

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

#### DB Schema 說明

- 欄位 #03~10 設定 nullable 是為了避免爬蟲失敗，儲存 DB 失敗 (sql error)

- 欄位 #11 status 會記錄每次爬蟲的狀態 ( 0 => 失敗, 1=> 成功 )

- 欄位 #12 memo 當爬蟲失敗 (#11 status = 0) 記錄失敗原因
