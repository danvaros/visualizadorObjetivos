var estados = [];

 getIndicador(26,87);

 function getSerie(indicador)
 {
   $.ajax({
   	  type: 'POST',
   	  url: "https://operativos.inegi.org.mx/datos/api/AtrIndicador/PorClave",
   	  data: {'PCveInd':indicador, 'PIdioma':'ES'},
   	  success: function( data, textStatus, jqxhr )
      {
        console.log("llamada",indicador);
        console.log("Serie:::::",data.Serie[0].ClaveSer_ats);
        getIndicador(indicador,data.Serie[0].ClaveSer_ats);
      },
      error:function( data, textStatus, responseJSON )
      {
        console.log(data);
        console.log(data.responseJSON.Message);
        if(data.responseJSON.Message == "La clave de indicador NO existe")
        {
          alert("El indicador no contiene valores\nPor favor selecciona otro");
        }
        if(data.responseJSON.Message == "An error has occurred.")
        {
          alert("Ocurrio un error al solicitar los datos");
        }
      },
  	  async:false
    });
 }

function getIndicador(indicador,ser){
	estados = [];
  console.log("Indicador",indicador," -> Serie",ser);
	$.ajax({
	  type: 'POST',
	  url: "https://operativos.inegi.org.mx/datos/api/Valores/PorClaveSerie",
	  data: {'PCveInd':indicador,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC','PCveSer': ser , 'PIdioma':'ES'},
	  success: function( data, textStatus, jqxhr ) {
	  		//alert( "Exito" );
			console.log(data);
			console.log('------------------------------------- nuevo arreglo  --------------------');
			console.log(data.Series);
			console.log(data.Series[0]);
			console.log(data.Series[0].Coberturas);
			console.log(data.Series[0].Coberturas.length);

      if(data.Series[0].Coberturas.length != 34)
      {
        alert("La llamada no contiene valores para todos los estados");
      }
      else
      {
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
      }
	  },
	  async:false
	});
}
