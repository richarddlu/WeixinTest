<?php

define('APPID', 'app id');
define('APPSECRET', 'app secret');

$access_token_json = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET);

$access_token_json_decoded = json_decode($access_token_json);
echo $access_token_json_decoded->access_token;
echo $access_token_json_decoded->expires_in;

?>
