<?php
return [
  'reCAPTCHAv3' => [
    // input name
    'input_name' => 'googleReCaptchaV3Token',
    // 網站金鑰
    'site_key' => env('GOOGLE_RECAPTCHA_V3_SITE_KEY', '6LdLfaYaAAAAAFgSO801myd2B352GJQ_mUGnVBeH'),
    // 網站密鑰
    'secret_key' => env('GOOGLE_RECAPTCHA_V3_SECRET_KEY', '6LdLfaYaAAAAAPfNkrkYDwXyvWNa4Lfd-matj1nt'),
  ],
];
