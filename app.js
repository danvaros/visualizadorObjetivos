// $(window).onload(function(){
// 	$('#preloader').fadeOut('slow',function(){$(this).remove();});
// });
var series_calculo=[];
var titulo_des_graf=" ";
var inicio = 0;
var estados = [];

	// $.post( "https://operativos.inegi.org.mx/datos/api/tematica/PorClave", {'PIdioma': 'ES','PClave': 'O'}, function( data, textStatus, jqxhr ) {
	// 	alert( "Exito" );
	// 	console.log(data);
	// });

	// $.post( "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",{'PCveInd':'27', 'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'}, function( data, textStatus, jqxhr ) {
	// 	alert( "Exito" );
	// 	console.log(data);
	// 	console.log('------------------------------------- nuevo arreglo  --------------------');
	// 	console.log(data.Series);
	// });
  var query_string = {};
  var query = window.location.search.substring(1);
  // var vars = query.split("?");
  var vars = getParameterByName("indicador");
  console.log(vars);
  var obj = getParameterByName("objetivo");
  var meta = getParameterByName("meta");
  var codigoDg = getParameterByName("codigo");
  console.log(codigoDg);
  var PCveInd = vars;
  var Codigo_ind = '';
  var Descrip_ind = '';
  var tituloObjetivo = '';

  $.ajax({
    type: 'POST',
    url: "https://operativos.inegi.org.mx/datos/api/Tematica/Todos",
    data: {'PIdioma':'ES'},
    success: function( data, textStatus, jqxhr ) {
    		//alert( "Exito" );
  		// console.log(data);
  		// console.log('------------------------------------- nuevo arreglo  --------------------');
  		// console.log(data.Series);
  		// console.log(data.Series[0]);
  		// console.log(data.Series[0].Coberturas);
  		// console.log(data.Series[0].Coberturas.length);

      switch (obj){
        case '1.':
          nombreObj = data[0].Abrevia_des;
          Codigo_meta 	=	data[0].Meta[0].Codigo_des;
          Descrip_meta = data[0].Meta[0].Descrip_des;
        break;
        case '2.':
          nombreObj = data[1].Abrevia_des;
          Codigo_meta 	=	data[1].Meta[0].Codigo_des;
          Descrip_meta = data[1].Meta[0].Descrip_des;
        break;
        case '3.':
          nombreObj = data[2].Abrevia_des;
          Codigo_meta 	=	data[2].Meta[0].Codigo_des;
          Descrip_meta = data[2].Meta[0].Descrip_des;
        break;
        case '4.':
          nombreObj = data[3].Abrevia_des;
          Codigo_meta 	=	data[3].Meta[0].Codigo_des;
          Descrip_meta = data[3].Meta[0].Descrip_des;
        break;
        case '5.':
          nombreObj = data[4].Abrevia_des;
          Codigo_meta 	=	data[4].Meta[0].Codigo_des;
          Descrip_meta = data[4].Meta[0].Descrip_des;
        break;
        case '6.':
          nombreObj = data[5].Abrevia_des;
          Codigo_meta 	=	data[5].Meta[0].Codigo_des;
          Descrip_meta = data[5].Meta[0].Descrip_des;
        break;
        case '7.':
          nombreObj = data[6].Abrevia_des;
          Codigo_meta 	=	data[6].Meta[0].Codigo_des;
          Descrip_meta = data[6].Meta[0].Descrip_des;
        break;
        case '8.':
          nombreObj = data[7].Abrevia_des;
          Codigo_meta 	=	data[7].Meta[0].Codigo_des;
          Descrip_meta = data[7].Meta[0].Descrip_des;
        break;
        case '9.':
          nombreObj = data[8].Abrevia_des;
          Codigo_meta 	=	data[8].Meta[0].Codigo_des;
          Descrip_meta = data[8].Meta[0].Descrip_des;
        break;
        case '10.':
          nombreObj = data[9].Abrevia_des;
          Codigo_meta 	=	data[9].Meta[0].Codigo_des;
          Descrip_meta = data[9].Meta[0].Descrip_des;
        break;
        case '11.':
          nombreObj = data[10].Abrevia_des;
          Codigo_meta 	=	data[10].Meta[0].Codigo_des;
          Descrip_meta = data[10].Meta[0].Descrip_des;
        break;
        case '12.':
          nombreObj = data[11].Abrevia_des;
          Codigo_meta 	=	data[11].Meta[0].Codigo_des;
          Descrip_meta = data[11].Meta[0].Descrip_des;
        break;
        case '13.':
          nombreObj = data[12].Abrevia_des;
          Codigo_meta 	=	data[12].Meta[0].Codigo_des;
          Descrip_meta = data[12].Meta[0].Descrip_des;
        break;
        case '14.':
          nombreObj = data[13].Abrevia_des;
          Codigo_meta 	=	data[13].Meta[0].Codigo_des;
          Descrip_meta = data[13].Meta[0].Descrip_des;
        break;
        case '15.':
          nombreObj = data[14].Abrevia_des;
          Codigo_meta 	=	data[14].Meta[0].Codigo_des;
          Descrip_meta = data[14].Meta[0].Descrip_des;
        break;
        case '16.':
          nombreObj = data[15].Abrevia_des;
          Codigo_meta 	=	data[15].Meta[0].Codigo_des;
          Descrip_meta = data[15].Meta[0].Descrip_des;
        break;
        case '17.':
          nombreObj = data[16].Abrevia_des;
          Codigo_meta 	=	data[16].Meta[0].Codigo_des;
          Descrip_meta = data[16].Meta[0].Descrip_des;
        break;
      }

  		Codigo_ind 	=	data.Codigo_ind;
      Descrip_ind = data.Descrip_ind;

      colorObjetivo(obj);
      iconoObjetivo(obj);

    $('.tituloObjetivo').html(obj+' '+nombreObj);
    $('.Codigo_meta').html(Codigo_meta);
    $('.Descrip_meta').html(Descrip_meta);

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
  				temporal.push(data.Series[0].Coberturas[i].ValorDato[j].Dato_ser);
  			}
  			estados.push(temporal);
  		}

  		// console.log(estados);

  		var codigo_indicador = data.Codigo_ind;
  		// console.log(codigo_indicador);
  		var descripcion = data.Descrip_ind;
  		// console.log(descripcion);
  		$('.Codigo_ind').html(Codigo_ind);
  		$('.Descrip_ind').html(Descrip_ind);
  		//alert(Descrip_ind);

  		//inicio =  1;
  		//$('#loader').delay(2000).fadeOut("slow");
  		titulos(PCveInd);
    },
    async:false
  });



