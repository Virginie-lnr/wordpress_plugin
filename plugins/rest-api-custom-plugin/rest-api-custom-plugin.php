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

  usort($jsonArray575, function ($a, $b) {
    return $a['position'] <=> $b['position'];
  });

  echo "<pre>";
  echo 'json 575 array';
  print_r($jsonArray575);
  echo "</pre>";
?>
  <table class="table table-hover" id="dynamicTable">
    <thead id="thead-dynamicTable">
      <tr class="text-center">
        <th>Casino</th>
        <th>Bonus</th>
        <th>Features</th>
        <th>Play</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($jsonArray575 as $key => $value) {
      ?>
        <tr>
          <td data-label="Casino" class="text-center d-flex flex-column">
            <img src="<?= $value["logo"]; ?>">
            <?php
            global $wp;
            $currentUrl = add_query_arg($wp->query_vars, home_url());
            ?>
            <a href="<?= $currentUrl . '/' . $value["brand_id"]; ?>">Review</a>
          </td>
          <td data-label="Bonus" class="text-center">
            <?php
            $stars = "";
            for ($i = 0; $i < $value["info"]["rating"]; $i++) {
              $stars .= "★";
            }
            ?>
            <p id="rating-stars"><?= $stars; ?></p>
            <?= $value["info"]["bonus"]; ?>
          </td>
          <?php
          $featuress = $value["info"]["features"];
          ?>
          <div class="d-flex flex-column">
            <td data-label="Features">
              <ul>
                <?php
                foreach ($featuress as $k => $v) {
                ?>
                  <li>&#8226; <?= $v; ?></li>
                <?php
                }
                ?>
              </ul>
            </td>
          </div>
          <td data-label="Play" class="text-center">
            <a href="<?= $value["play_url"]; ?>" class="btn btn-success mb-2">Play now</a>
            <p> <?= $value["terms_and_conditions"]; ?></p>
          </td>
        <?php
      };
        ?>
        </tr>
    </tbody>
  </table>
<?php
}

function load_assets()
{
  wp_register_style('css', plugins_url('assets/css/style.css', __FILE__));
  wp_enqueue_style('css');
}

add_action('init', 'load_assets');

add_shortcode('restApiPlugin', 'getDataFromJsonApi');
