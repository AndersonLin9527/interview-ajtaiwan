<?php

namespace App\Services\Google;

/**
 * Class ReCaptchaV3
 * @package App\Services\Google
 * @property string secret_key
 * @property string token
 * @property string remote_ip
 * @property float valid_score 0.0 ~ 1.0
 * @property string result
 */
class GoogleReCaptchaV3
{
  protected $secret_key;
  protected $token;
  protected $remote_ip;
  protected $valid_score;
  protected $result;

  public function __construct()
  {
    $this->secret_key = config('google.reCAPTCHAv3.secret_key');
    $this->valid_score = 0.5;
  }

  /**
   * 設定 token
   *
   * @param string $token
   * @author Anderson 2021-04-12
   */
  public function setToken(string $token)
  {
    $this->token = $token;
  }

  /**
   * 設定 ip (非必要)
   *
   * @param string $remote_ip
   * @author Anderson 2021-04-12
   */
  public function setRemoteIp($remote_ip)
  {
    $this->remote_ip = $remote_ip;
  }

  /**
   * googleRecaptcha 驗證
   *
   * @return bool $captchaStatus
   * @author Anderson 2020-11-18
   */
  public function captcha(): bool
  {
    $postParameters = [
      'secret' => $this->secret_key,
      'response' => $this->token,
      'remoteip' => $this->remote_ip,
    ];

    $curl = curl_init();
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postParameters);
    $response = curl_exec($curl);
    curl_close($curl);

    // curl 失敗
    if ($response === false) {
      return false;
    } else {
      $responseObj = json_decode($response);
      return $responseObj->success === true && $responseObj->score >= $this->valid_score;
    }
  }

}
