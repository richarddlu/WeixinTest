<!DOCTYPE html>
<html>
<head>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script >
	<?php 	// signature
	// get access_token
	define('APPID', 'wxa0be4dbfe322ad09');
	define('APPSECRET', 'af5bfbe98b02a77a22b3da239aaa94df');
	$access_token_json = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET);
	$access_token_json_decoded = json_decode($access_token_json);
	$access_token = $access_token_json_decoded->access_token;

	// get jsapi_ticket
	$jsapi_ticket_json = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi');
	$jsapi_ticket_json_decoded = json_decode($jsapi_ticket_json);
	$jsapi_ticket = $jsapi_ticket_json_decoded->ticket;

	// signature
	$timestamp = time();
	$nonceStr = '65yrtfgh45s6&kdh';
	$url = 'http://52.26.147.50/js-sdk.php';

	$string1 = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$url;
	$signature = sha1($string1);
	?>
	wx.config({
    	debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    	appId: '<?php echo APPID; ?>', // 必填，公众号的唯一标识
    	timestamp: '<?php echo $timestamp; ?>', // 必填，生成签名的时间戳
    	nonceStr: '<?php echo $nonceStr; ?>', // 必填，生成签名的随机串
    	signature: '<?php echo $signature; ?>',// 必填，签名，见附录1
    	jsApiList: [
    	'checkJsApi',
    	'onMenuShareTimeline',
    	'onMenuShareAppMessage'
    	] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	});
	</script>
</head>
<body>
	<input type="button" id="checkJSApi" value="CheckJSApi">
	<script>
	wx.ready(function(){
		// button callback functions
		document.querySelector('#checkJSApi').onclick = function () {
			wx.checkJsApi({
	    		jsApiList: [
	    		'onMenuShareTimeline',
	    		'onMenuShareAppMessage'
	    		], // 需要检测的JS接口列表，所有JS接口列表见附录2,
	    		success: function(res) {
	        		// 以键值对的形式返回，可用的api值true，不可用为false
	        		// 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
	        		alert(res);
	    		}
			});
		}
    	// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    	wx.onMenuShareTimeline({
		    title: '分享到朋友圈测试', // 分享标题
		    link: 'http://52.26.147.50/js-sdk.php', // 分享链接
		    imgUrl: 'http://fdfs.xmcdn.com/group12/M0B/44/05/wKgDXFWlzQeCXNHXAAJ7cs9_xK0560_mobile_large.jpg', // 分享图标
		    success: function () { 
		        // 用户确认分享后执行的回调函数
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    }
		});
		wx.onMenuShareAppMessage({
		    title: '分享给好友测试', // 分享标题
		    desc: '', // 分享描述
		    link: 'http://52.26.147.50/js-sdk.php', // 分享链接
		    imgUrl: 'http://fdfs.xmcdn.com/group12/M0B/44/05/wKgDXFWlzQeCXNHXAAJ7cs9_xK0560_mobile_large.jpg', // 分享图标
		    type: '', // 分享类型,music、video或link，不填默认为link
		    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		    success: function () { 
		        // 用户确认分享后执行的回调函数
		    },
		    cancel: function () { 
		        // 用户取消分享后执行的回调函数
		    }
		});
	});
	</script>
</body>
</html>
