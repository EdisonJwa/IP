<?php $counter = intval(file_get_contents("counter.dat")); ?>
<?php include 'function.php';?>
<?php
header("Content-type: image/JPEG");
$im = imagecreatefromjpeg("xhxh.jpg"); 
$ip = $_SERVER["REMOTE_ADDR"];
$weekarray=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"); //先定义一个数组
$get=$_GET["s"];
$get=base64_decode(str_replace(" ","+",$get));
//$wangzhi=$_SERVER['HTTP_REFERER'];这里获取当前网址
//here is ip 
$url="https://api.ip.sb/geoip?callback=getgeoip"; 
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';  
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($curl, CURLOPT_ENCODING, '');  
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
$data = curl_exec($curl);
$data = json_decode($data, true);
$country = $data['data']['country']; 
$region = $data['data']['region']; 
$city = $data['data']['city'];
//定义颜色
$black = ImageColorAllocate($im, 0,0,0);//定义黑色的值
$red = ImageColorAllocate($im, 255,0,0);//红色
$font = 'msyh.ttf';//加载字体
//输出
imagettftext($im, 16, 0, 10, 40, $red, $font,'Hello, my friend from'.$country.'-'.$region.'-'.$city.'');
imagettftext($im, 16, 0, 10, 72, $red, $font, 'Today is'.date('n/j/Y')."  ".$weekarray[date("w")]);//当前时间添加到图片
imagettftext($im, 16, 0, 10, 104, $red, $font,'Your IP is:'.$ip);//ip
imagettftext($im, 16, 0, 10, 140, $red, $font,'Your OS is '.$os.'');
imagettftext($im, 16, 0, 10, 175, $red, $font,'You Broswer is '.$bro.'');
imagettftext($im, 14, 0, 10, 200, $black, $font,$get); 
//imagettftext($im, 15, 0, 10, 200, $red, $font,'被偷窥'.$counter.'次'); 
ImageGif($im);
ImageDestroy($im);
?>
<?php
    $counter = intval(file_get_contents("counter.dat"));  
     $_SESSION['#'] = true;  
     $counter++;  
     $fp = fopen("counter.dat","w");  
     fwrite($fp, $counter);  
     fclose($fp); 
 ?>