$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",
  data: {'PCveInd': PCveInd,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {


      console.log('-------------------- valorDato ----------------');
      console.log(data.Series[0].Coberturas[0].ValorDato);
      Codigo_ind  = data.Codigo_ind;
      Descrip_ind = data.Descrip_ind;

      //valorDato(data);
      // separamos para ver que funcion es la que debemos usar 
      if(data.Series[0].Coberturas[0].ValorDato != 0){
        valorDato(data);
      }else{
        cobertura(data);
        estados = arma_tabla(0);
        //poner_filtros();
      }
    

        // console.log(estados);

      var codigo_indicador = data.Codigo_ind;
      // console.log(codigo_indicador);
      var descripcion = data.Descrip_ind;
      // console.log(descripcion);

      $('.Codigo_ind').html(Codigo_ind);
      $('.Descrip_ind').html(Descrip_ind);
      //alert(Descrip_ind);

      titulos(PCveInd);


      console.log("ya termino las llamadas");
      $('#loader').delay(2000).fadeOut("slow");

  },
  async:false
});

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
        temporal.push(data.Series[0].Coberturas[i].ValorDato[j].Dato_ser);
      }
      estados.push(temporal);
    }
}

function arma_tabla(num_cobertura){
  var cobertura_tabla = [];
  console.log('------------------------ probando funcion  -------------------');
  console.log(anios_cob);
  console.log(arreglo_datos[num_cobertura]);

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




$(document).ready(function()
{
  titulos(PCveInd);
});
var titulo ;
 var pie ;
function titulos(indicador){
      var atributos = getAtributos(indicador);
      titulo   =  '<h4>'+ atributos.DescripInd_des  +'</h4>' +
                      '<li class="divider"></li> ' +
                      '<p> '+ atributos.CobTemporal_ser +' </p>' +
                      '<span> '+ atributos.Descrip_uni +'</span>';


      pie  =' <div><strong>Nota:</strong> '+ ((atributos.Descrip_not != null) ? atributos.Descrip_not+'</div>' : ' ND</div> ')+
                ' <div><strong>Fuente:</strong> '+ atributos.Descrip_fue +' </div>'+
                ' <div><strong>Fecha de actualización:</strong> '+ atributos.FecProxAct_cal +'</div>'+
                ' </div>';

      $('.pie_cuadro2').html(pie);
      $('.cuadro_titulo').html(titulo);
      titulo_des_graf = atributos.DescripInd_des;
    }






	// $.post( "https://operativos.inegi.org.mx/datos/api/Valores/PorClaveSerie", {'PCveInd':'27','PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC','PCveSer':'99', 'PIdioma':'ES'}, function( data, textStatus, jqxhr ) {
	// 	alert( "Exito" );
	// 	console.log(data);
	// 	console.log('------------------------------------- nuevo arreglo  --------------------');
	// 	console.log(data.Series);
	// 	console.log(data.Series[0]);
	// 	console.log(data.Series[0].Coberturas);
	// 	console.log(data.Series[0].Coberturas.length);


	// 	var temporal = [];
	// 	temporal.push('Entidad');
	// 	for (var j = 0; j < data.Series[0].Coberturas[0].ValorDato.length; j++) {
	// 	temporal.push(data.Series[0].Coberturas[0].ValorDato[j].AADato_ser+'-01-01');
	// 	}
	// 	estados.push(temporal);


	// 	for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
	// 		var temporal = [];
	// 		temporal.push(data.Series[0].Coberturas[i].Descrip_cg);
	// 		for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
	// 			temporal.push(data.Series[0].Coberturas[i].ValorDato[j].Dato_ser);
	// 		}
	// 		estados.push(temporal);
	// 	}

	// 	console.log(estados);

	// 	var codigo_indicador = data.Codigo_ind;
	// 	console.log(codigo_indicador);
	// 	var descripcion = data.Descrip_ind;
	// 	console.log(descripcion);

	// 	inicio =  1;
	// });


// clave serie 87




//  Filtro (Acción PorClaveSerie):
// Body: {“PCveInd”:”{CVEIND}”, “PAnoIni”:”{AÑOINI}”, “PAnoFin”:”{AÑOFIN}”,  “POrden”:”{ORDEN}”, “PIdioma”:”{IDIOMA}”}
/*
$.post( "https://operativos.inegi.org.mx/datos/api/Valores/PorClaveSerie",
			{'PCveSer':'87', 'PIdioma':'ES'}, function( data, textStatus, jqxhr ) {

	});

	*/
