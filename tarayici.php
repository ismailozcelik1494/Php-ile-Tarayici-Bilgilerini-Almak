<html>
<head>
<meta http-equiv="Content-Language" content="tr">
 <meta charset="UTF-8">
</head>
<body>

<?php


function getBrowser() 
 { 
     $u_agent = $_SERVER['HTTP_USER_AGENT']; 
     $bname = 'Bilinmiyor';
     $platform = 'Bilinmiyor';
     $version= "";

     //Hangi platformdan gelmiş, Linux, Windows, MacOSX?
     if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
     }
     elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
     }
     elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
     }
     
     //Sonra tarayıcıya göz atalım
     if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
     { 
         $bname = 'Internet Explorer'; 
         $ub = "MSIE"; 
     } 
     elseif(preg_match('/Firefox/i',$u_agent)) 
     { 
         $bname = 'Mozilla Firefox'; 
         $ub = "Firefox"; 
     } 
     elseif(preg_match('/Chrome/i',$u_agent)) 
     { 
         $bname = 'Google Chrome'; 
         $ub = "Chrome"; 
     } 
     elseif(preg_match('/Safari/i',$u_agent)) 
     { 
         $bname = 'Apple Safari'; 
         $ub = "Safari"; 
     } 
     elseif(preg_match('/Opera/i',$u_agent)) 
     { 
         $bname = 'Opera'; 
         $ub = "Opera"; 
     } 
     elseif(preg_match('/Netscape/i',$u_agent)) 
     { 
         $bname = 'Netscape'; 
         $ub = "Netscape"; 
     } 
     
     // Tarayıcının versiyon numarasını tespit edelim.
	 //burada düzenli ifadeler kullanarak bakıyoruz.
     $known = array('Version', $ub, 'other');
     $pattern = '#(?<browser>' . join('|', $known) .
     ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
     if (!preg_match_all($pattern, $u_agent, $matches)) {
         // buraya kadar bulamadık, aramaya devam
     }
     

     $i = count($matches['browser']);
     if ($i != 1) {

         if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
             $version= $matches['version'][0];
         }
         else {
             $version= $matches['version'][1];
         }
     }
     else {
         $version= $matches['version'][0];
     }
     
     if ($version==null || $version=="") {$version="?";}
     
     return array(
         'userAgent' => $u_agent,
         'name'      => $bname,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
     );
 } 

 
$ua=getBrowser();
$tarayici= "Web tarayucınız: " . $ua['name'] . " " . $ua['version'] . " " .$ua['platform'];
print_r($tarayici);

//Örneğin mozilla Firefox kullananların girmesini istemiyorsak
if ($ua['name']=='Mozilla Firefox')
{
echo "<center>";
echo "<h2>Mozilla Firefox tarayıcısı desteklenmiyor.</h2><br>" ;
echo "<h4>Lütfen Internet Explorer, Opera, Safari, Chrome tarayıcılarından birini kullanınız.</h4>";
echo "</center>";

} else  {

	echo "<br><br>Mozilla Firefox dışında bir tarayıcı kullanılıyor, girebilir.";
}

?>
</body>
</html>

