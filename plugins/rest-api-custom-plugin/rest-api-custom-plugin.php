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

  // echo "<pre>";
  // echo 'json 575 array';
  // print_r($jsonArray575);
  // echo "</pre>";

?>
  <table class="table table-hover" id="dynamicTable">
    <thead>
      <tr>
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
          <td><img src="<?= $value["logo"]; ?>"><a href="<?= $value["brand_id"]; ?>">Review</a></td>
          <td><?= $value["info"]["bonus"]; ?> </td>
          <?php
          $featuress = $value["info"]["features"];
          ?>
          <div class="d-flex flex-column">
            <td>
              <?php
              foreach ($featuress as $k => $v) {
              ?>
                <ul>
                  <li><?= $v; ?></li>
                </ul>
              <?php
              }
              ?>
            </td>
          </div>
          <td>
            <a href="<?= $value["play_url"]; ?>" class="btn btn-success">Play now</a>
            <p> <?= $value["terms_and_conditions"]; ?></p>
          </td>
        <?php
        // echo "<pre>";
        // print_r("rating:" . " " . $value["info"]["rating"]);
        // echo "</pre>";
      };
        ?>
        </tr>
    </tbody>
  </table>
<?php
}

add_shortcode('restApiPlugin', 'getDataFromJsonApi');
