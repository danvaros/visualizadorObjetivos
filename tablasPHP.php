<?php

function indicadores(){
  // create curl resource
        $ch = curl_init();

        $data = array (
            "PIdioma" => "ES"
          );

          // Setup cURL
          $ch = curl_init('https://ods.org.mx/API/Tematica/Todos');
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

          //var_dump($responseData);
          return $responseData;
}


$bar = indicadores();
$sumaInd = 0;
$ClaveInd_arb = array();

foreach($bar as $meta){
  $indis = $meta['Meta'];
    foreach($indis as $indi){
      $india = $indi['Indicador'];

      $indicas = count($india);
      for ($i=0; $i < $indicas; $i++) {
        $ClaveInd_arb[] = $india[$i]['ClaveInd_arb'];
        //echo ' '.$india[$i]['ClaveInd_arb'].'<br/>';
      }

    }// Foreach Indicador
}// Foreach Metas



function datos($indicador){
  $ch = curl_init();

  $data = array (
      "PCveInd" => $indicador,
      "PAnoIni" => 0,
      "PAnoFin" => 0,
      "POrden" => "DESC",
      "PIdioma" => "ES"
    );

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

    //var_dump($responseData);
    return $responseData;
}

function clasificaciones($indicador){
  $ch = curl_init();

  $data = array (
    "PCveInd" => $indicador,
    "POpcion" => "Cl",
    "PIdioma" => "ES"
    );

    // Setup cURL
    $ch = curl_init('https://ods.org.mx/API/AtrIndicador/PorDesglose');
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

    //var_dump($responseData);
    return $responseData;
}

function datosMetadato($indicador){
  $ch = curl_init();

  $data = array (
      "PCveInd" => $indicador,
      "PIdioma" => "ES"
    );

    // Setup cURL
    $ch = curl_init('https://ods.org.mx/API/Metadato/PorClave');
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

    //var_dump($responseData);
    return $responseData;
}



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


function get_tabulado($indicador){

    $class = clasificaciones($indicador);

    $clasif = $class['AgrupaClas']['TotalNivAgrupa_cla'];
    //var_dump($clasif);

    $valores = datos($indicador);

    switch($valores['TipoCua_atr']){
      case 'CoS':
        $t = creaXLSCoS(datos($indicador));
      break;
      case 'CoCl':
        if($clasif > 1){
          $t = creaXLSCoClAnidada(datos($indicador));
        }else{
          $t = creaXlSCoCl(datos($indicador));
        }
      break;
      case 'ACl':
        if($clasif > 1){
          $t = creaXLSAClanidada(datos($indicador));
        }else{
          $t = creaXLSACl(datos($indicador));
        }
      break;
      case 'AS':
        $t = creaXLSAS(datos($indicador));
      break;
      case 'ClA':
        $t = creaXLSClA(datos($indicador));
      break;
    }
    return $t;
}

get_tabulado(366);


// ----------- Crea todos los XLS de Metadatos ---------//

// for ($i=0; $i < count($ClaveInd_arb); $i++) {
//   metadato(datosMetadato($ClaveInd_arb[$i]));
// }

// ----------- Crea todos los CSV de Metadatos ---------//

// for ($i=0; $i < count($ClaveInd_arb); $i++) {
//   metadatoCSV(datosMetadato($ClaveInd_arb[$i]));
// }



//creaXLSCoS(datos(26));


//metadato(datosMetadato(26));


function abecedario($posicion){
  $arr = array();
  for($i=65; $i<=90; $i++) {
    $letra = chr($i);
    $arr[] = $letra;
  }
  for($j=65; $j<=90; $j++) {
    $letra2 = chr($j);
    $arr[] = 'A'.$letra2;
  }
  for ($k=65; $k <=90 ; $k++) {
    $letra3 = chr($k);
    $arr[] = 'B'.$letra3;
  }
  for ($l=65; $l <=90 ; $l++) {
    $letra4 = chr($l);
    $arr[] = 'C'.$letra4;
  }
  for ($m=65; $m <=90 ; $m++) {
    $letra5 = chr($m);
    $arr[] = 'D'.$letra5;
  }
  for ($n=65; $n <=90 ; $n++) {
    $letra6 = chr($n);
    $arr[] = 'E'.$letra6;
  }
  for ($o=65; $o <=90 ; $o++) {
    $letra7 = chr($o);
    $arr[] = 'F'.$letra7;
  }
  for ($p=65; $p <=90 ; $p++) {
    $letra8 = chr($p);
    $arr[] = 'G'.$letra8;
  }
  //var_dump($arr);
  return $arr[$posicion];
}

