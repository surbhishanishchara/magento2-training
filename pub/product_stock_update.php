<?php  

/**
 * code for root script
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '5G');
error_reporting(E_ALL);

use Magento\Framework\App\Bootstrap;
include(__DIR__.'/../app/bootstrap.php');

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

/**
 * code for update stock
 */
$adminUrl = 'http://test.magento24.com/rest/V1/integration/admin/token/';
$ch = curl_init();
$data = array("username" => "admin", "password" => "admin123");

$data_string = json_encode($data);
$ch = curl_init($adminUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);
$token = curl_exec($ch);
$token=  json_decode($token);

$headers = array("Authorization: Bearer $token","Content-Type: application/json");

$skus = array(
  'eeeeeee' => array("qty"=>10,"is_in_stock"=>1),
  'sssss' => array("qty"=>20,"is_in_stock"=>1)
);

foreach ($skus as $sku => $stock) {
  $requestUrl='http://test.magento24.com/rest/V1/products/' . $sku . '/stockItems/1';

  $sampleProductData = array(
          "qty" => $stock['qty'],
          "is_in_stock" =>$stock['is_in_stock']
  );
  $productData = json_encode(array('stockItem' => $sampleProductData));

  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, $requestUrl);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $productData);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  curl_close($ch);
  var_dump($response);

  unset($productData);
  unset($sampleProductData);
}