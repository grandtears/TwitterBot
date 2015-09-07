<?php
//Header
header("Content-Type: text/html; charset=Shift-JIS");

// OAuth�X�N���v�g�̓ǂݍ���
require_once('twitteroauth/twitteroauth.php');
// OAuth�F�؏��ǂݍ���
require_once('AOuthConf/AOuthConf.php');
 
// �t�@�C���̍s�������_���ɒ��o
//$filelist = file('list.txt');
//if( shuffle($filelist) ){
//  $message = $filelist[0];
//}
//tokyo�̎������擾
$now = new DateTime("now", new DateTimeZone("Asia/Tokyo"));

$dTime = $now->format('Y/n/j G:i');

$massage = '�e�X�g�Ȃ��c�B' 
			. PHP_EOL . '���ݎ����́c' . $dTime . '�ł��c�B' 
			. PHP_EOL . '�܂��܂��L���N��~�ς��Ă��܂��c�B';

//�s�s�R�[�h
/* 2015-09-07 �擾��̕ύX  DEL*/
//$cityCd = '130010';
//���N�G�X�gURL
/*$reqURL = 'http://weather.livedoor.com/forecast/webservice/json/v1?city='
			.$cityCd;
*/

/*
//JSON�擾
$json = file_get_contents($reqURL);
//JsonDecode
$obj = json_decode($json);
//�G���R�[�h���e�v�f���擾
$wather=mb_convert_encoding($obj->forecasts[0]->telop,"SJIS","UTF-8");
$city=mb_convert_encoding($obj->location->prefecture,"SJIS","UTF-8");
$temperatureMax=$obj->forecasts[0]->temperature->max->celsius;
$temperatureMin=$obj->forecasts[0]->temperature->min->celsius;
*/

/* 2015-09-07 �擾��̕ύX */
/* ���N�G�X�gURL */
$reqURL = "http://api.openweathermap.org/data/2.5/weather?q=Tokyo,jp";
/* JSON�擾  */
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
$weatherMes = '���͂悤�������܂��A����l�l�I'
			. PHP_EOL . '�{���̓V�C('. $city . ')�́c'
			. PHP_EOL . $weather . '�A�ō��C��' . $temperatureMax . '���A'
			. '�Œ�C��' . $temperatureMin . '���̗\��ƂȂ��Ă���܂��B';
$nightMes = '����l�l�A���낻�남�x�݂̂����Ԃł��B'
			. PHP_EOL . '���N�̂��߁A��X���������ɂ������萇��������Ă��������ˁI';

$hour = $now->format('G');
if($hour == '8'){
	$tweetMes = $weatherMes;
}else if($hour == '1'){
	$tweetMes = $nightMes;
}else{
	/* �莞�ꂫ�͂��Ȃ��c*/
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