function metadato($data){
  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Algoritmo_ft'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  //$metadato = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A1', $data['Algoritmo_ft'].$data['Descrip_ind']);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Objetivo');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Meta');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Nombre del Indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Definición');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'Tipo de Indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', 'Algoritmo');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Descripción narrativa del cálculo del indiciador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', 'Unidad de medida');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A10', 'Cobertura geográfica');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'Referencia temporal');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'Oportunidad');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A13', 'Periodicidad del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', 'Fuente generadora de la información estadística utilizada para el cálculo del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', 'Fecha de actualización del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'Fecha de próxima actualización del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', 'Unidad de Estado (UE) responsable de calcular el indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A18', 'Importancia y utilidad del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A19', 'Referencia nacional y/o internacional');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A20', 'Observaciones');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A21', 'Contacto');


  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', $data['Descrip_obj']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', $data['Descrip_met']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', $data['Descrip_ind']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', $data['Definicion_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6', $data['DesTipoInd_ft']);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B7', $data['Algoritmo_ft']);
    // Create new picture object and insert picture
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('Algoritmo'.$data['Algoritmo_ft']);
  $objDrawing->setDescription('Image');
  $objDrawing->setPath('./img/algoritmos/'.$data['Algoritmo_ft'].'.gif');
  $objDrawing->setHeight(200);
  $objDrawing->setCoordinates('B7');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

  // Add a drawing to the header
  $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
  $objDrawing->setName('Algoritmo'.$data['Algoritmo_ft']);
  $objDrawing->setPath('./img/algoritmos/'.$data['Algoritmo_ft'].'.gif');
  $objDrawing->setHeight(200);
  $objPHPExcel->getActiveSheet()->getHeaderFooter()->addImage($objDrawing, PHPExcel_Worksheet_HeaderFooter::IMAGE_HEADER_LEFT);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B8', $data['DescripCal_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9', $data['Descrip_uni']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B10', $data['Descrip_fdg']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B11', $data['CobTem_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B12', $data['Oportunidad_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B13', $data['Descrip_per']);

  $fuen = '';
  $fuente = $data['Fuente'];
    for ($i=0; $i < count($fuente); $i++) {
      $fuen .= $fuente[$i]['Descrip_fue'];
    }
  //var_dump($fuen);
  $wizard = new PHPExcel_Helper_HTML;
  $richText = $wizard->toRichTextObject($fuen);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B14', utf8_decode($richText));// Array
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B15', $data['FechaAct_atr']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', $data['FecProxAct_eic']);

    $resp = '';
    $responsable = $data['InsResp'];
    for ($j=0; $j < count($responsable); $j++) {
      $resp .= $responsable[$j]['Descrip_ins'] . '<br />' . $responsable[$j]['Abrevia_ins'] . '<br />' . (($responsable[$j]['URL_ins'] == '' || $responsable[$j]['URL_ins'] == null) ? '' : $responsable[$j]['URL_ins']) . '<br /><br />';
    }

    $wizard2 = new PHPExcel_Helper_HTML;
    $richText2 = $wizard2->toRichTextObject($resp);

    //var_dump($resp);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B17', utf8_decode($richText2));//Array


  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $data['Importancia_ft']);


  $ref = '';
  $refs = $data['RefInt'];
  for ($k=0; $k < count($refs); $k++) {
    $ref .= $refs[$k]['Descrip_ri'] . '<br /><br />';
  }

  $wizard3 = new PHPExcel_Helper_HTML;
  $richText3 = $wizard3->toRichTextObject($ref);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', utf8_decode($richText3));//Array
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B20', $data['Observacion_ft']);

  $con = '';
  $contacto = $data['Contacto'];
  for ($l=0; $l < count($contacto); $l++) {
    $con .= $contacto[$l]['Nombre_con'] . '<br />' . $contacto[$l]['Puesto_con'] . '<br /> <b>Teléfono:</b> ' . $contacto[$l]['Telefono_con'] . '<br /> <b>Email:</b> ' . $contacto[$l]['Correo_con'] . '<br /> <b>Dirección:</b> ' . $contacto[$l]['Domicilio_con'].'<br /><br />';
  }
  $wizard4 = new PHPExcel_Helper_HTML;
  $richText4 = $wizard4->toRichTextObject($con);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B21', utf8_decode($richText4));//Array

  $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
  $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(200);
  $objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('19')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('20')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('21')->setRowHeight(-1);

   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setBold(true);
   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setSize(18);
   $objPHPExcel->getActiveSheet()->getStyle('A1:B25')->getAlignment()->setWrapText(true);

  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Algoritmo_ft'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('xlscsv/Metadato_'.$data['Algoritmo_ft'].'.xlsx');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}

