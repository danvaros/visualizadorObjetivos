<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Objetivos de Desarrollo Sostenible</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="css/ffont-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,800,300,600italic,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <style media="screen">

[type="checkbox"]:not(:checked), [type="checkbox"]:checked{

  left: 0;
    opacity: 1;
    position: relative;
}



    a.selected {
      background-color:#1F75CC;
      color:white;
      z-index:100;
      right:0;
      bottom:15%;
      position:absolute;
    }
     #contact{
       position: absolute;
        right: 0;
        bottom: 15%;
        background:#EFD331;
        color:#ffffff;
        padding:5px 10px;
        text-decoration:none;
        z-index: 99;
     }

     #contact img{
       padding: 8px;
       max-width: 64px;
     }

    .disclaimer {
      background-color:#FFFFFF;
      cursor:default;
      display:none;
      margin-top: 0px;
      position:absolute;
      text-align:left;
      width:394px;
      z-index:50;
      padding: 15px 25px;
      right:84px;
      bottom:15%;
      z-index: 99999;
    }

    label {
      display: block;
      margin-bottom: 3px;
      padding-left: 15px;
      text-indent: -15px;
    }


    .disclaimer p, .disclaimer.div {
      margin: 8px 0;
      padding-bottom: 8px;
      font-family:'Helvetica';
      font-weight:300;
      text-align:justify;
    }

    .disclaimer h1{
      font-size:30px;
      font-family:'Helvetica';
      font-weight:800;
    }

        .ns{
            background-color: #afaaaa;
            color: black;
            border-radius: 5px;
        }

        .fond{
          color: #6a6565 !important;
        }

        .fond_global{
          color: #2d8670 !important;
          font-weight: normal !important;
        }

        .borde_b{
          border-top: solid 1px #afaaaa;
        }
           #loader {
      display: block;
      background: rgba(62, 60, 60, 0.6);
      color: white;
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 10000;
    }

  #loader p {
      display: block;
      font-size: 40px;
      position: absolute;
      top: -70px;
      /* left: 0; */
      bottom: 0;
      right: 15px;
      color: #fff !important /*margin: auto;*/;
      text-align: right;
    }

     #loader p #tex{
      width: 300px;
    }

    #loaderDescarga {
display: block;
background: rgba(62, 60, 60, 0.6);
color: white;
width: 100%;
height: 100%;
position: fixed;
top: 0;
left: 0;
z-index: 10000;
}

#loaderDescarga p {
display: block;
font-size: 40px;
position: absolute;
top: -70px;
/* left: 0; */
bottom: 0;
right: 15px;
color: #fff !important /*margin: auto;*/;
text-align: right;
}

#loaderDescarga p #tex{
width: 300px;
}

    form p{
      margin:15px;
    }


    </style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <!-- <script src="lib/jquery.table2excel.js"></script>
    <script src="lib/jquery.tabletoCSV.js"></script> -->
    <!-- <script type="text/javascript" src="lib/tableExport.js"></script>
    <script type="text/javascript" src="lib/jquery.base64.js"></script> -->
    <script src="lib/table2download.js"></script>

    <span id="loader">
    <p style="color:#333; padding-top: 100px; ">Cargando<br>información</p>
  </span>
  <span id="loaderDescarga">
  <p style="color:#333; padding-top: 100px; ">Generando archivos<br>para su descarga</p>
</span>
<script>

$('#loader').show();
$('#loaderDescarga').hide();
</script>


  </head>
  <body>

    <!-- menu -->
    <div class="navbar-fixed">
      <nav>
        <div class=" container nav-wrapper" style="margin-top:0px;">
          <a href="index.html" class="brand-logo"><img src="img/icono_header.svg" alt="" /></a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down nav_sticky">
            <li class="tam t_sm"><a class="t_sm" href="objetivos.html">Indicadores</a></li>
             <li class="tam t_sm"><a href="estado_detalle.html" style="line-height: 21px; padding-top: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;Indicadores con<br>desglose geográfico</a></li>
            <!--
            <li class="tam t_sm"><a class="t_sm" href="como_vamos.html">¿C&oacute;mo vamos?</a></li> -->
            <li class="tam t_sm"><a class="t_sm" href="explora.html">Explora</a></li>
            <!-- <li class="tam t_sm"><a class="t_sm" href="compara.html">Compara</a></li> -->
            <li class="tamps">
              <a id="buscar"><img src="img/search.png" alt="" /></a>
              <input id="cam_bus" type="text" name="buscar" style="display: none; background-color: rgba(0, 0, 0, 0.4); background-position: 95% 50%; background-repeat: no-repeat;border-bottom: 0 none; border-radius: 8px;color: #ffffff !important;padding: 0 0px;height:35px;" onfocusout="esconder()"/>
            </li>
            <li class="tamps">
              <a id="busca" href="calendario.html"><img data-position="bottom" data-tooltip="Ir al calendario de actualizaciones" class="tooltipped" src="img/calendario.png" alt="" /></a>
            </li>
            <!-- <li class="tamps">
              <a id="busca" href="exportacion.html"><img data-position="bottom" data-tooltip="Ir a la página de descargas masivas" class=" tooltipped" src="img/descarga.png"
                  alt="" /></a>
            </li> -->
          </ul>
          <ul class="side-nav" id="mobile-demo">
          <li><a href="index.html">Inicio</a></li>
            <li><a href="objetivos.html">Indicadores</a></li>
            <li><a href="estado_detalle.html">Indicadores por unidad geográfica</a></li>
           <!--  <li><a href="como_vamos.html">¿C&oacute;mo vamos?</a></li> -->
            <li><a href="explora.html">Explora</a></li>
            <!-- <li><a href="compara.html">Compara</a></li> -->
         <!--    <li class="tamps">
           <a id="busca" href="calendario.html">Calendario</a>
         </li> -->
          </ul>
        </div>
      </nav>
    </div>
