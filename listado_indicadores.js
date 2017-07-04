$(document).ready(function(){
	get_tematica();
	$('#listado_indicadores').change(function(){
		//alert( $('#listado_indicadores select').val() );
		window.location.href = ''+$('#listado_indicadores select').val();
	});
});

function get_tematica(){
	var url = 'http://agenda2030.mx/datos/api/Tematica/Todos';
    var parametros =  {"PIdioma":"ES"}
    $.ajax({
      type: 'POST',
      url: url,
      data: parametros,
      success: function( data, textStatus, jqxhr ) {
         crea_lista(data);
      },
      async:false
    });
}

function crea_lista(data){
	var contenido =  '<select>';
	var contenedor  = $('#listado_indicadores');
	for (var i = 0; i < data.length; i++) {
		contenido = contenido + '<optgroup label="'+ data[i].Abrevia_des +'">';
		for (var j = 0; j < data[i].Meta.length; j++) {
			for (var k = 0; k < data[i].Meta[j].Indicador.length; k++) {
				var clave_arb     = data[i].Meta[j].Indicador[k].ClaveInd_arb;
				var codigo_dg     = data[i].Meta[j].Indicador[k].DesGeo.Codigo_dg;
				var descrip_des   = data[i].Meta[j].Indicador[k].Descrip_des;
				var codigo_des    = data[i].Meta[j].Indicador[k].Codigo_des;
				contenido = contenido + '<option value="indicadores.html?objetivo='+data[i].Codigo_des+'&meta='+data[i].Meta[j].Clave_arb+'&indicador='+clave_arb+'&codigo='+codigo_dg+'&obj='+data[i].Clave_arb+'">'+data[i].Meta[j].Indicador[k].Codigo_des +' '+  data[i].Meta[j].Indicador[k].Descrip_des+'</option>';
			}
		}
		contenido = contenido + '</optgroup>';
	}
	contenido = contenido + '</select>';
	contenedor.html(contenido);

	$('select').material_select();
}





// <optgroup label="2. Hambre cero">
// <option value="4">2.1.2. Proporción de la población con inseguridad alimentaria moderada o severa (carencia por acceso a la alimentación)</option>
// </optgroup>
// <optgroup label="3. Salud y bienestar">
// <option value="5">3.1.1. Razón de mortalidad materna</option>
// <option value="6">3.1.2. Proporción de partos con asistencia de personal sanitario especializado</option>
// </optgroup>
// </select>
