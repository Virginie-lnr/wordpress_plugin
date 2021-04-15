<?php

/**
 * Plugin Name:       Rest Api Custom Plugin
 * Description:       Get reviews data from a REST API 
 * Version:           1.0
 * Author:            Virginie Lenoir
 * Text domain:       rest-api-custom-plugin
 */

if (!defined('ABSPATH')) {
  exit;
};

function getDataFromJsonApi()
{

  $jsonFile = file_get_contents(__DIR__ . '/api.json', true);
  $jsonData = json_decode($jsonFile, true);
  $jsonArray575 = $jsonData['toplists']['575'];

  echo "<pre>";
  echo "json data:";
  print_r($jsonData);
  echo "</pre>";
  echo '--------------------';
  echo "<pre>";
  echo 'json array 575';
  print_r($jsonArray575);
  echo "</pre>";
  foreach ($jsonArray575 as $key => $value) {
    echo "<pre>";
    print_r("brand_id:" . " " .  $value["brand_id"]);
    echo "</pre>";
    echo "<pre>";
    print_r("logo:" . " " . $value["logo"]);
    echo "</pre>";
    $featuress = $value["info"]["features"];
    foreach ($featuress as $k => $v) {
      echo "<pre>";
      print_r("features:" . " " . $v);
      echo "</pre>";
    }
    echo "<pre>";
    print_r("play_url:" . " " . $value["play_url"]);
    echo "</pre>";
    echo "<pre>";
    print_r("terms_and_conditions:" . " " . $value["terms_and_conditions"]);
    echo "</pre>";
    echo "<pre>";
    print_r("rating:" . " " . $value["info"]["rating"]);
    echo "</pre>";
    echo "<pre>";
    print_r("bonus:" . " " . $value["info"]["bonus"]);
    echo "</pre>";
  };
}

add_shortcode('restApiPlugin', 'getDataFromJsonApi');
