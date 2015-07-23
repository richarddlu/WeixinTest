<?php

if(isset($_GET['code'])) {
	$code = $_GET['code'];
	echo $code.'<br>';

	$json = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code='.$code.'&grant_type=authorization_code');
	$json_object = json_decode($json);
	$access_token = $json_object->access_token;
	$refresh_token = $json_object->refresh_token;
	$openid = $json_object->openid;
	var_dump($json_object);

	$json = file_get_contents('https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token='.$refresh_token);
	$json_object = json_decode($json);
	var_dump($json_object);
} else {
	echo "woops, something goes wrong.";
}
