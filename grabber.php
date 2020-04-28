<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_content($URL){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $URL);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (%s; U %s; en-US; Valve Source Client; %s) AppleWebKit/532.1 (KHTML, like Gecko) Chrome/3.0.195.24 Safari/532.1");
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}
?>
<html>
<head>
<style>
<?php
$old_ttf = get_content("https://www.seriousgmod.com/stats/style.css");
$old_ttf1 = str_replace("url('Oswald-Bold.ttf');", "url('fonts/Oswald-Bold.ttf');" ,$old_ttf);
$old_ttf2 = str_replace("url('GreatVibes-Regular.ttf');", "url('fonts/GreatVibes-Regular.ttf');" ,$old_ttf1);
$old_ttf3 = str_replace("url('Exo-Light.ttf');", "url('fonts/Exo-Light.ttf');" ,$old_ttf2);
$old_ttf4 = str_replace("url('Exo-Medium.ttf');", "url('fonts/Exo-Medium.ttf');" ,$old_ttf3);

echo $old_ttf4;
?>
</style>
</head>
<body id="mystats">
<?php
$old_contents = get_content($_GET['url']);
echo str_replace("<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">", "" ,$old_contents); ?>
</body>
</html>