<!-- menu -->


    <div class="container" id="objetivo0">
      <div class="row">
        <div class="col s12 l12">
          <h3 class="fuerte t_principal" id="desca">DESCARGA MASIVA</h3>
          <li class="divider"></li>
        </div>
        <div class="col s12 l12">
          <br />
          <h5>Elementos a exportar</h5>
          <br />
          <div class="input-field col s12 l3" style="margin-left:0px;">
            <select id="tipoSeleccion">
              <option id="indicadorDescarga" value="01" selected>Indicador</option>
              <option id="metadatoDescarga" value="02">Metadato</option>
              <option id="calculoDescarga" value="03">Datos para el cálculo</option>
            </select>
            <label>Selección</label>
            <!-- <input type="checkbox" id="indicadorDescarga" class="validate caja_d" style="padding-left: 12px;" checked>&nbsp;Indicador&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="metadatoDescarga" class="validate caja_d metadatoDescarga" style="padding-left: 12px;">&nbsp;Metadato&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="calculoDescarga" class="validate caja_d calculoDescarga" style="padding-left: 12px;">&nbsp;Datos para el cálculo&nbsp;&nbsp;&nbsp; -->
          </div>
          <div class="input-field col s12 l2">
                  <!-- <b>Formato:</b> -->
                  <select id="tipoFormato">
                    <option id="tipoXLS" value="xls" selected>XLS</option>
                    <option id="tipoCSV" value="csv">CSV</option>
                  </select>
                  <label>Formato</label>
                <!-- <input type="checkbox" id="tipoCSV" class="valdidate caja_d" name="formato" style="padding-left:12px;" checked />&nbsp;CSV&nbsp;&nbsp;&nbsp;
                <input type="checkbox" id="tipoXLS" class="valdidate caja_d" name="formato" style="padding-left:12px;" />&nbsp;XLS&nbsp;&nbsp;&nbsp; -->
          </div>
          <div class="input-field col s12 l2">
              <button id="enviaDescarga" class="valdidate caja_d waves-effect waves-light btn blue white-text" style="padding-left:12px;" >Descargar</button>
          </div>
        </div>
        <!-- <div class="col s12">
          <br>
          <div class="input-field col s10 l4" style="margin-left:15px;">
            <i class="material-icons prefix caja_i">search</i>
            <input id="icon_prefix" type="text" class="validate caja_d autocomplete" placeholder=" Buscar indicadores" style="padding-left: 12px;">
          </div>
        </div> -->
      </div>
      <div class="row">
        <form action="#">
        <div class="col s12">
          <ul id="objetivos" class="" data-collapsible="accordion">
           <li id="objetivo1" class="objetivos">
             <div id="fin_pobreza" class=" active fin_pobreza id_1" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_1">
                 <img class="ico_obj" src="img/ods-01.png" alt="" />
               </div>
               <span class="marg_obj t_sm" style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi1" style="padding-left: 12px;"> --> 1- Fin de la pobreza<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="fin_pobreza_cont">
                <div class="col s12">
                 <p>No se tiene indicadores disponibles para este objetivo</p>
                </div>
             </div>
           </li>
           <li id="objetivo2" class="objetivos">
             <div class=" active  id_2" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_2" id="id_2">
                 <img class="ico_obj" src="img/ods-02.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi2" style="padding-left: 12px;"> --> 2- Hambre cero<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="hambre_cero_cont">
               <div class="col s12">
                  <p>No se tiene indicadores disponibles para este objetivo</p>
                </div>
             </div>
           </li>
           <li id="objetivo3" class="objetivos">
             <div class=" id_3" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_3" id="id_3">
                 <img class="ico_obj" src="img/ods-03.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi3" style="padding-left: 12px;"> --> 3- Salud y bienestar<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class="back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="salud_bienestar_cont">
             </div>
           </li>
           <!-- <li id="objetivo4" class="objetivos">
             <div class=" id_4" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_4" id="id_4">
                 <img class="ico_obj" src="img/ods-04.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><input type="checkbox" class="validate caja_d indi4" style="padding-left: 12px;"> 4- Educación de calidad<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="educacion_calidad_cont">
               <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li> -->
           <li id="objetivo5" class="objetivos">
             <div class=" active id_5" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_5" id="id_5">
                 <img class="ico_obj ico_top" src="img/ods-05.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi5" style="padding-left: 12px;"> --> 5- Igualdad de género<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="igualdad_genero_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <li id="objetivo6" class="objetivos">
             <div class=" active id_6" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_6" id="id_6">
                 <img class="ico_obj ico_top" src="img/ods-06.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi6" style="padding-left: 12px;"> --> 6- Agua limpia y saneamiento<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="agua_limpia_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <li id="objetivo7" class="objetivos">
             <div class=" active id_7" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_7" id="id_7">
                 <img class="ico_obj" src="img/ods-07.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi7" style="padding-left: 12px;"> --> 7- Energía asequible y no contaminante<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="energia_esequible_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <li id="objetivo8" class="objetivos">
             <div class=" active id_8" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_8" id="id_8">
                 <img class="ico_obj" src="img/ods-08.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi8" style="padding-left: 12px;"> --> 8- Trabajo decente y crecimiento económico<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="trabajo_docente_cont">
                <div class="col s12">
                  <p>No se tiene indicadores disponibles para este objetivo</p>
                </div>
             </div>
           </li>
           <li id="objetivo9" class="objetivos">
             <div class=" active id_9" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_9" id="id_9">
                 <img class="ico_obj" src="img/ods-09.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi9" style="padding-left: 12px;"> --> 9- Industria, innovación e infraestructura<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="industria_innovacion_cont">
                <div class="col s12">
                  <p>No se tiene indicadores disponibles para este objetivo</p>
                </div>
             </div>
           </li>
           <li id="objetivo10" class="objetivos">
             <div class=" active id_10" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_10" id="id_10">
                 <img class="ico_obj" src="img/ods-10.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!-- <input type="checkbox" class="validate caja_d indi10" style="padding-left: 12px;"> --> 10- Reducción de las desigualdades<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="reduccion_desigualdades_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <!-- <li id="objetivo11" class="objetivos">
             <div class=" active id_11" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_11" id="id_11">
                 <img class="ico_obj" src="img/ods-11.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><input type="checkbox" class="validate caja_d indi11" style="padding-left: 12px;"> 11- Ciudades y comunidades sustentables<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="ciudades_comunidades_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <li id="objetivo12" class="objetivos">
             <div class=" active id_12" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_12" id="id_12">
                 <img class="ico_obj" src="img/ods-12.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><input type="checkbox" class="validate caja_d indi12" style="padding-left: 12px;"> 12- Producción y consumo responsables<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="produccion_consumo_cont">
                <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li>
           <li id="objetivo13" class="objetivos">
             <div class=" active id_13" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_13" id="id_13">
                 <img class="ico_obj" src="img/ods-13.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><input type="checkbox" class="validate caja_d indi13" style="padding-left: 12px;"> 13- Acción por el clima<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="accion_clima_cont">
               <div class="row" >
                  <div class="col s1"></div>
                  <div class="col s11">
                    <p>No se tiene indicadores disponibles para este objetivo</p>
                  </div>
                </div>
             </div>
           </li> -->
           <li id="objetivo14" class="objetivos">
             <div class=" active id_14" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_14" id="id_14">
                 <img class="ico_obj" src="img/ods-14.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!--<input type="checkbox" class="validate caja_d indi14" style="padding-left: 12px;">--> 14- Vida submarina<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="vida_submarina_cont">
              <div class="col s12">
                <p>No se tiene indicadores disponibles para este objetivo</p>
              </div>
             </div>
           </li>
           <li id="objetivo15" class="objetivos">
             <div class=" active id_15" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_15" id="id_15">
                 <img class="ico_obj" src="img/ods-15.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!--<input type="checkbox" class="validate caja_d indi15" style="padding-left: 12px;">--> 15- Vida de ecosistemas terrestres<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="vida_ecosistemas_cont">
              <div class="col s12">
                <p>No se tiene indicadores disponibles para este objetivo</p>
              </div>
             </div>
           </li>
           <li id="objetivo16" class="objetivos">
             <div class=" active id_16" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_16" id="id_16">
                 <img class="ico_obj" src="img/ods-16.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!--<input type="checkbox" class="validate caja_d indi16" style="padding-left: 12px;">--> 16- Paz, justicia e instituciones sólidas<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="paz_justicia_cont">
              <div class="col s12">
                  <p>No se tiene indicadores disponibles para este objetivo</p>
              </div>
             </div>
           </li>
           <li id="objetivo17" class="objetivos">
             <div class=" active id_17" style="padding-top:10px;padding-bottom: 30px">
               <div class="obj_icon center-align id_17" id="id_17">
                 <img class="ico_obj" src="img/ods-17.png" alt="" />
               </div>
               <span class="marg_obj t_sm " style="color:#ffffff;"><!--<input type="checkbox" class="validate caja_d indi17" style="padding-left: 12px;">--> 17- Alianzas para lograr objetivos<i class="fa fa-angle-down right" aria-hidden="true"></i></span>
             </div>
             <div class=" back_gray t_sm gris" style="overflow: hidden;margin:0px;" id="alianzas_objetivos_cont">
              <div class="col s12">
                <p>No se tiene indicadores disponibles para este objetivo</p>
              </div>
             </div>
           </li>
         </ul>
        </div>
      </form>
      </div>
    </div>

