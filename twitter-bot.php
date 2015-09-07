<?php
//Header
header("Content-Type: text/html; charset=Shift-JIS");

// OAuthスクリプトの読み込み
require_once('twitteroauth/twitteroauth.php');
// OAuth認証情報読み込み
require_once('AOuthConf/AOuthConf.php');
 
// ファイルの行をランダムに抽出
//$filelist = file('list.txt');
//if( shuffle($filelist) ){
//  $message = $filelist[0];
//}
//tokyoの時刻を取得
$now = new DateTime("now", new DateTimeZone("Asia/Tokyo"));

$dTime = $now->format('Y/n/j G:i');

$massage = 'テストなぅ…。' 
			. PHP_EOL . '現在時刻は…' . $dTime . 'です…。' 
			. PHP_EOL . 'まだまだキヲクを蓄積しています…。';

//都市コード
/* 2015-09-07 取得先の変更  DEL*/
//$cityCd = '130010';
//リクエストURL
/*$reqURL = 'http://weather.livedoor.com/forecast/webservice/json/v1?city='
			.$cityCd;
*/

/*
//JSON取得
$json = file_get_contents($reqURL);
//JsonDecode
$obj = json_decode($json);
//エンコードしつつ各要素を取得
$wather=mb_convert_encoding($obj->forecasts[0]->telop,"SJIS","UTF-8");
$city=mb_convert_encoding($obj->location->prefecture,"SJIS","UTF-8");
$temperatureMax=$obj->forecasts[0]->temperature->max->celsius;
$temperatureMin=$obj->forecasts[0]->temperature->min->celsius;
*/

/* 2015-09-07 取得先の変更 */
/* リクエストURL */
$reqURL = "http://api.openweathermap.org/data/2.5/weather?q=Tokyo,jp";
/* JSON取得  */
$json = file_get_contents($reqURL);
/* Endode  */
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
/* JsonDecode */
$arr = json_decode($json,true);

if ($arr === NULL) {
    return;
}else{
	$city = $weather_name = $arr["name"];
	$weather = $arr["weather"][0]["main"];
	$temperatureMin = $arr["main"]["temp_min"] - 273.15;
	$temperatureMax = $arr["main"]["temp_max"] - 273.15;
}

//BuildMessage
$weatherMes = 'おはようございます、ご主人様！'
			. PHP_EOL . '本日の天気('. $city . ')は…'
			. PHP_EOL . $weather . '、最高気温' . $temperatureMax . '℃、'
			. '最低気温' . $temperatureMin . '℃の予報となっております。';
$nightMes = 'ご主人様、そろそろお休みのお時間です。'
			. PHP_EOL . '健康のため、夜更かしせずにしっかり睡眠を取ってくださいね！';

$hour = $now->format('G');
if($hour == '8'){
	$tweetMes = $weatherMes;
}else if($hour == '1'){
	$tweetMes = $nightMes;
}else{
	/* 定時呟きはしない…*/
	//$tweetMes = $massage;
}

// Connect on Twitter
/*$connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_TOKEN,ACCESS_TOKEN_SECRET); 
//Tweet
$req = $connection->OAuthRequest(
	"https://api.twitter.com/1.1/statuses/update.json",
	"POST",
	array("status"=> mb_convert_encoding($tweetMes,"UTF-8","SJIS"))
);*/
var_dump($tweetMes);
//var_dump($req);
?>