function metadatoCSV($data){
  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Algoritmo_ft'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  //$metadato = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A1', $data['Algoritmo_ft'].$data['Descrip_ind']);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Objetivo');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Meta');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Nombre del Indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Definición');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'Tipo de Indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', 'Algoritmo');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Descripción narrativa del cálculo del indiciador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', 'Unidad de medida');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A10', 'Cobertura geográfica');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'Referencia temporal');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', 'Oportunidad');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A13', 'Periodicidad del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', 'Fuente generadora de la información estadística utilizada para el cálculo del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', 'Fecha de actualización del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'Fecha de próxima actualización del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', 'Unidad de Estado (UE) responsable de calcular el indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A18', 'Importancia y utilidad del indicador');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A19', 'Referencia nacional y/o internacional');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A20', 'Observaciones');
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A21', 'Contacto');


  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', $data['Descrip_obj']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', $data['Descrip_met']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', $data['Descrip_ind']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', $data['Definicion_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6', $data['DesTipoInd_ft']);
  //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B7', $data['Algoritmo_ft']);
    // Create new picture object and insert picture
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setName('Algoritmo'.$data['Algoritmo_ft']);
  $objDrawing->setDescription('Image');
  $objDrawing->setPath('./img/algoritmos/'.$data['Algoritmo_ft'].'.gif');
  $objDrawing->setHeight(200);
  $objDrawing->setCoordinates('B7');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

  // Add a drawing to the header
  $objDrawing = new PHPExcel_Worksheet_HeaderFooterDrawing();
  $objDrawing->setName('Algoritmo'.$data['Algoritmo_ft']);
  $objDrawing->setPath('./img/algoritmos/'.$data['Algoritmo_ft'].'.gif');
  $objDrawing->setHeight(200);
  $objPHPExcel->getActiveSheet()->getHeaderFooter()->addImage($objDrawing, PHPExcel_Worksheet_HeaderFooter::IMAGE_HEADER_LEFT);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B8', $data['DescripCal_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B9', $data['Descrip_uni']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B10', $data['Descrip_fdg']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B11', $data['CobTem_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B12', $data['Oportunidad_ft']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B13', $data['Descrip_per']);

  $fuen = '';
  $fuente = $data['Fuente'];
    for ($i=0; $i < count($fuente); $i++) {
      $fuen .= $fuente[$i]['Descrip_fue'];
    }
  //var_dump($fuen);
  $wizard = new PHPExcel_Helper_HTML;
  $richText = $wizard->toRichTextObject($fuen);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B14', utf8_decode($richText));// Array
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B15', $data['FechaAct_atr']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B16', $data['FecProxAct_eic']);

    $resp = '';
    $responsable = $data['InsResp'];
    for ($j=0; $j < count($responsable); $j++) {
      $resp .= $responsable[$j]['Descrip_ins'] . '<br />' . $responsable[$j]['Abrevia_ins'] . '<br />' . (($responsable[$j]['URL_ins'] == '' || $responsable[$j]['URL_ins'] == null) ? '' : $responsable[$j]['URL_ins']) . '<br /><br />';
    }

    $wizard2 = new PHPExcel_Helper_HTML;
    $richText2 = $wizard2->toRichTextObject($resp);

    //var_dump($resp);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B17', utf8_decode($richText2));//Array


  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B18', $data['Importancia_ft']);


  $ref = '';
  $refs = $data['RefInt'];
  for ($k=0; $k < count($refs); $k++) {
    $ref .= $refs[$k]['Descrip_ri'] . '<br /><br />';
  }

  $wizard3 = new PHPExcel_Helper_HTML;
  $richText3 = $wizard3->toRichTextObject($ref);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B19', utf8_decode($richText3));//Array
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B20', $data['Observacion_ft']);

  $con = '';
  $contacto = $data['Contacto'];
  for ($l=0; $l < count($contacto); $l++) {
    $con .= $contacto[$l]['Nombre_con'] . '<br />' . $contacto[$l]['Puesto_con'] . '<br /> <b>Teléfono:</b> ' . $contacto[$l]['Telefono_con'] . '<br /> <b>Email:</b> ' . $contacto[$l]['Correo_con'] . '<br /> <b>Dirección:</b> ' . $contacto[$l]['Domicilio_con'].'<br /><br />';
  }
  $wizard4 = new PHPExcel_Helper_HTML;
  $richText4 = $wizard4->toRichTextObject($con);

  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B21', utf8_decode($richText4));//Array

  $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
  $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(200);
  $objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('19')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('20')->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getRowDimension('21')->setRowHeight(-1);

   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setBold(true);
   $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setSize(18);
   $objPHPExcel->getActiveSheet()->getStyle('A1:B25')->getAlignment()->setWrapText(true);

  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Algoritmo_ft'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
  $objWriter->save('xlscsv/Metadato_'.$data['Algoritmo_ft'].'.csv');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}


function creaXLSCoS($data){

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Codigo_ind'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  $serie = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('B1', $data['Codigo_ind'].$data['Descrip_ind']);

  for ($i=0; $i < count($serie); $i++) {
    if($serie[$i]['Tipo_ser'] == 'R'){
      $coberturas = $serie[$i]['Coberturas'];
      //var_dump($coberturas);

      for ($j=0; $j < count($coberturas); $j++) {
        $cobertura = $coberturas[$j]['Descrip_cg'];
        $valores = $coberturas[$j]['ValorDato'];
        $celda = $j + 3;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$celda, $cobertura);

        for ($k=0; $k < count($valores); $k++) {
          $a = abecedario($k+1);
          $b = abecedario(count($valores)+1);
          // var_dump($valores[$k]);
          // var_dump($valores[$k]['Dato_Formato']);
          //$dato =  (string)$valores[$k]['Dato_Formato'];
          //var_dump($dato);

          //$dato =  '34.6';
          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue('A2', 'Entidad Federativa');

          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.'2', $valores[$k]['AADato_ser']);
          //$objPHPExcel->getActiveSheet()
            //          ->setCellValue($a.'3', $valores[$k]['Dato_ser']);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.$celda, $valores[$k]['Dato_Formato']);

          //$objPHPExcel->getActiveSheet()->setCellValueExplicit($a.'3', (string)$valores[$k]['Dato_Formato'], PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->mergeCells($a.'1:'.$b.'1');

          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.'2', count($valores));
        }
        //var_dump(count($dato));
        //var_dump($valores);
      }


    }else if($serie[$i]['Tipo_ser'] == 'I'){
      echo 'Tipo Insumo';
    }
  }

  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Codigo_ind'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  //$nomArc = $data['Codigo_ind']
  $objWriter->save('xlscsv/Indicador_'.$data['Codigo_ind'].'.xlsx');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}

