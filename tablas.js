// $(document).ready(function(){
//   $.ajax({
//     type: 'POST',
//     url: "http://agenda2030.mx/datos/api/Valores/PorClave",
//     data: {'PCveInd': 26,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
//     success: function( data, textStatus, jqxhr ) {
//       tablaCoS(data);
//     },
//     async:false
//   });
// });

function tablaCoS(data){
  var tabuladoCoS =  '<table><tr>';
  var cabezera =  false;
  for (var i = 0; i < data.Series[0].Coberturas.length; i++) {

    //tomamos las cabezeras, años del primer dato
    if(!cabezera){
      tabuladoCoS += '<th> Estados </th>';
      for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
        tabuladoCoS += '<th>' + data.Series[0].Coberturas[i].ValorDato[j].AADato_ser + '</th>';
      }//fin for j
      cabezera = true;
    }

    tabuladoCoS += '</tr><tr><td>' +  data.Series[0].Coberturas[i].Descrip_cg + '</td>'
    for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
      if(data.Series[0].Coberturas[i].ValorDato[j].Dato_Formato == ""){
        tabuladoCoS += '<td> NA </td>';
      }else{
        tabuladoCoS += '<td>' + data.Series[0].Coberturas[i].ValorDato[j].Dato_Formato + '</td>';
      }
    }//fin for j
    tabuladoCoS += '</tr>';
  }//fin for i
    tabuladoCoS += '</table>';
    console.log(tabuladoCoS);
    $('#tabla').html(tabuladoCoS);
}//fin funcion
