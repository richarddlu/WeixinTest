<?php
if(isset($_GET['code'])) {
	$code = $_GET['code'];
	echo $code.'<br>';

	$json = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code='.$code.'&grant_type=authorization_code');
	$json_object = json_decode($json);
	$access_token = $json_object->access_token;
	$openid = $json_object->openid;
	echo 'access_token: '.$access_token.'<br>';
	echo 'openid: '.$openid.'<br>';

	if($_GET['state'] === 'userinfo') {
		$json = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN');
		echo $json;
		$json_object = json_decode($json);
		$nickname = $json_object->nickname;
		$sex = $json_object->sex;
		$province = $json_object->province;
		$city = $json_object->city;
		$country = $json_object->country;
		$headimgurl = $json_object->headimgurl;
		echo 'nickname: '.$nickname.'<br>';
		echo 'sex: '.$sex.'<br>';
		echo 'province: '.$province.'<br>';
		echo 'city: '.$city.'<br>';
		echo 'country: '.$country.'<br>';
		echo '<img src="'.$headimgurl.'"><br>';
	}
} else {
	echo "woops, something goes wrong.";
}
?>