function creaCSVCoS($data){

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Codigo_ind'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  $serie = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('B1', $data['Codigo_ind'].$data['Descrip_ind']);

  for ($i=0; $i < count($serie); $i++) {
    if($serie[$i]['Tipo_ser'] == 'R'){
      $coberturas = $serie[$i]['Coberturas'];
      //var_dump($coberturas);

      for ($j=0; $j < count($coberturas); $j++) {
        $cobertura = $coberturas[$j]['Descrip_cg'];
        $valores = $coberturas[$j]['ValorDato'];
        $celda = $j + 3;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$celda, $cobertura);

        for ($k=0; $k < count($valores); $k++) {
          $a = abecedario($k+1);
          $b = abecedario(count($valores)+1);
          // var_dump($valores[$k]);
          // var_dump($valores[$k]['Dato_Formato']);
          //$dato =  (string)$valores[$k]['Dato_Formato'];
          //var_dump($dato);

          //$dato =  '34.6';
          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue('A2', 'Entidad Federativa');

          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.'2', $valores[$k]['AADato_ser']);
          //$objPHPExcel->getActiveSheet()
            //          ->setCellValue($a.'3', $valores[$k]['Dato_ser']);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.$celda, $valores[$k]['Dato_Formato']);

          //$objPHPExcel->getActiveSheet()->setCellValueExplicit($a.'3', (string)$valores[$k]['Dato_Formato'], PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->mergeCells($a.'1:'.$b.'1');

          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.'2', count($valores));
        }
        //var_dump(count($dato));
        //var_dump($valores);
      }


    }else if($serie[$i]['Tipo_ser'] == 'I'){
      echo 'Tipo Insumo';
    }
  }

  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Codigo_ind'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
  $objWriter->save('xlscsv/Indicador_'.$data['Codigo_ind'].'.csv');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}

function creaXLSCoCl($data){

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Codigo_ind'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  $serie = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('B1', $data['Codigo_ind'].$data['Descrip_ind']);
  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A2', 'Entidad Federativa');



              $e = 2;
              $f = 2;

  for ($i=0; $i < count($serie); $i++) {
    if($serie[$i]['Tipo_ser'] == 'R'){
      $coberturas = $serie[$i]['Coberturas'];
      //var_dump($coberturas);

      for ($j=0; $j < count($coberturas); $j++) {
        $cobertura = $coberturas[$j]['Descrip_cg'];
        $valores = $coberturas[$j]['Clasificaciones'];
        $celda = $j + 4;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$celda, $cobertura);
        $per = array();
        for ($k=0; $k < count($valores); $k++) {
          $a = abecedario($k+1);
          $b = abecedario(count($valores)+1);


          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.'3', $valores[$k]['Descrip_cla']);
          // var_dump($valores[$k]);
          // var_dump($valores[$k]['Dato_Formato']);
          //$dato =  (string)$valores[$k]['Dato_Formato'];
          //var_dump($dato);

          //$dato =  '34.6';
          // $objPHPExcel->setActiveSheetIndex(0)
          //             ->setCellValue('A2', 'Entidad Federativa');


          $periodo = count($valores[$k]['ClaveAgrupa_ac']);
          $per[] = $valores[$k]['ClaveAgrupa_ac'];

          $valorDato = $valores[$k]['ValorDato'];
          $periodon = count($valores);
          //var_dump($periodon);
          //var_dump($periodo);
          $d = abecedario(count($valores)+count($periodo));
          //var_dump($valorDato);
          $c = abecedario(count($valorDato)+1);


          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);



          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue(abecedario($k+$periodo).'2', $valores[$k]['ValorDato']['AADato_ser']);
          //$objPHPExcel->getActiveSheet()
            //          ->setCellValue($a.'3', $valores[$k]['Dato_ser']);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.$celda, $valores[$k]['ValorDato']['Dato_Formato']);

          //$objPHPExcel->getActiveSheet()->setCellValueExplicit($a.'3', (string)$valores[$k]['Dato_Formato'], PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->mergeCells($a.'1:'.$b.'1'); // Merge para título de Indicador

            $objPHPExcel->getActiveSheet()->mergeCells('A2:A3');// Merge para Entidad Federativa

            //$objPHPExcel->getActiveSheet()->mergeCells($a.'2:'.$d.'2'); // Merge para periodo


            // $foo = count($valores) / $periodo;
            //   //var_dump(count($valorDato));
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

            //  $foo = count($valores) / count(array_unique($per));
            // //  var_dump($foo);
            // //  var_dump($per);
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.'2', count($valores));
        }
      }


    }else if($serie[$i]['Tipo_ser'] == 'I'){
      echo 'Tipo Insumo';
    }
  }

  //  $foo = count($valores) / count(array_unique($per));
  // //  var_dump($foo);
  // //  var_dump($per);
  // for ($m=1; $m < $foo; $m++) {
  //   $f = $f + $periodon;
  //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
  //   $e = $f+1;
  // }




  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Codigo_ind'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  //$nomArc = $data['Codigo_ind']
  $objWriter->save('xlscsv/Indicador_'.$data['Codigo_ind'].'.xlsx');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}

