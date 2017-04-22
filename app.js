
  var titulo_des_graf=" ";
  var inicio = 0;
  var estados = [];
  var lista_insumos = [];
  var insumos_general = [];
  var insumos_cobertura = [];
  var insumo_cober_clasifica = [];

  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = getParameterByName("indicador");
  var obj = getParameterByName("objetivo");
  var objetivo = getParameterByName("obj");
  var meta = getParameterByName("meta");
  var codigoDg = getParameterByName("codigo");
  var PCveInd = vars;
  var Codigo_ind = '';
  var Descrip_ind = '';
  var tituloObjetivo = '';
  var titulo ;
  var pie ;
  var Algoritmo_ft = '';

  $.ajax({
    type: 'POST',
    url: "https://operativos.inegi.org.mx/datos/api/Tematica/PorClave",
    data: {'PClave':objetivo , 'PIdioma':'ES'},
    success: function( data, textStatus, jqxhr ) {

      nombreObj = data.Abrevia_des;

      for (var i = 0; i < data.Meta.length; i++) {
        if( data.Meta[i].Clave_arb ==  meta){
          Codigo_meta   = data.Meta[i].Codigo_des;
          Descrip_meta = data.Meta[i].Descrip_des;
        }
      }

      Codigo_ind 	=	data.Codigo_ind;

      Descrip_ind = data.Descrip_ind;

      colorObjetivo(obj);
      iconoObjetivo(obj);

      $('.tituloObjetivo').html(obj+' '+nombreObj);
      $('.Codigo_meta').html(Codigo_meta);
      $('.Descrip_meta').html(Descrip_meta);

    },
    async:true
  });

  // $.ajax({
  //   type: 'POST',
  //   url: "https://operativos.inegi.org.mx/datos/api/Metadato/PorClave",
  //   data: {'PCveInd':vars , 'PIdioma':'ES'},
  //   success: function( data, textStatus, jqxhr ) {
  //     Algoritmo_ft = data.Algoritmo_ft;
  //     console.log('.l.l.l.l.l.l.l.l.l.l.l.l.l.l.l.l.l.l');
  //     console.log(Algoritmo_ft);
  //     var dasdasd = '<img src="img/algoritmos/'+Algoritmo_ft+'.gif" alt="Algoritmo '+Algoritmo_ft+'" />';
  //     console.log(dasdasd);
  //     $('.imgAlgoritmo').html(dasdasd);
  //   },
  //   async:false
  // });

