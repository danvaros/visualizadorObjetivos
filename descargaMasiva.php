<?php

// When executed in a browser, this script will prompt for download
// of 'test.xls' which can then be opened by Excel or OpenOffice.

//require 'lib/php-export-data.class.php';

// 'browser' tells the library to stream the data directly to the browser.
// other options are 'file' or 'string'
// 'test.xls' is the filename that the browser will use when attempting to
// save the download
//$exporter = new ExportDataExcel('browser', 'IndicadorDM.xls');

//$exporter->initialize(); // starts streaming data to web browser

// pass addRow() an array and it converts it to Excel XML format and sends
// it to the browser
//$exporter->addRow(array("This"));
//$exporter->addRow(array(1, 2, 3, "123-456-7890"));

// doesn't care how many columns you give it
//$exporter->addRow(array("foo"));

//$exporter->finalize(); // writes the footer, flushes remaining data to browser.

//exit(); // all done


$datos = $_POST;

$indicadores = $datos['indicadores'];
$tipoSeleccion = $datos['tipoSeleccion'];
$tipoFormato = $datos['tipoFormato'];

//var_dump($indicadores);

$indicadores = split(',',$indicadores);

//var_dump($indicadores);


for ($i=1; $i < count($indicadores); $i++) {
   $otra = $indicadores[$i];
   $foo = split('ind',$otra);
   $opo[] = $foo[1];
}

var_dump($opo);


date_default_timezone_set('America/Mexico_City');
require('lib/pclzip.lib.php');
$fecha = date('Y-m-d--His');
$nameFile = 'Agenda2030_DescargaMasiva-'.$fecha.'.zip';
$zip = new PclZip('zip/'.$nameFile);
$zip->create('acerca.html,app.js');



//echo nombreIndicador(26);


function nombreIndicador($indicador){
  // create curl resource
        $ch = curl_init();

        $data = array (
            "PCveInd" => $indicador,
            "PIdioma" => "ES"
          );

          // Setup cURL
          $ch = curl_init('https://ods.org.mx/API/AtrIndicador/PorClave');
          curl_setopt_array($ch, array(
              CURLOPT_POST => TRUE,
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json'
              ),
              CURLOPT_POSTFIELDS => json_encode($data)
          ));

          // Send the request
          $response = curl_exec($ch);

          // Check for errors
          if($response === FALSE){
              die(curl_error($ch));
          }

          // Decode the response
          $responseData = json_decode($response, TRUE);

          return $responseData['Codigo_des'] . " " . $responseData['DescripInd_des'];
}



function creaDoc($indicador,$tipoDato, $formato){
  // create curl resource
        $ch = curl_init();

        $data = array (
            "PCveInd" => $indicador,
            "PIdioma" => "ES",
            "PAnoIni" => 0,
            "PAnoFin" => 0,
            "POrden" => "DESC"
          );

          //$data_string = json_encode($data);
          //var_dump(json_encode($data));
          // Setup cURL
          $ch = curl_init('https://ods.org.mx/API/Valores/PorClave');
          curl_setopt_array($ch, array(
              CURLOPT_POST => TRUE,
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json'
              ),
              CURLOPT_POSTFIELDS => json_encode($data)
          ));

          // Send the request
          $response = curl_exec($ch);

          // Check for errors
          if($response === FALSE){
              die(curl_error($ch));
          }

          // Decode the response
          $responseData = json_decode($response, TRUE);

          var_dump($responseData);

          // Print the date from the response
          // echo $responseData['published'];
}

function leer_contenido_completo($url){
   $fichero_url = fopen ($url, "r");
   $texto = "";
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
}



?>
