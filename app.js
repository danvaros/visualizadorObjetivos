// $(window).onload(function(){
// 	$('#preloader').fadeOut('slow',function(){$(this).remove();});
// });


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




$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClaveSerie",
  data: {'PCveInd':'27','PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC','PCveSer':'99', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {
  		//alert( "Exito" );
		console.log(data);
		console.log('------------------------------------- nuevo arreglo  --------------------');
		console.log(data.Series);
		console.log(data.Series[0]);
		console.log(data.Series[0].Coberturas);
		console.log(data.Series[0].Coberturas.length);

		
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

		//inicio =  1;
		setTimeout(function(){$('#preloader').fadeOut('slow',function(){$(this).remove();});},3000);
  },
  async:false
});






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