$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",
  data: {'PCveInd': PCveInd,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {

      Codigo_ind  = data.Codigo_ind;
      Descrip_ind = data.Descrip_ind;

      // separamos para ver que funcion es la que debemos usar
      if(data.Series[0].Coberturas[0].ValorDato != 0){
        valorDato(data);
        valorDatoInsumos(data);
      }else{
        console.log('------------------------ analisis de datos que se enstan mostrando --------------');
       //console.log(data);
        cobertura(data);
        estados = arma_tabla(0);
        coberturaInsumos(data);
        console.log(estados);
        poner_filtros();
      }
      var codigo_indicador = data.Codigo_ind;
      var descripcion = data.Descrip_ind;

      $('.Codigo_ind').html(Codigo_ind);
      $('.Descrip_ind').html(Descrip_ind);

      titulos(PCveInd);
      $('#loader').delay(2000).fadeOut("slow");
    },
    async:false
  });

  $(document).ready(function()
  {
    titulos(PCveInd);
    //llamada cuando cambia el select de los filtros estatales
    $('#filtros_es').on('change',function(){
      $('#loader').show();
      estados = arma_tabla($(this).val());
      actualiza_grafica();
      $('#'+anio_mas_actual).trigger( "click" );
      $('#loader').delay(2000).fadeOut("slow");
    });

    //llamada cuando cambia el select de los filtros nacionales
    $('#filtros_na').on('change',function(){
      $('#loader').show();
      estados = arma_tabla($(this).val());

      actualiza_grafica_na();

      $('#loader').delay(2000).fadeOut("slow");
    });

    $('#insumo_change').on('change',function(){
      put_tabla_insumo($(this).val());
    });

    $('#insumo_change_cob').on('change',function(){
      put_filtros_insumo_cob($(this).val());
      $('#insumos_cont').html('');
    });

    $('#este').on('change', function(){
      put_tabla_insumo_cob($(this).val());
    });

  });//fin document ready

  function arma_tabla_insumo(arreglo_datos,num_cobertura){
    var cobertura_tabla = [];

    cobertura_tabla.push(anios_cob);
    for (var i = 0; i < arreglo_datos[num_cobertura].length; i++) {
        cobertura_tabla.push(arreglo_datos[num_cobertura][i]);
    }
    return cobertura_tabla;
  }

  function put_tabla_insumo_cob(filtro){
    var datos_doble = '<div class="cuadro_titulo"> ' + titulo +
                      '</div>' +
                      '<div style=" width: auto; height: auto; overflow: auto;" id="datos_calculo_1">'+
                      '<table class="bordered" id="miTabla" class="miTabla">';
    console.log('--------------- insu cobertura ----------');
    console.log(insumos_cobertura[$('#insumo_change_cob').val()]);
    console.log(insumos_cobertura[$('#insumo_change_cob').val()][filtro]);
    var tabla_armada = arma_tabla_insumo(insumos_cobertura[$('#insumo_change_cob').val()],filtro);
    console.log('--------------- tabla armada ----------');
    console.log(tabla_armada);

    $.each(tabla_armada, function(idx, value){
      if(idx == 0){
        datos_doble += '<thead>';
      }else if(idx == 1){
        datos_doble += '<tbody>';
      }
      datos_doble += '<tr>';
      $.each(value, function(idx2, value2){
        if(idx == 0 && idx2 == (value.length -1)){
          datos_doble += '<th class="headcol">'+ numberWithCommas(value2.split('-')[0]); +'</th>';
        }
        else if(idx == 0){
          datos_doble += '<th>'+ numberWithCommas(value2.split('-')[0]) +'</th>';
        }
        else if(idx2 == (value.length -1)){
          datos_doble += '<td class="headcol">'+ numberWithCommas(value2) +'</td>';
        }
        else{
          datos_doble += '<td>'+ numberWithCommas(value2) +'</td>';
        }
      });
      datos_doble += '</tr>';
      if(idx == 0){
        datos_doble += '</thead>';
      }
    });

    datos_doble +=  '</tbody></table></div><p class="nota" style="color:#8694a8;"><div class="pie_cuadro2">'+ pie +
                    '</div></div>';

    //sin pie y cabezera de la pagina
    $('#insumos_cont').html(datos_doble);
    var arre = [];
    for (var i = 0; i < tabla_armada.length[0] - 1; i++) {
      arre.push(i)
    }
    console.log(arre);
    $('#miTabla').DataTable( {
                    scrollY:        "600px",
                    scrollX:        true,
                    scrollCollapse: true,
                    paging:         false,
                    aoColumnDefs: [
                      { 'bSortable': false,
                        'aTargets': arre }
                    ],
                    fixedColumns:   {
                        leftColumns: 1
                    }
                } );
    //agregamos titulo del insumo seleccionado
    $('#titulo_cabezeras').html(lista_insumos[$('#insumo_change_cob').val()]);
  }

  function put_filtros_insumo_cob(insumo){
    $('#este').show();

    var insumo_filtro = '<option value="-1"> Selecciona una Filtro </option>';

    $.each(insumo_cober_clasifica[insumo], function(idx, value){
      insumo_filtro += '<option value="'+idx+'">'+value+'</option>';
    });

    $('#este').html(insumo_filtro);
  }

  function put_tabla_insumo(insumo){
    var datos_doble = '<div class="cuadro_titulo"> ' + titulo +
                      '</div>' +
                      '<div style=" width: auto; height: auto; overflow: auto;" id="datos_calculo_1">'+
                      '<table class="bordered" id="miTabla" class="miTabla">';

    $.each(insumos_general[insumo], function(idx, value){
      if(idx == 0){
        datos_doble += '<thead>';
      }else if(idx == 1){
        datos_doble += '<tbody>';
      }
      datos_doble += '<tr>';
      $.each(value, function(idx2, value2){
        if(idx == 0 && idx2 == (value.length -1)){
          datos_doble += '<th class="headcol">'+ numberWithCommas(value2.split('-')[0]) +'</th>';
        }
        else if(idx == 0){
          datos_doble += '<th>'+ numberWithCommas(value2.split('-')[0]) +'</th>';
        }
        else if(idx2 == (value.length -1)){
          datos_doble += '<td class="headcol">'+ numberWithCommas(value2)+'</td>';
        }
        else{
          datos_doble += '<td>'+ numberWithCommas(value2) +'</td>';
        }
      });
      datos_doble += '</tr>';
      if(idx == 0){
        datos_doble += '</thead>';
      }
    });

    datos_doble +=  '</tbody></table></div><p class="nota" style="color:#8694a8;"><div class="pie_cuadro2">'+ pie +
                    '</div></div>';

    //sin pie y cabezera de la pagina
    $('#insumos_cont').html(datos_doble);
    var arre = [];
    for (var i = 0; i < insumos_general[insumo][0].length - 1; i++) {
      arre.push(i)
    }

    $('#miTabla').DataTable( {
                    scrollY:        "600px",
                    scrollX:        true,
                    scrollCollapse: true,
                    paging:         false,
                    aoColumnDefs: [
                      { 'bSortable': false,
                        'aTargets': arre }
                    ],
                    fixedColumns:   {
                        leftColumns: 1
                    }
                } );
    //agregamos titulo del insumo seleccionado
    $('#titulo_cabezeras').html(lista_insumos[$('#insumo_change').val()]);
  }

  function valorDatoInsumos(data){
    lista_insumos = [];
    var temporal = [];
    var individual = [];

    for (var i = 0; i < data.Series.length; i++) {
      var temporal = [];
      individual = [];
      if(data.Series[i].Tipo_ser == "I"){

        lista_insumos.push(data.Series[i].Descrip_ser);
        temporal.push('Entidad');

        for (var j = 0; j < data.Series[i].Coberturas[0].ValorDato.length; j++) {
          temporal.push(data.Series[i].Coberturas[0].ValorDato[j].AADato_ser+'-01-01');
        }
        individual.push(temporal);

        for (var j = 0; j < data.Series[i].Coberturas.length; j++) {
          temporal = [];
          temporal.push(data.Series[i].Coberturas[j].Descrip_cg);
          for (var k = 0; k < data.Series[i].Coberturas[j].ValorDato.length; k++) {
            var dato_formato = data.Series[i].Coberturas[j].ValorDato[k].Dato_Formato.replace(",", "");
            temporal.push(dato_formato);
          }
          individual.push(temporal);
        }
        insumos_general.push(individual);
      }
    }

    //Armamos el select para que tenga todas las series que pueden existir
    var select='<div class="input-field col s12" style="margin-bottom:20px;"><select id="insumo_change" class="select_datos" style="display:block !important; background-color: #f2f2f2;">';

    select += '<option value="-1"> Selecciona una opción </option>';
    $.each(lista_insumos, function(idx, value){
      select += '<option value="'+idx+'">'+value+'</option>';
    });

    select += '</select></div><div class="col s12" id="insumos_cont"></div>';

    //sin pie y cabezera de la pagina
    $('#datos-panel').html(select);
  }

  function coberturaInsumos(data){
    lista_insumos = [];

    for (var i = 0; i < data.Series.length; i++) {
      if(data.Series[i].Tipo_ser == "I"){
        lista_insumos.push(data.Series[i].Descrip_ser);
        insumos_cobertura.push(cobertura_series(data,i));
        insumo_cober_clasifica.push(clasificaciones(data,i));
      }
    }

    //Armamos el select para que tenga todas las series que pueden existir
    var select='<div class="input-field col s12" style="margin-bottom:20px;"><select id="insumo_change_cob" class="select_datos" style="display:block !important; background-color: #f2f2f2;">';

    select += '<option value="0"> Selecciona una opción </option>';
    $.each(lista_insumos, function(idx, value){
      select += '<option value="'+idx+'">'+value+'</option>';
    });

    select += '</select></div><div class="col s12" id="insumo_filtro"><select id="este" style="display:none !important; background-color: #f2f2f2;"></select></div><div class="col s12" id="insumos_cont"></div>';

    //sin pie y cabezera de la pagina
    $('#datos-panel').html(select);
  }

  function actualiza_grafica(){
    $('.numero').html(arrray_anios[0]);
    datosGrafica(arrray_anios[0]);
  }//fin de la función

  function actualiza_grafica_na(){
    chart2 = c3.generate({
    bindto: '#chart2',
    size: {
          height: 400
        },
      data: {
          x: 'Entidad',
          columns: estados,
      },
      legend: {
      show: false
      },
    padding: {
          left: 40,
          right: 30
      },
      point: {
      show: true
    },
    color: {
          pattern:['#f00']
      },

      axis : {
          x : {
              type : 'timeseries',
              tick: {
                  format: function (x) { return x.getFullYear(); }
                //format: '%Y' // format string is also available for timeseries data
              },
              y : {
                  tick: {
                      format: d3.format(".0f")
                  },
                  padding: {top: 35, bottom: 0}
              }
          }
      },tooltip: {
          grouped: false, // Default true
            format: {
              title: function (d) { return d.name; },
              value: function (value, ratio, id) {
                (function ($) {
                  if (id != "Estados Unidos Mexicanos") {
                      $( "#chart2 svg g.c3-chart-line g.c3-circles circle" ).css('fill','#ccc');
                      $( "#chart2 svg g.c3-chart-line path.c3-line" ).css('stroke','#ccc');

                      $( "svg g.c3-chart-line g.c3-circles-" +id.replace(/ /g,'-') + " circle" ).css('fill','#00aeef');
                      $( "svg g.c3-chart-line path.c3-line-" +id.replace(/ /g,'-') ).css('stroke','#00aeef');

                      $( "svg g.c3-chart-line g.c3-circles-Promedio-nacional circle" ).css('fill','#f00');
                      $( "svg g.c3-chart-line path.c3-line-Promedio-nacional" ).css('stroke','#f00');
                      $( "svg g.c3-chart-line g.c3-circles-Estados-Unidos-Mexicanos circle" ).css('fill','#f00');
                      $( "svg g.c3-chart-line path.c3-line-Estados-Unidos-Mexicanos" ).css('stroke','#f00');

                  }
                  else {
                    $( "#chart2 svg g.c3-chart-line g.c3-circles circle" ).css('fill','#ccc');
                    $( "#chart2 svg g.c3-chart-line path.c3-line" ).css('stroke','#ccc');

                    $( "svg g.c3-chart-line g.c3-circles-Promedio-nacional circle" ).css('fill','#f00');
                    $( "svg g.c3-chart-line path.c3-line-Promedio-nacional" ).css('stroke','#f00');

                    $( "svg g.c3-chart-line g.c3-circles-Estados-Unidos-Mexicanos circle" ).css('fill','#f00');
                    $( "svg g.c3-chart-line path.c3-line-Estados-Unidos-Mexicanos" ).css('stroke','#f00');
                  }
                }(jQuery));
                  return commaSeparateNumber(Math.round(value*10)/10);
              }
          }
      },
    });
  }//fin de la función

  function poner_filtros(){
    $("#filtros_es").html('');
    for (var i = 0; i < arreglo_cla.length; i++) {
      $("#filtros_es").append('<option value="'+i+'">'+arreglo_cla[i]+'</option>');
    }
    //$('#row_filtros').show();
    //$('select').material_select();
  }

  function poner_filtros_na(){
    $("#filtros_na").html('');
    for (var i = 0; i < arreglo_cla.length; i++) {
      $("#filtros_na").append('<option value="'+i+'">'+arreglo_cla[i]+'</option>');
    }
    //$('.cob_sel_nac').show();
    //$('select').material_select();
  }

  function valorDato(data){
    var temporal = [];
    temporal.push('Entidad');
    for (var j = 0; j < data.Series[0].Coberturas[0].ValorDato.length; j++) {
      temporal.push(data.Series[0].Coberturas[0].ValorDato[j].AADato_ser+'-01-01');
    }
    estados.push(temporal);

    for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
      var temporal = [];
      temporal.push(data.Series[0].Coberturas[i].Descrip_cg);
      for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
        var dato_formato = data.Series[0].Coberturas[i].ValorDato[j].Dato_Formato.replace(",", "");
        temporal.push(dato_formato);
      }
      estados.push(temporal);
    }
  }

  function arma_tabla(num_cobertura){
    var cobertura_tabla = [];

    console.log(arreglo_datos[num_cobertura]);
    console.log(arreglo_datos);
    cobertura_tabla.push(anios_cob);
    for (var i = 0; i < arreglo_datos[num_cobertura].length; i++) {
        cobertura_tabla.push(arreglo_datos[num_cobertura][i]);
    }
    return cobertura_tabla;
  }

  function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
      return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  $(document).ready(function()
  {
    titulos(PCveInd);

    $('#filtros_es').on('change',function(){
      $('#loader').show();
      estados = arma_tabla($(this).val());
      console.log('------------------------- estados tabala select-----------------');
      console.log(estados);
      actualiza_grafica();

      $('#'+anio_mas_actual).trigger( "click" );

      $('#loader').delay(2000).fadeOut("slow");
    });

    $('#filtros_na').on('change',function(){
      $('#loader').show();
      estados = arma_tabla($(this).val());
      console.log('------------------------- estados tabala select-----------------');
      console.log(estados);
      actualiza_grafica_na();

      $('#loader').delay(2000).fadeOut("slow");
    });
  });

  var titulo ;
  var pie ;

  function titulos(indicador){
        var atributos = getAtributos(indicador);
        titulo   =  '<h4 id="titulo_cabezeras">'+ atributos.DescripInd_des  +'</h4>' +
                        '<li class="divider"></li> ' +
                        '<p> '+ atributos.CobTemporal_ser +' </p>' +
                        '<span> '+ atributos.Descrip_uni +'</span>';


        pie  = ' <div> '+ ((atributos.Descrip_not != null || atributos.Descrip_not != "") ? ''  : '<strong>Nota:</strong>' + atributos.Descrip_not)+
                  ' <div><strong>Fuente:</strong> '+ atributos.Descrip_fue +' </div>'+
                  ' <div><strong>Fecha de actualización:</strong> '+ atributos.FecProxAct_cal +'</div>'+
                  ' </div>';

        $('.pie_cuadro2').html(pie);
        $('.cuadro_titulo').html(titulo);
        titulo_des_graf = atributos.DescripInd_des;

            put_datos(atributos.DescripInd_des, atributos.Descrip_ins);
  }

  function iconoObjetivo(objetivo){
    switch(objetivo){
      case "1.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-01.png">');
        //return '<img class="ico_obj" src="img/ods-01.png">';
      break;
      case "2.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-02.png">');
        //return '<img class="ico_obj" src="img/ods-02.png">';
      break;
      case "3.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-03.png">');
        //return '<img class="ico_obj" src="img/ods-03.png">';
      break;
      case "4.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-04.png">');
        //return '<img class="ico_obj" src="img/ods-04.png">';
      break;
      case "5.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-05.png">');
        //return '<img class="ico_obj" src="img/ods-05.png">';
      break;
      case "6.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-06.png">');
        //return '<img class="ico_obj" src="img/ods-06.png">';
      break;
      case "7.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-07.png">');
        //return '<img class="ico_obj" src="img/ods-07.png">';
      break;
      case "8.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-08.png">');
        //return '<img class="ico_obj" src="img/ods-08.png">';
      break;
      case "9.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-09.png">');
        //return '<img class="ico_obj" src="img/ods-09.png">';
      break;
      case "10.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-10.png">');
        //return '<img class="ico_obj" src="img/ods-10.png">';
      break;
      case "11.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-11.png">');
        //return '<img class="ico_obj" src="img/ods-11.png">';
      break;
      case "12.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-12.png">');
        //return '<img class="ico_obj" src="img/ods-12.png">';
      break;
      case "13.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-13.png">');
        //return '<img class="ico_obj" src="img/ods-13.png">';
      break;
      case "14.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-14.png">');
        //return '<img class="ico_obj" src="img/ods-14.png">';
      break;
      case "15.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-15.png">');
        //return '<img class="ico_obj" src="img/ods-15.png">';
      break;
      case "16.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-16.png">');
        //return '<img class="ico_obj" src="img/ods-16.png">';
      break;
      case "17.":
        $('.iconoObjetivo').html('<img class="ico_obj" src="img/ods-17.png">');
        //return '<img class="ico_obj" src="img/ods-17.png">';
      break;

    }
  }

  function colorObjetivo(objetivo){
    switch(objetivo){
      case "1.":
        $('.headerObje').addClass('id_1');
        $('#sti').addClass('id_1');
      break;
      case "2.":
        $('.headerObje').addClass('id_2');
        $('#sti').addClass('id_2');
      break;
      case "3.":
        $('.headerObje').addClass('id_3');
        $('#sti').addClass('id_3');
      break;
      case "4.":
        $('.headerObje').addClass('id_4');
        $('#sti').addClass('id_4');
      break;
      case "5.":
        $('.headerObje').addClass('id_5');
        $('#sti').addClass('id_5');
      break;
      case "6.":
        $('.headerObje').addClass('id_6');
        $('#sti').addClass('id_6');
      break;
      case "7.":
        $('.headerObje').addClass('id_7');
        $('#sti').addClass('id_7');
      break;
      case "8.":
        $('.headerObje').addClass('id_8');
        $('#sti').addClass('id_8');
      break;
      case "9.":
        $('.headerObje').addClass('id_9');
        $('#sti').addClass('id_9');
      break;
      case "10.":
        $('.headerObje').addClass('id_10');
        $('#sti').addClass('id_10');
      break;
      case "11.":
        $('.headerObje').addClass('id_11');
        $('#sti').addClass('id_11');
      break;
      case "12.":
        $('.headerObje').addClass('id_12');
        $('#sti').addClass('id_12');
      break;
      case "13.":
        $('.headerObje').addClass('id_13');
        $('#sti').addClass('id_13');
      break;
      case "14.":
        $('.headerObje').addClass('id_14');
        $('#sti').addClass('id_14');
      break;
      case "15.":
        $('.headerObje').addClass('id_15');
        $('#sti').addClass('id_15');
      break;
      case "16.":
        $('.headerObje').addClass('id_16');
        $('#sti').addClass('id_16');
      break;
      case "17.":
        $('.headerObje').addClass('id_17');
        $('#sti').addClass('id_17');
      break;

    }
  }

  function put_datos(indicador, institucion){
      // $('#da_indicador').html(indicador);
      $('#da_institucion').html(institucion);
  }