function creaCSVCoCl($data){

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Codigo_ind'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  $serie = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('B1', $data['Codigo_ind'].$data['Descrip_ind']);
  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A2', 'Entidad Federativa');



              $e = 2;
              $f = 2;

  for ($i=0; $i < count($serie); $i++) {
    if($serie[$i]['Tipo_ser'] == 'R'){
      $coberturas = $serie[$i]['Coberturas'];
      //var_dump($coberturas);

      for ($j=0; $j < count($coberturas); $j++) {
        $cobertura = $coberturas[$j]['Descrip_cg'];
        $valores = $coberturas[$j]['Clasificaciones'];
        $celda = $j + 4;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$celda, $cobertura);
        $per = array();
        for ($k=0; $k < count($valores); $k++) {
          $a = abecedario($k+1);
          $b = abecedario(count($valores)+1);


          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.'3', $valores[$k]['Descrip_cla']);
          // var_dump($valores[$k]);
          // var_dump($valores[$k]['Dato_Formato']);
          //$dato =  (string)$valores[$k]['Dato_Formato'];
          //var_dump($dato);

          //$dato =  '34.6';
          // $objPHPExcel->setActiveSheetIndex(0)
          //             ->setCellValue('A2', 'Entidad Federativa');


          $periodo = count($valores[$k]['ClaveAgrupa_ac']);
          $per[] = $valores[$k]['ClaveAgrupa_ac'];

          $valorDato = $valores[$k]['ValorDato'];
          $periodon = count($valores);
          //var_dump($periodon);
          //var_dump($periodo);
          $d = abecedario(count($valores)+count($periodo));
          //var_dump($valorDato);
          $c = abecedario(count($valorDato)+1);


          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);



          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue(abecedario($k+$periodo).'2', $valores[$k]['ValorDato']['AADato_ser']);
          //$objPHPExcel->getActiveSheet()
            //          ->setCellValue($a.'3', $valores[$k]['Dato_ser']);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.$celda, $valores[$k]['ValorDato']['Dato_Formato']);

          //$objPHPExcel->getActiveSheet()->setCellValueExplicit($a.'3', (string)$valores[$k]['Dato_Formato'], PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->mergeCells($a.'1:'.$b.'1'); // Merge para título de Indicador

            $objPHPExcel->getActiveSheet()->mergeCells('A2:A3');// Merge para Entidad Federativa

            //$objPHPExcel->getActiveSheet()->mergeCells($a.'2:'.$d.'2'); // Merge para periodo


            // $foo = count($valores) / $periodo;
            //   //var_dump(count($valorDato));
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

            //  $foo = count($valores) / count(array_unique($per));
            // //  var_dump($foo);
            // //  var_dump($per);
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.'2', count($valores));
        }
      }


    }else if($serie[$i]['Tipo_ser'] == 'I'){
      echo 'Tipo Insumo';
    }
  }

  //  $foo = count($valores) / count(array_unique($per));
  // //  var_dump($foo);
  // //  var_dump($per);
  // for ($m=1; $m < $foo; $m++) {
  //   $f = $f + $periodon;
  //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
  //   $e = $f+1;
  // }




  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Codigo_ind'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
  //$nomArc = $data['Codigo_ind']
  $objWriter->save('xlscsv/Indicador_'.$data['Codigo_ind'].'.csv');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}

