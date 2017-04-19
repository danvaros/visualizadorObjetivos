var estados = [];

//funcion para quitar repetidos
Array.prototype.unique=function(a){
  return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
});

$.ajax({
  type: 'POST',
  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClave",
  data: {'PCveInd': 212,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
  success: function( data, textStatus, jqxhr ) {
  // 		//alert( "Exito" );
		// console.log(data);
		console.log('------------------------------------- nuevo arreglo  --------------------');
		console.log(data.Series);
		// console.log(data.Series[0]);
		var Cobertura = data.Series[0].Coberturas;
		console.log(Cobertura);

		// sacamos todas las entidades en caso de ser nacional solo se toma EUM
		var entidades = [];
		for (var i = 0; i < Cobertura.length; i++) {
			entidades.push(Cobertura[i].Descrip_cg);
		}

		var Clasificaciones = Cobertura[0].Clasificaciones;
		// se utilizara para generar el nuevo select
		var arreglo_cla =  [];
		for (var i = 0; i < Clasificaciones.length; i++) {
			arreglo_cla.push(Clasificaciones[i].Descrip_cla);
		}	
		
		//limpiamos el arreglo
		arreglo_cla = arreglo_cla.unique()
		for (var i = 0; i < arreglo_cla.length; i++) {
			arreglo_cla[i];
			
		}


		var arr1 =  [];
		var arr3 =  [];
		var arr2 =  [1,1,1,1,1,1,1,12,2,2,2,2,2,2];
		var arr4 =  [3,3,3,3,3,3,12,3,3];
		var total = [];
		
		arr1.push(arr2);
		arr1.push(arr2);
		arr1.push(arr2);
		arr1.push(arr2);
		arr1.push(arr3);
		arr1.push(arr4);

		total.push(arr1);
		total.push(arr1);
		total.push(arr1);

		console.log(arr1);
		console.log(total);



		// var temporal = [];
		// temporal.push('Entidad');
		// for (var j = 0; j < data.Series[0].Coberturas[0].ValorDato.length; j++) {
		// 	temporal.push(data.Series[0].Coberturas[0].ValorDato[j].AADato_ser+'-01-01');
		// }
		// estados.push(temporal);

		// for (var j = 0; j < data.Series[0].Coberturas[0].ValorDato.length; j++) {
		// 	temporal.push(data.Series[0].Coberturas[0].ValorDato[j].AADato_ser+'-01-01');
		// }
		
		// for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
		// 	var temporal = [];
		// 	temporal.push(data.Series[0].Coberturas[i].Descrip_cg);
		// 	for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
		// 		temporal.push(data.Series[0].Coberturas[i].ValorDato[j].Dato_ser);
		// 	}
		// 	estados.push(temporal);
		// }

		// console.log(estados);

  },
  async:false
});



