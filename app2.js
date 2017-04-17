var estados = [];

$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",
  data: {'PCveInd': 23,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {
  // 		//alert( "Exito" );
		console.log(data);
		console.log('------------------------------------- nuevo arreglo  --------------------');
		// console.log(data.Series);
		// console.log(data.Series[0]);
		// console.log(data.Series[0].Coberturas);
		// console.log(data.Series[0].Coberturas.length);

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

		// var codigo_indicador = data.Codigo_ind;
		// console.log(codigo_indicador);
		// var descripcion = data.Descrip_ind;
		// console.log(descripcion);

		// $('.Codigo_ind').html(Codigo_ind);
		// $('.Descrip_ind').html(Descrip_ind);
		// //alert(Descrip_ind);

		// //inicio =  1;
		// $('#loader').delay(2000).fadeOut("slow");
		// titulos(PCveInd);
  },
  async:false
});
