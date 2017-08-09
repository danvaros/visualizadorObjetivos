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


$indicadores = array();

$tipoSeleccion = $_POST['tipoSeleccion'];

$tipoFormato = $_POST['tipoFormato'];

$seleccion = array();


if ($tipoSeleccion == 01){
  if($tipoFormato == "xls"){
    echo "Indicador XLS";

    creaDoc($indicador, $tipoDato, $formato);



  }elseif ($tipoFormato == "csv") {
    echo "Indicador CSV";
  }
}elseif ($tipoSeleccion == 02){
  if($tipoFormato == "xls"){
    echo "Metadato XLS";
  }elseif ($tipoFormato == "csv") {
    echo "Metadato CSV";
  }
}elseif ($tipoSeleccion == 03){
  if($tipoFormato == "xls"){
    echo "Datos para el Cálculo XLS";
  }elseif ($tipoFormato == "csv") {
    echo "Datos para el cálculo CSV";
  }
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
          echo $responseData['published'];
}


$PCveInd = 26;

function leer_contenido_completo($url){
   $fichero_url = fopen ($url, "r");
   $texto = "";
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
}



?>