<!-- footer -->
    <footer class="page-footer id">
      <div class="container">
        <div class="row" id="fot">
          <div class="col l3 s12">
            <a href="index.html"><img src="img/logo_footer.svg" alt="" style="width: 60%;"/></a>
            <br>
            <br>
   <!--          <div class="" style="display:inline;">
              <a href="https://www.facebook.com" style="margin-right: 12%;"><img src="img/fill2.png" alt="" style="width:3%;"/></a>
              <a href="https://twitter.com" style="margin-right: 12%;"><img src="img/fill1.png" alt="" style="width:7%;"/></a>
              <a href="#"><img src="img/fill3.png" alt="" style="width:7%;"/></a>
            </div>
 -->          </div>
          <div class="col l3 s12">
            <ul class="fuerte">
              <li><a class="fuerte t_sm" href="objetivos.html">Indicadores</a></li>
              <!-- <li><a class="fuerte t_sm" href="estados.html">Indicadores con desglose geográfico</a></li>
              <li><a class="fuerte t_sm" href="como_vamos.html">¿Cómo vamos?</a></li> -->
              <li><a class="fuerte t_sm" href="explora.html">Explora</a></li>
            </ul>
          </div>
          <div class="col l3 s12">
            <ul class="fuerte">
             <!-- <li><a class="fuerte t_sm" href="compara.html">Compara</a></li> -->
            <li><a class="fuerte t_sm" href="calendario.html">Calendario de actualizaciones</a></li>
            <!-- <li><a class="fuerte t_sm" href="exportacion.html">Exportación masiva</a></li> -->
            <li><a class="fuerte t_sm" href="acerca.html">Acerca de</a></li>
            </ul>
          </div>
          <div class="col l3 s12" style="display:inline;">
            <a href="https://www.gob.mx" target="_blank"><img src="img/logoPR.png" alt="" style="width: 45%; margin-right: 15%;"/></a>
            <a href="http://www.inegi.org.mx" target="_blank"><img src="img/logoINEGI.png" alt="" style="width:25%;"/></a>
          </div>
        </div>
      </div>
      <!-- <div class="footer-copyright light-blue">
      </div> -->
    </footer>