function creaXLSCoClAnidada($data){

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Mexico_City');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

  // Create new PHPExcel object
  //echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  //echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Agenda2030")
  							 ->setLastModifiedBy("Daniel H. Vargas")
  							 ->setTitle("Objetivo")
  							 ->setSubject($data['Codigo_ind'].$data['Descrip_ind'])
  							 ->setDescription("Archivo creado para la Descarga Masiva de Agenda 2030")
  							 ->setKeywords("agenda2030 descarga masiva xls")
  							 ->setCategory("Objetivos de Desarrollo Sostenible");


  $serie = $data['Series'];
  //var_dump($serie);
  $objPHPExcel->setActiveSheetIndex(0);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('B1', $data['Codigo_ind'].$data['Descrip_ind']);
  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A2', 'Entidad Federativa');

              $e = 2;
              $f = 2;

  for ($i=0; $i < count($serie); $i++) {
    if($serie[$i]['Tipo_ser'] == 'R'){
      $coberturas = $serie[$i]['Coberturas'];
      //var_dump($coberturas);

      for ($j=0; $j < count($coberturas); $j++) {
        $cobertura = $coberturas[$j]['Descrip_cg'];
        $valores = $coberturas[$j]['Clasificaciones'];
        $celda = $j + 5;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$celda, $cobertura);
        $per = array();
        for ($k=0; $k < count($valores); $k++) {
          $a = abecedario($k+1);
          $b = abecedario(count($valores)+1);


          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.'4', $valores[$k]['Descrip_cla']);
          // var_dump($valores[$k]);
          // var_dump($valores[$k]['Dato_Formato']);
          //$dato =  (string)$valores[$k]['Dato_Formato'];
          //var_dump($dato);

          //$dato =  '34.6';
          // $objPHPExcel->setActiveSheetIndex(0)
          //             ->setCellValue('A2', 'Entidad Federativa');


          $periodo = count($valores[$k]['ClaveAgrupa_ac']);
          $per[] = $valores[$k]['ClaveAgrupa_ac'];

          $valorDato = $valores[$k]['ValorDato'];
          $periodon = count($valores);
          //var_dump($periodon);
          //var_dump($periodo);
          $d = abecedario(count($valores)+count($periodo));
          //var_dump($valorDato);
          $c = abecedario(count($valorDato)+1);


          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);



          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue(abecedario($k+$periodo).'2', $valores[$k]['ValorDato']['AADato_ser']);
          //$objPHPExcel->getActiveSheet()
            //          ->setCellValue($a.'3', $valores[$k]['Dato_ser']);

          $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue($a.$celda, $valores[$k]['ValorDato']['Dato_Formato']);

          //$objPHPExcel->getActiveSheet()->setCellValueExplicit($a.'3', (string)$valores[$k]['Dato_Formato'], PHPExcel_Cell_DataType::TYPE_STRING);

            $objPHPExcel->getActiveSheet()->mergeCells($a.'1:'.$b.'1'); // Merge para título de Indicador

            $objPHPExcel->getActiveSheet()->mergeCells('A2:A5');// Merge para Entidad Federativa

            //$objPHPExcel->getActiveSheet()->mergeCells($a.'2:'.$d.'2'); // Merge para periodo


            // $foo = count($valores) / $periodo;
            //   //var_dump(count($valorDato));
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

            //  $foo = count($valores) / count(array_unique($per));
            // //  var_dump($foo);
            // //  var_dump($per);
            // for ($m=1; $m < $foo; $m++) {
            //   $f = $f + $periodon;
            //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
            //   $e = $f+1;
            // }

          //$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.'2', count($valores));
        }
      }


    }else if($serie[$i]['Tipo_ser'] == 'I'){
      echo 'Tipo Insumo';
    }
  }

  //  $foo = count($valores) / count(array_unique($per));
  // //  var_dump($foo);
  // //  var_dump($per);
  // for ($m=1; $m < $foo; $m++) {
  //   $f = $f + $periodon;
  //   $objPHPExcel->getActiveSheet()->mergeCells(abecedario($e).'2:'.abecedario($f).'2'); // Merge para periodo
  //   $e = $f+1;
  // }




  // Rename worksheet
  //echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle(substr($data['Codigo_ind'].$data['Descrip_ind'], 0, 31));

  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  // Save Excel 2007 file
  //echo date('H:i:s') , " Write to Excel format" , EOL;
  $callStartTime = microtime(true);

  // Use PCLZip rather than ZipArchive to create the Excel2007 OfficeOpenXML file
  PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  //$nomArc = $data['Codigo_ind']
  $objWriter->save('xlscsv/Indicador_'.$data['Codigo_ind'].'.xlsx');
  // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  //echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  //echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo memory peak usage
  //echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  //echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;
  //var_dump($data);
}





//tabla para cobertura series
function tablaCoS($data){
  $tabuladoCoS =  '<table class="striped tablaArmada"><thead><tr>';
  $cabezera =  false;
  for ($i = 0; $i < count($data['Coberturas']); $i++) {

    //tomamos las cabezeras, años del primer dato
    if(!$cabezera){
      $tabuladoCoS .= '<th> Entidad Federativa </th>';
      for ($j = 0; $j < $data.Coberturas[$i].ValorDato.length; $j++) {
        $tabuladoCoS .= '<th>' . $data.Coberturas[$i].ValorDato[$j].AADato_ser . '</th>';
      }//fin for j
      $cabezera = true;
    }

    $tabuladoCoS .= '</tr></thead><tr><td>' . '<span style="display:none;">'.$data.Coberturas[$i].ClaveCobGeo_cg. '</span>' . $data.Coberturas[$i].Descrip_cg .'</td>';
    for ($j = 0; $j < $data.Coberturas[$i].ValorDato.length; $j++) {
      if($data.Coberturas[$i].ValorDato[$j].Dato_Formato == ""){
        $tabuladoCoS .= '<td> ND </td>';
      }else{
        $tabuladoCoS .= '<td>' + $data.Coberturas[$i].ValorDato[$j].Dato_Formato + '</td>';
      }
    }//fin for j
    $tabuladoCoS .= '</tr>';
  }//fin for i
    $tabuladoCoS .= '</table>';

    //$('#tabla').html(tabuladoCoS);
    return $tabuladoCoS;
}//fin funcion

