<?php

$curl = curl_init();
$tujuan=$_GET["tujuan"];
$asal=$_GET["asal"];
$berat=$_GET["berat"];
$kurir=$_GET["kurir"];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=$kurir",
  CURLOPT_HTTPHEADER => array(
    //"content-type: application/x-www-form-urlencoded",
    "key:5ac7856320ccdfec6527ab1bad67eb0d"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data = json_decode($response, true);
  $hasil_asal = $data['rajaongkir']['origin_details']['city_name'];
  $hasil_tujuan = $data['rajaongkir']['destination_details']['city_name'];
  //echo $data;
  for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
    $nama_jasa = $data['rajaongkir']['results'][$i]['name'];
    $harga = $data['rajaongkir']['results'][$i]['costs'][$i]['cost'][$i]['value'];
    echo "<tr><td>".$hasil_asal."</td><td>".$hasil_tujuan."</td><td>".$berat."</td><td>".$nama_jasa."</td><td>".$harga."</td></tr>";
  };

}