<!-- footer -->

<div class="tabla_completa" style="display:block;height:0 !important;"></div>

<div class="disclaimer pop">
  <h1>Aviso</h1>
  <p>Esta es una versión beta de la Plataforma Nacional para el seguimiento a los indicadores de los Objetivos de Desarrollo Sostenible, en donde podrás encontrar información de los primeros 25 indicadores. El INEGI y el Gobierno de la República trabajarán constantemente para actualizar la información disponible cuando ésta se genere.</p>
</div>

<a href="#" id="contact"> <img src="img/informacion.png" alt="" /> </a>

<script src="cobertura.js"></script>

<!-- <script type="text/javascript" src="entidad.json"></script> -->
<script type="text/javascript" src="entidad2.json"></script>
<script src="tablas.js"></script>
<script src='funcionesApi.js'></script>
<script src="appDescarga.js"></script>
<!-- <script src="lib/excellentexport.js"></script> -->

    <script type="text/javascript">
    var objetivoId = getParameterByName('objetivoId');
    var lupa = false;
    var visibles =  true;
    var classDescarga;

    $(document).ready(function(){

        $('select').material_select();

      $('#enviaDescarga').on('click',function(){
        $('#loaderDescarga').show();
        descargaSeleccion();
        //if(descargaSeleccion()){
          //Html2CSV('tablaArmada', 'descargaMasiva', 'enviaDescarga');
        //}
        //$(".tablaArmada").tableToCSV({filename: "Nombre"});

        // $('.tablaArmada').tableExport({
        //   type:'xls',
        //   escape:'false',
        //   htmlContent:'true'
        // });

        $( ".tablaArmada" ).table_download({
          format: "xls",
          separator: ",",
          filename: Codigo_ind + ' ' + Descrip_ind,
          linkname: "Descargar Excel",
          quotes: "\""
        });


<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;


 ?>



        // $(".tablaArmada").table2excel({
        //   exclude: ".noExl",
        //   name: Codigo_ind + ' ' + Descrip_ind,
	      //   filename: Codigo_ind + ' ' + Descrip_ind + ".xls" //do not include extension
        // });



        // $('#desca').on('click',function(){
        //   alert('Hace algo');
        //   Html2CSV('tablaArmada', 'descargaMasiva', 'enviaDescarga');
        //     //var args = [$('.tabla_completa table'), 'DescargaMasiva.csv'];
        //     //exportTableToCSV.apply(this, args);
        // });
        $('#loaderDescarga').hide();

        $('.table_download_xls_link').trigger("click");



      });

      function descargaSeleccion(){
        var formato;
        var descargas = [];
        var indDesc = [];
        var tipoDescarga = [];
        var tempId;
        var indSel = $('#indicadorDescarga').is(':selected');

        $(".child").each(function (index) {
          classDescarga = $(this).is(':checked');
            if(classDescarga == true){
              tempId = $(this).attr("id");
              descargas.push(tempId);
            }
        })

        console.log(descargas);

        var res;
        for(var i = 0; i < descargas.length; i++){
          res = descargas[i].split("ind");
          indDesc.push(res[1]);
        }

        console.log(indDesc);

        for(var k = 0; k < indDesc.length; k++){
          listadoTablas(indDesc[k]);
          console.log('Se agrega' + indDesc[k]);
        }

        if(indSel){
          //alert('Enviar');
          $('#indicadorDescarga').is(':selected');
          $('#metadatoDescarga').is(':selected');
          $('#calculoDescarga').is(':selected');
        }else{
          alert('Debe seleccionar al menos un tipo de descarga');
        }



      }

      function items(item, index) {
          return item;
      }
      //Termina función descargaSeleccion

      //   var res = str.split("ind");
      //   document.getElementById("demo").innerHTML = res[1];

      // $('.indi1').change(function() {//do something when the user clicks the box
      //   alert(this.checked);
      // });

      $('#cam_bus').keypress(function(e) {
          if(e.which == 13) {
            buscar($('#cam_bus').val());
          }
      });

      $('#icon_prefix').keypress(function(e) {
          if(e.which == 13) {
            buscar($('#icon_prefix').val());
          }
      });

      function deselect(e) {
        $('.pop').slideFadeToggle(function() {
          e.removeClass('selected');
        });
      }

      // $("#contact").hover(
      //  function() {
      //    if($(this).hasClass('selected')) {
      //      deselect($(this));
      //    } else {
      //      $(this).addClass('selected');
      //      $('.pop').slideFadeToggle();
      //    }
      //    return false;
      //  }, function() {
      //    deselect($('#contact'));
      //    return false;
      //  });


     $.fn.slideFadeToggle = function(easing, callback) {
       return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
     };

      $('.collapsible').collapsible({
        accordion : true
      });

      $(".button-collapse").sideNav();

      $("#sti").hide();

        window.onload = function () {

          $('#buscar').click(function () {
            if(lupa) {
              $('#cam_bus').hide();
              lupa = false;
            } else {
              $('#cam_bus').show();
              $('#buscar').hide();
              document.getElementById("cam_bus").focus();
              lupa = true;
            }
          });
        }

    llamada(27,99);
    if(objetivoId != ''){
      desplegar(objetivoId);
      console.log('entro');
    }

    });

    function buscar(busqueda){
      if(busqueda != ''){
        $('.objetivos:not(:contains("'+ busqueda +'"))').hide();
      }else{
        $('.objetivos').show();
      }
    }

    function llamada(indicador, ser){
      var url = 'http://agenda2030.mx/datos/api/Tematica/Todos';
      //var url = 'https://operativos.inegi.org.mx/datos/api/Valores/PorClaveSerie';
      var parametros =  {"PIdioma":"ES"}
      //var parametros =  {'PCveInd':indicador,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC','PCveSer': ser , 'PIdioma':'ES'}
        $.ajax({
          type: 'POST',
          url: url,
          data: parametros,
          success: function( data, textStatus, jqxhr ) {
             console.log(data);
             ponObjetivos(data);

              var obj = getParameterByName("busqueda");
              if(obj != null){
                buscar(obj);
              }

              $('#loader').delay(2000).fadeOut("slow");
          },
          async:false
        });
    }

    function ponObjetivos(datos){
      var checar = 0;
      for (var i = 0; i < datos.length; i++) {
        var contenido='';
        for (var j = 0; j < datos[i].Meta.length; j++) {
      var clave_arb_meta  = datos[i].Meta[j].Indicador[0].ClaveInd_arb;

        if(true){
          if(clave_arb_meta != 210){
          if(j > 7){
                contenido = contenido + '<div class="row borde_b fond ocultar" >';
              }else{
                contenido = contenido + '<div class="row borde_b fond" >';
              }
          contenido = contenido + '<div class="col s1">'+
                                  '<p>'+datos[i].Meta[j].Codigo_des+'</p>'+
                                  '</div>'+
                                  '<div class="col s11">'+
                                  '<p style="padding-bottom: 0px;" class="marmar">'+datos[i].Meta[j].Descrip_des+'</p><p>';


            for (var k = 0; k < datos[i].Meta[j].Indicador.length; k++) {

              var clave_arb     = datos[i].Meta[j].Indicador[k].ClaveInd_arb;
              var codigo_dg     = datos[i].Meta[j].Indicador[k].DesGeo.Codigo_dg;
              var descrip_des   = datos[i].Meta[j].Indicador[k].Descrip_des;
              var codigo_des    = datos[i].Meta[j].Indicador[k].Codigo_des;
            if( clave_arb == 210){

            }else if(clave_arb == 333)
            {
              if(datos[i].Meta[j].Indicador[k].TieneValores){
                 contenido = contenido +
                  '<input type="checkbox" id="ind' + clave_arb + '" class="child " /> <b class="buscar" href="#">'+
                    codigo_des +' '+ descrip_des +
                  '</b>'+
                  '<a class="buscar fond_global tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].DescripS_tatr : "n/A" )+'"> &nbsp;&nbsp; '+
                    ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].Cve_tatr : "n/A" )+
                  '</a>' +
                  '&nbsp;&nbsp;'+
                '<a class="buscar ns tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ datos[i].Meta[j].Indicador[k].DesGeo.Descrip_dg +'">'+
                  '&nbsp;&nbsp;&nbsp;'+ datos[i].Meta[j].Indicador[k].DesGeo.Codigo_dg +'&nbsp;</a>'+
                '<br>';
              }else{
                 contenido = contenido +
                  '<span class="buscar" >'+
                    codigo_des +' '+ descrip_des +
                  '</span>'+
                  '<input type="checkbox" id="ind' + clave_arb + '" class="child" /> <a class="buscar fond_global tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].DescripS_tatr : "n/A" )+'"> &nbsp;&nbsp; '+
                    ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].Cve_tatr : "n/A" )+
                  '</a>' +
                  '&nbsp;&nbsp;'+
                '<a class="buscar ns tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ datos[i].Meta[j].Indicador[k].DesGeo.Descrip_dg +'">'+
                  '&nbsp;&nbsp;&nbsp;'+ datos[i].Meta[j].Indicador[k].DesGeo.Codigo_dg +'&nbsp;</a>'+
                '<br>';
              }
            }
            else{
              if(datos[i].Meta[j].Indicador[k].TieneValores){
                 contenido = contenido +
                  '<input type="checkbox" id="ind' + clave_arb + '" class="child" /> <b class="buscar" href="#">'+
                    codigo_des +' '+ descrip_des +
                  '</b>'+
                  '<a class="buscar fond_global tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].DescripS_tatr : "n/A" )+'"> &nbsp;&nbsp; '+
                    ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].Cve_tatr : "n/A" )+
                  '</a>' +
                  '&nbsp;&nbsp;'+
                '<a class="buscar ns tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ datos[i].Meta[j].Indicador[k].DesGeo.Descrip_dg +'">'+
                  '&nbsp;&nbsp;&nbsp;'+ datos[i].Meta[j].Indicador[k].DesGeo.Codigo_dg +'&nbsp;</a>'+
                '<br>';
              }else{
                 contenido = contenido +
                  '<span class="buscar" >'+
                    codigo_des +' '+ descrip_des +
                  '</span>'+
                  '<input type="checkbox" id="ind' + clave_arb + '" class="child" /> <a class="buscar fond_global tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].DescripS_tatr : "n/A" )+'"> &nbsp;&nbsp; '+
                    ((typeof datos[i].Meta[j].Indicador[k].TipoInd[0] != "undefined") ? datos[i].Meta[j].Indicador[k].TipoInd[0].Cve_tatr : "n/A" )+
                  '</a>' +
                  '&nbsp;&nbsp;'+
                '<a class="buscar ns tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+ datos[i].Meta[j].Indicador[k].DesGeo.Descrip_dg +'">'+
                  '&nbsp;&nbsp;&nbsp;'+ datos[i].Meta[j].Indicador[k].DesGeo.Codigo_dg +'&nbsp;</a>'+
                '<br>';
              }

            }//fin for mas interno
          }
          contenido = contenido +     '</p></div>'+'</div>';
          }
        }else {
          var mensa = '<p>No se tiene indicadores disponibles para este objetivo</p>';
          contenido =  '<div class="col s12">'+mensa+'</div>';
        }//fin condicion para no ver las metas

          // if(checar < 2 ){
          //   console.log(contenido);
          //   checar ++;
          // }

        }//despues de este cambia el indicador

