<?php
/**
 * Created by OsaMa Soft.
 * User: Osama
 * Date: 19/7/2017
 * Time: 01:57 PM
 */
include('hawkiqPSApi.php');
$psnID = "tristouneh";
$psnapi = new hawkiqPSApi($psnID);
$playerInfo = $psnapi->get_infos();
$playerInfoRare = $psnapi->get_rarety();
$gametrophies=$psnapi->get_trophiesGame('https://psnprofiles.com/trophies/8533-escape-game-aloha');
$game=$psnapi->get_Game('https://www.psthc.fr/jeu-ps3/red-dead-redemption/liste-trophees.htm');
echo '<pre>';
print_r($playerInfo);
print_r($playerInfoRare);
print_r($gametrophies);
print_r($game);

echo '</pre>';

