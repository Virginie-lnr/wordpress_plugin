<?php

/**
 * Plugin Name:       Rest Api Custom Plugin
 * Description:       Dynamic table with data from Json API 
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

  /**
   * Sort array 575 by position number (ASC)
   */
  usort($jsonArray575, function ($a, $b) {
    return $a['position'] <=> $b['position'];
  });

?>
  <table class="custom-table table-hover mx-auto" id="dynamicTable">
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
          <td data-label="Casino" class="d-flex flex-column">
            <img src="<?= $value["logo"]; ?>" class="td-item">
            <?php
            global $wp;
            $currentUrl = add_query_arg($wp->query_vars, home_url());
            ?>
            <a href="<?= $currentUrl . '/' . $value["brand_id"]; ?>" class="mt-3">Review</a>
          </td>
          <td data-label="Bonus">
            <?php
            $stars = "";
            for ($i = 0; $i < $value["info"]["rating"]; $i++) {
              $stars .= "★";
            }
            ?>
            <p id="rating-stars" class="td-item"><?= $stars; ?></p>
            <?= $value["info"]["bonus"]; ?>
          </td>
          <?php
          $featuress = $value["info"]["features"];
          ?>
          <div class="d-flex flex-column">
            <td data-label="Features">
              <ul class="td-item">
                <?php
                foreach ($featuress as $k => $v) {
                ?>
                  <li>&#9673; <?= $v; ?></li>
                <?php
                }
                ?>
              </ul>
            </td>
          </div>
          <td data-label="Play"><br>
            <a href="<?= $value["play_url"]; ?>" class="btn btn-success mb-2 td-item">Play now</a>
            <p><?= $value["terms_and_conditions"]; ?></p>
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
