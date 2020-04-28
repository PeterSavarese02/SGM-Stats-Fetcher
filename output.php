<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function png2jpg($originalFile, $outputFile, $quality)
{
    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
}

png2jpg('img.png', 'img.jpg', 100); // Conver to JPG so we can edit it with the library used

$inFile  = "img.jpg";
$outFile = "img1.jpg";
$image   = new Imagick($inFile);
$image->cropImage(1280, 180, 0, 0);
$image->writeImage($outFile);

$inFile  = "img1.jpg";
$outFile = "crop.jpg";
$image   = new Imagick($inFile);
$image->thumbnailImage(860, 150);
$image->writeImage($outFile);

$inFile  = "crop.jpg";
$outFile = "crop1.jpg";
$image   = new Imagick($inFile);
$draw    = new ImagickDraw();

$api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={STEAMAPIKEYHERE}&steamids=76561198180838111"; // Put your API key there then from steam.

$json_object = file_get_contents($api_url);

$json_decoded = json_decode($json_object);

$status     = "Is not playing GMod";
$font_color = "#0080ff";

if ($json_decoded->response->players[0]->gameid) {
    if ($json_decoded->response->players[0]->gameid !== "4000") {
    $status     = "Is not playing GMod";
    $font_color = "#0080ff";
} elseif ($json_decoded->response->players[0]->gameid == "4000") {
    if ($json_decoded->response->players[0]->gameserverip == "192.184.57.4:27015") {
        $status     = "Is on a SGM server";
        $font_color = "#0f0";
        echo "Yes";
    } elseif ($json_decoded->response->players[0]->gameserverip == "192.184.57.2:27015") {
        $status     = "Is on a SGM server";
        $font_color = "#0f0";
        echo "Yes";
    } elseif ($json_decoded->response->players[0]->gameserverip == "74.91.124.21:27015") {
        $status     = "Is on a SGM server";
        $font_color = "#0f0";
        echo "Yes";
    } elseif ($json_decoded->response->players[0]->gameserverip == "74.91.119.176:27015") {
        $status     = "Is on a SGM server";
        $font_color = "#0f0";
        echo "Yes";
    } else {
        $status     = "Is not on a SGM server";
        $font_color = "#0080ff";
        echo "no";
    }
}
}

$draw->setFont('fonts/Oswald-Bold.ttf');
$draw->setFontSize(30);
$draw->setFillColor('#ff4d4d');
$image->annotateImage($draw, 300, 40, 0, "Frosty the Gamer:");
$image->drawImage($draw);

$draw->setFont('fonts/Oswald-Bold.ttf');
$draw->setFontSize(30);
$draw->setFillColor($font_color);
$image->annotateImage($draw, 520, 40, 0, $status);
$image->writeImage($outFile);
?>
