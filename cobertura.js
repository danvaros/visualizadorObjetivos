// estas globales se utilizara para generar el nuevo select
var arreglo_cla =  [];
var arreglo_agru =  [];
var arreglo_datos =  [];
var anios_cob = [];

//funcion para quitar repetidos
Array.prototype.unique=function(a){
  return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
});

function cobertura(data){
	arreglo_cla =  [];
	arreglo_agru =  [];
	arreglo_datos =  [];
	anios_cob = [];
	console.log('------------------------------------- nuevo cobertura  --------------------');
	console.log(data);
	//console.log('------------------------------------- nuevo arreglo  --------------------');
	//console.log(data.Series);
	// console.log(data.Series[0]);
	var Cobertura = data.Series[0].Coberturas;
	var clave_ser = data.Series[0].Clave_ser;
	console.log('clave serie : ' + clave_ser);


	// sacamos todos los años en caso de ser nacional solo se toma EUM
	anios_cob.push('Entidad');
	for (var i = 0; i < Cobertura[0].Clasificaciones.length; i++) {
		anios_cob.push(Cobertura[0].Clasificaciones[i].ValorDato.AADato_ser + '-01-01');
	}

	var Clasificaciones = Cobertura[0].Clasificaciones;

	for (var i = 0; i < Clasificaciones.length; i++) {
		arreglo_cla.push(Clasificaciones[i].Descrip_cla);
		arreglo_agru.push(Clasificaciones[i].ClaveAgrupa_ac);
	}

	//limpiamos el arreglo
	arreglo_cla = arreglo_cla.unique();
	arreglo_agru = arreglo_agru.unique();
	anios_cob = anios_cob.unique();

	console.log(arreglo_cla);
	for (var i = 0; i < arreglo_agru.length; i++) {
		$.ajax({
		  type: 'POST',
		  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorCobCla",
		  data: {'PCveInd': data.ClaveInd_ser,'PAnoIni':'0', 'PAnoFin':'0', 'PCveSer': clave_ser, 'POrden':'DESC','PCveCob':'99', 'PIdioma':'ES','PCveAgrupaCla' : arreglo_agru[i]},
		  success: function( data2, textStatus, jqxhr ) {
		  		//console.log('-------------------------- segunda llamada ----------------');
		  		//console.log(data.Series[0].Coberturas);
		  		var cober_inter = data2.Series[0].Coberturas;
		  		var arreglo_datos_tem = [];
		  		for (var i = 0; i < cober_inter.length; i++) {
		  			var temporal = [];
		  			temporal.push(cober_inter[i].Descrip_cg);
		  			for (var j = 0; j < cober_inter[i].Clasificaciones.length; j++) {
		  				temporal.push(cober_inter[i].Clasificaciones[j].ValorDato.Dato_ser);
		  			}
		  			arreglo_datos_tem.push(temporal)
		  		}
		  		arreglo_datos.push(arreglo_datos_tem)
		  },
		  async:false
		});
	}

	console.log(arreglo_datos);
}//fin de la función


function coberturaInsumos(data){

}