function tablaCoCl($data){
  $tabuladoCoCl  =  '';
  $cabezera      =  false;
  $years         =  [];

  for ($i = 0; $i < $data.Coberturas.length; $i++) {
    if(!$cabezera){
      $total_columnas = 0;
      //tabuladoCoCl  +=  '<tr><th rowspan="2"> Entidades federativas </th>';
      $tabuladoCoCl  .=  '<tr>';
      for ($j = 0; $j < data.Coberturas[$i].Clasificaciones.length; $j++) {
        $years.push($data.Coberturas[$i].Clasificaciones[$j].ValorDato.AADato_ser);

        $tabuladoCoCl  .=  '<th> ' + $data.Coberturas[$i].Clasificaciones[$j].Descrip_cla + '</th>';

        $total_columnas++;
      }//fin for j

      $tabuladoCoCl  .=  '</tr></thead>';
      $years = $years.unique();
      $cabezera = true;
      $subTabulado = '<table class="tablaArmada striped "><thead><tr><th rowspan="2"> Entidad Federativa</th>';
      $sizeYear =  $total_columnas/$years.length;
      for ($k = 0; $k < $years.length; $k++) {
        $subTabulado .=  '<th colspan="'+ $sizeYear +'">' + $years[$k] +'</th>';
      }//fin for k
      $subTabulado .= '</tr>';

      $tabuladoCoCl =   $subTabulado +' '+ $tabuladoCoCl;
    }//fin if condicion cabezera

    $tabuladoCoCl   .=  '<tr ><td>' +  '<span style="display:none;">'+$data.Coberturas[$i].ClaveCobGeo_cg+ '</span>' + $data.Coberturas[$i].Descrip_cg +'</td>';
    for ($j = 0; $j < $data.Coberturas[$i].Clasificaciones.length; $j++) {
      if($data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato == ""){
        $tabuladoCoCl   .=  '<td> ND </td>';
      }else{
        $tabuladoCoCl   .=  '<td>'+ $data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato +'</td>';
      }
    }//fin for j
      $tabuladoCoCl   .= '</tr>';
  }//fin for i
    $tabuladoCoCl   .= '</table>';
    //$('#tabla').html(tabuladoCoCl);
    return $tabuladoCoCl;
}//fin de la funsion

function AClanidada($data){
  $labelYear = '';
  $tabuladoAnidado =  '';
  $subTabuladoAnidado =  '<table class="tablaArmada2 centered striped "><thead>';
  $primera = true;
  $cabezera =  false;
  $labels   = [];

  for ($i = 0; $i < $data.Coberturas[0].Clasificaciones.length; $i++) {
    $labels.push(data.Coberturas[0].Clasificaciones[$i].Descrip_cla);

    if($labelYear == $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser){
        $tabuladoAnidado .= '<td>' + $data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato + '</td>';
    }else if($primera){
      $primera=false;
      $tabuladoAnidado .= '<tr><td>'+ data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser +'</td><td>'+data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato+'</td>';
      $labelYear = $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser;
    }
    else{
      $tabuladoAnidado .= '</tr><tr><td>'+ $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser +'</td><td>'+$data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato+'</td>';
      $labelYear = $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser;
    }
  }//fin for i
  $tabuladoAnidado +=  '</tr></table>';
  $labels =  $labels.unique();
  $subTabuladoAnidado .= '<tr><td rowspan="2">Periodo</td><td colspan="'+ $labels.length +'">Total</td><td colspan="'+ $labels.length +'">Hombres</td><td colspan="'+ $labels.length +'">Mujeres</td></tr>';
  $subTabuladoAnidado .= '<tr>';
  for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < $labels.length; $j++) {
        $subTabuladoAnidado += '<td>'+$labels[$j]+'</td>';
    }
  }
  $subTabuladoAnidado .= '</tr></thead>';
  $tabuladoAnidado = $subTabuladoAnidado + $tabuladoAnidado;
  //$('#tabla').html(tabuladoAnidado);
  return $tabuladoAnidado;
}

function tablaACl($data){
  $labelYear = '';
  $tabuladoAnidado =  '';
  $subTabuladoAnidado =  '<table class="striped tablaArmada"><thead>';
  $primera = true;
  $cabezera =  false;
  $labels   = [];

  for ($i = 0; $i < data.Coberturas[0].Clasificaciones.length; $i++) {

    $labels.push($data.Coberturas[0].Clasificaciones[$i].Descrip_cla);

    if($labelYear == $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser){
        $tabuladoAnidado .= '<td>' + $data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato + '</td>';
    }else if($primera){
      $primera=false;
      $tabuladoAnidado .= '<tr><td>'+ $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser +'</td><td>'+$data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato+'</td>';
      $labelYear = $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser;
    }
    else{
      $tabuladoAnidado .= '</tr><tr><td>'+ $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser +'</td><td>'+$data.Coberturas[0].Clasificaciones[$i].ValorDato.Dato_Formato+'</td>';
      $labelYear = $data.Coberturas[0].Clasificaciones[$i].ValorDato.AADato_ser;
    }
  }//fin for i
  $tabuladoAnidado .=  '</tr></table>';

  $labels =  $labels.unique();

  $subTabuladoAnidado .= '<tr><td>Periodo</td>';

    for ($j = 0; $j < $labels.length; $j++) {
        $subTabuladoAnidado .= '<td>'+$labels[$j]+'</td>';
    }

  $subTabuladoAnidado .= '</tr></thead>';
  $tabuladoAnidado = $subTabuladoAnidado + $tabuladoAnidado;
  //$('#tabla').html(tabuladoAnidado);
  return $tabuladoAnidado;
}