if(datos[i].Meta.length > 2){
            contenido = contenido; //+    '<div class="row fond link_less">' +
                                  //        '<div class="col s12">'+
                                             //'<p style="text-align:right !important;"><a class="fond mensaje" href="#objetivoId'+(i+1)+'" onclick="show_less()">Ver menos</a></p>'+
                                    //      '</div>'+
                                      //  '</div>';
          }

     // se asigna el codiogo de cada contenedor
        if(datos[i].Clave_arb == "ODS0010"){
          if(datos[i].Ind_disponibles){
            $('#fin_pobreza_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0020")
        {
          if(datos[i].Ind_disponibles){
            $('#hambre_cero_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0030")
        {
          if(datos[i].Ind_disponibles){
            $('#salud_bienestar_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0040")
        {
          if(datos[i].Ind_disponibles){
            $('#educacion_calidad_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0050")
        {
          if(datos[i].Ind_disponibles){
            $('#igualdad_genero_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0060")
        {
          if(datos[i].Ind_disponibles){
            $('#agua_limpia_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0070")
        {
          if(datos[i].Ind_disponibles){
            $('#energia_esequible_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0080")
        {
          if(datos[i].Ind_disponibles){
            $('#trabajo_docente_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0090")
        {
          if(datos[i].Ind_disponibles){
            $('#industria_innovacion_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0100")
        {
          if(datos[i].Ind_disponibles){
            $('#reduccion_desigualdades_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0110")
        {
          if(datos[i].Ind_disponibles){
            $('#ciudades_comunidades_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0120")
        {
          if(datos[i].Ind_disponibles){
            $('#produccion_consumo_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0130")
        {
          if(datos[i].Ind_disponibles){
            $('#accion_clima_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0140")
        {
          if(datos[i].Ind_disponibles){
            $('#vida_submarina_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0150")
        {
          if(datos[i].Ind_disponibles){
            $('#vida_ecosistemas_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0160")
        {
          if(datos[i].Ind_disponibles){
            $('#paz_justicia_cont').html(contenido);
          }
        }else if(datos[i].Clave_arb == "ODS0170")
        {
          if(datos[i].Ind_disponibles){
            $('#alianzas_objetivos_cont').html(contenido);
          }
        }
        //limpiamos la variable
        contenido = '';


      }//fin for mas externo


      //show_less();

      $('.tooltipped').tooltip({delay: 50});
      // console.log(tabla);
    }

    function esconder() {
      $('#cam_bus').hide();
      $('#buscar').show();
      lupa = false;
    }

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function desplegar(objetivoId)
    {
      $('#objetivo'+objetivoId+' > div').click();
      window.location.href = '#objetivo'+ (objetivoId-1);
    }

    function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
      return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

// Descargar  CSV Y xls


function exportTableToXLS($table1, filename1) {

    var $rows1 = $table1.find('tr:has(td)'),

        // Temporary delimiter characters unlikely to be typed by keyboard
        // This is to avoid accidentally splitting the actual contents
        tmpColDelim1 = String.fromCharCode(11), // vertical tab character
        tmpRowDelim1 = String.fromCharCode(0), // null character

        // actual delimiter characters for CSV format
        colDelim1 = '","',
        rowDelim1 = '"\r\n"',

        // Grab text from table into CSV formatted string
        xls = '"' + $rows1.map(function (i, row) {
            var $row1 = $(row),
                $cols1 = $row1.find('td');

            return $cols1.map(function (j, col) {
                var $col1 = $(col),
                    text1 = $col1.text();

                return text1.replace(/"/g, '""'); // escape double quotes

            }).get().join(tmpColDelim1);

        }).get().join(tmpRowDelim1)
            .split(tmpRowDelim1).join(rowDelim1)
            .split(tmpColDelim1).join(colDelim1) + '"';

    // Deliberate 'false', see comment below
    if (false && window.navigator.msSaveBlob) {

        var blob1 = new Blob([decodeURIComponent($table1)], {
            type: 'text/plain;charset=utf8'
        });

        // Crashes in IE 10, IE 11 and Microsoft Edge
        // See MS Edge Issue #10396033: https://goo.gl/AEiSjJ
        // Hence, the deliberate 'false'
        // This is here just for completeness
        // Remove the 'false' at your own risk
        window.navigator.msSaveBlob(blob1, filename1);

    } else if (window.Blob && window.URL) {
        // HTML5 Blob
        var blob1 = new Blob([xls], { type: 'text/plain;charset=utf8' });
        var xlsUrl = URL.createObjectURL(blob1);

        $(this)
            .attr({
                'download': filename1,
                'href': xlsUrl
            });
    } else {
        // Data URI
        var xlsData = 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(xls);

        $(this)
            .attr({
                'download': filename1,
                'href': xlsData,
                'target': '_blank'
            });
    }
}





// This must be a hyperlink
$(".exportXLS").on('click', function (event) {
    // CSV
    var args1 = [$('#tabla_export table'), Descrip_ind+'.xls'];

    exportTableToXLS.apply(this, args1);

    // If CSV, don't do event.preventDefault() or return false
    // We actually need this to be a typical hyperlink
});
//});



    function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace(/"/g, '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"';

				// Deliberate 'false', see comment below
        if (false && window.navigator.msSaveBlob) {

						var blob = new Blob([decodeURIComponent(csv)], {
	              type: 'text/csv;charset=utf8'
            });

            // Crashes in IE 10, IE 11 and Microsoft Edge
            // See MS Edge Issue #10396033: https://goo.gl/AEiSjJ
            // Hence, the deliberate 'false'
            // This is here just for completeness
            // Remove the 'false' at your own risk
            window.navigator.msSaveBlob(blob, filename);

        } else if (window.Blob && window.URL) {
						// HTML5 Blob
            var blob = new Blob([csv], { type: 'text/csv;charset=utf8' });
            var csvUrl = URL.createObjectURL(blob);

            $(this)
            		.attr({
                		'download': filename,
                		'href': csvUrl
		            });
				} else {
            // Data URI
            var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

						$(this)
                .attr({
               		  'download': filename,
                    'href': csvData,
                    'target': '_blank'
            		});
        }
    }

    // This must be a hyperlink
    $(".exportCSV").on('click', function (event) {
        // CSV
        var args = [$('.tabla_completa .tablaArmada'), 'DescargaMasiva.csv'];

        exportTableToCSV.apply(this, args);

        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

    if ($('.select_datos').val() != -1) {
      $(".exportCSVDatos").hide();
    }else{
      $(".exportCSVDatos").hide();
    }

    $(".exportCSVDatos").on('click', function (event) {
        // CSV
        var args = [$('#miTabla'), 'DatosParaElCalculo - '+Descrip_ind+'.csv'];

        exportTableToCSV.apply(this, args);

        // If CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });


    $("#descargaXLS").attr('download',Descrip_ind+'.xls');


    // $(document).ready(function () {
    //     Html2CSV('testbed_results', 'myfilename','export');
    // });



    function Html2CSV(tableId, filename,alinkButtonId) {
        var array = [];
        var headers = [];
        var arrayItem = [];
        var csvData = new Array();
        $('.' + tableId + ' th').each(function (index, item) {
            headers[index] = '"' + $(item).html() + '"';
        });
        csvData.push(headers);
        $('.' + tableId + ' tr').has('td').each(function () {

            $('td', $(this)).each(function (index, item) {
                arrayItem[index] = '"' + $(item).html() + '"';
            });
            array.push(arrayItem);
            csvData.push(arrayItem);
        });

        var fileName = filename + '.csv';
        var buffer = csvData.join("\n");
        var blob = new Blob([buffer], {
            "type": "text/csv;charset=utf8;"
        });
        var link = document.getElementById(alinkButtonId);

        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            link.setAttribute("href", window.URL.createObjectURL(blob));
            link.setAttribute("download", fileName);
        }
        else if (navigator.msSaveBlob) { // IE 10+
            link.setAttribute("href", "#");
            link.addEventListener("click", function (event) {
                navigator.msSaveBlob(blob, fileName);
            }, false);
        }
        else {
            // it needs to implement server side export
            link.setAttribute("href", "http://www.example.com/export");
        }
    }

    </script>
  </body>
</html>
