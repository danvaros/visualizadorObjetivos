// $(window).onload(function(){
// 	$('#preloader').fadeOut('slow',function(){$(this).remove();});
// });

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
  var vars = query.split("?");
  console.log(vars[0]);
  var PCveInd = vars[0];
  var Codigo_ind = '';
  var Descrip_ind = '';

$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",
  data: {'PCveInd': PCveInd,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {
  		//alert( "Exito" );
		console.log(data);
		console.log('------------------------------------- nuevo arreglo  --------------------');
		console.log(data.Series);
		console.log(data.Series[0]);
		console.log(data.Series[0].Coberturas);
		console.log(data.Series[0].Coberturas.length);

		Codigo_ind 	=	data.Codigo_ind;
  		Descrip_ind = 	data.Descrip_ind;


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

		console.log(estados);

		var codigo_indicador = data.Codigo_ind;
		console.log(codigo_indicador);
		var descripcion = data.Descrip_ind;
		console.log(descripcion);

		$('.Codigo_ind').html(Codigo_ind);
		$('.Descrip_ind').html(Descrip_ind);
		//alert(Descrip_ind);

		//inicio =  1;
		setTimeout(function(){$('#preloader').fadeOut('slow',function(){$(this).remove();});},3000);
  },
  async:false
});


$(document).ready(function()
{
  titulos(PCveInd);
});

function titulos(indicador){
      var atributos = getAtributos(indicador);
      var titulo   =  '<h4>'+ atributos.DescripInd_des  +'</h4>' +
                      '<li class="divider"></li> ' +
                      '<p> '+ atributos.CobTemporal_ser +' </p>' +
                      '<span> '+ atributos.Descrip_uni +'</span>';


      var pie  =' <div><strong>Nota:</strong> '+ ((atributos.Descrip_not != null) ? atributos.Descrip_not : ' A partir de 2007 se excluyen defunciones con residencia en el extranjero y a partir de 2009 las defunciones extemporáneas</div> ')+
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