function tablaAS($data){
  $tabuladoAS =  '<table class="tablaArmada centered striped "><thead><tr><th>Periodo</th><th>'+ $data.Descrip_ser +'</th></tr></thead>';
  for ($i = 0; $i < $data.Coberturas.length; $i++) {
    for ($j = 0; $j < $data.Coberturas[$i].ValorDato.length; $j++) {
      $tabuladoAS .= '<tr><td>'+ $data.Coberturas[$i].ValorDato[$j].AADato_ser   +'</td><td>' + $data.Coberturas[$i].ValorDato[$j].Dato_Formato +'</td></tr>';
    }//fin for J
  }//fin for i
  $tabuladoAS .= '</table>';
  //$('#tabla').html(tabuladoAS);
  return $tabuladoAS;
}

function tablaClA($data){
  $tabuladoClA =  '<table class="tablaArmada striped"><thead><tr><th>'+ $data.Descrip_ind +'</th><th>'+ $data.Coberturas[0].Clasificaciones[0].ValorDato.AADato_ser+'</th></tr></thead>';
  for ($i = 0; $i < data.Coberturas.length; $i++) {
    for ($j = 0; $j < $data.Coberturas[$i].Clasificaciones.length; $j++) {
      if($data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato == ""){
        $tabuladoClA .= '<tr><td>'+ $data.Coberturas[$i].Clasificaciones[$j].Descrip_cla   +'</td><td> ND </td></tr>';
      }else{
        $tabuladoClA .= '<tr><td>'+ $data.Coberturas[$i].Clasificaciones[$j].Descrip_cla   +'</td><td>' + $data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato +'</td></tr>';
      }
    }//fin for J
  }//fin for i
  $tabuladoClA .= '</table>';
  // $('#tabla').html(tabuladoClA);
  return $tabuladoClA;
}

function CoClanidada($data){
  $tabulado =  '';
  $subTabuladoAnidado =  '<table class="tablaArmada striped"><thead>';
  $cabezera =  false;
  $clasificaciones = [];
  $years = [];
  $clasificaciones_diferentes;

  for ($i = 0; $i < $data.Coberturas.length; $i++) {
    if(!$cabezera){
      for ($j = 0; $j < $data.Coberturas[$i].Clasificaciones.length; $j++) {
        $years.push($data.Coberturas[$i].Clasificaciones[$j].ValorDato.AADato_ser);
        $clasificaciones.push($data.Coberturas[$i].Clasificaciones[$j].Descrip_cla);
      }
      $years = $years.unique();
      $clasificaciones_diferentes = $clasificaciones.unique().length;

      $cabezera = true;
    }

    $tabulado .= '<tr><td>'+  '<span style="display:none;">'+$data.Coberturas[$i].ClaveCobGeo_cg+ '</span>' + $data.Coberturas[$i].Descrip_cg + '</td>';
    for ($j = 0; $j < $data.Coberturas[$i].Clasificaciones.length; $j++) {
      if($data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato == ""){
          $tabulado .= '<td> ND </td>';
      }else{
        $tabulado .= '<td>' + $data.Coberturas[$i].Clasificaciones[$j].ValorDato.Dato_Formato + '</td>';
      }
    }
    $tabulado .= '</tr>' ;
  }//fin for i
  $tabulado .= '</table>';
  $total = (($clasificaciones.length) / $clasificaciones_diferentes ) / 3;
  $a = $clasificaciones.length / $years.length;

  $subTabuladoAnidado .=  '<tr><th rowspan="3">Entidad Federativa</th>';

  for ($i = 0; i < $years.length; $i++) {
    $subTabuladoAnidado .= '<th colspan="'+ $a +'">'+ $years[$i]+'</th>';
  }

  $subTabuladoAnidado .=  '</tr><tr>';

  for ($i = 0; $i < $total; $i++) {
      $subTabuladoAnidado .=  '<th colspan="'+$clasificaciones_diferentes+'">Total</th><th colspan="'+$clasificaciones_diferentes+'">Hombres</th><th colspan="'+$clasificaciones_diferentes+'">Mujeres</th>';
  }
  $subTabuladoAnidado .=  '</tr><tr>';
  for ($i = 0; $i < $clasificaciones.length; $i++) {
    $subTabuladoAnidado .=  '<th>'+ $clasificaciones[$i]+'</th>';
  }

  $subTabuladoAnidado .=  '</tr>';
  $tabulado =  $subTabuladoAnidado+'</thead>'+ $tabulado;
  //$('#tabla').html(tabulado);
  return $tabulado;
}

?>
