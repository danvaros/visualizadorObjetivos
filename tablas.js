// $(document).ready(function(){
//   $.ajax({
//     type: 'POST',
//     url: "http://agenda2030.mx/datos/api/Valores/PorClave",
//     data: {'PCveInd': 210,'PAnoIni':'0', 'PAnoFin':'0', 'POrden':'DESC', 'PIdioma':'ES'},
//     success: function( data, textStatus, jqxhr ) {
//       CoClanidada(data);
//     },
//     async:false
//   });
// });

//ultimo indicador
//210
//funcion para quitar repetidos
Array.prototype.unique=function(a){
  return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
});

//tabla para cobertura series
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
        tabuladoCoS += '<td> ND </td>';
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

function tablaCoCl(data){
  var tabuladoCoCl  =  '';
  var cabezera      =  false;
  var years         =  [];

  console.log(data);

  for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
    if(!cabezera){
      var total_columnas = 0;
      //tabuladoCoCl  +=  '<tr><th rowspan="2"> Entidades federativas </th>';
      tabuladoCoCl  +=  '<tr>';
      for (var j = 0; j < data.Series[0].Coberturas[i].Clasificaciones.length; j++) {
        years.push(data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.AADato_ser);

        tabuladoCoCl  +=  '<th> ' + data.Series[0].Coberturas[i].Clasificaciones[j].Descrip_cla + '</th>';

        total_columnas++;
      }//fin for j

      tabuladoCoCl  +=  '</tr>';
      years = years.unique();
      cabezera = true;
      var subTabulado = '<table><tr><th rowspan="2"> Entidades federativas</th>';
      var sizeYear =  total_columnas/years.length;
      for (var k = 0; k < years.length; k++) {
        subTabulado +=  '<th colspan="'+ sizeYear +'">' + years[k] +'</th>'
      }//fin for k
      subTabulado += '</tr>';

      tabuladoCoCl =   subTabulado +' '+ tabuladoCoCl;
      console.log(tabuladoCoCl);
    }//fin if condicion cabezera

    tabuladoCoCl   +=  '<tr ><td>'+ data.Series[0].Coberturas[i].Descrip_cg +'</td>';
    for (var j = 0; j < data.Series[0].Coberturas[i].Clasificaciones.length; j++) {
      if(data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato == ""){
        tabuladoCoCl   +=  '<td> ND </td>';
      }else{
        tabuladoCoCl   +=  '<td>'+ data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato +'</td>';
      }
    }//fin for j
      tabuladoCoCl   += '</tr>';
  }//fin for i
    tabuladoCoCl   += '</table>';
    console.log(tabuladoCoCl);
    $('#tabla').html(tabuladoCoCl);
}//fin de la funsion

function AClanidada(data){
  console.log(data);
  var labelYear = '';
  var tabuladoAnidado =  '';
  var subTabuladoAnidado =  '<table>';
  var primera = true;
  var cabezera =  false;
  var labels   = [];

  for (var i = 0; i < data.Series[0].Coberturas[0].Clasificaciones.length; i++) {
    labels.push(data.Series[0].Coberturas[0].Clasificaciones[i].Descrip_cla);

    if(labelYear == data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser){
        tabuladoAnidado += '<td>' + data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato + '</td>';
    }else if(primera){
      primera=false;
      tabuladoAnidado += '<tr><td>'+ data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser +'</td><td>'+data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato+'</td>';
      labelYear = data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser;
    }
    else{
      tabuladoAnidado += '</tr><tr><td>'+ data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser +'</td><td>'+data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato+'</td>';
      labelYear = data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser;
    }
  }//fin for i
  tabuladoAnidado +=  '</tr></table>';
  labels =  labels.unique();
  subTabuladoAnidado += '<tr><td rowspan="2">Periodo</td><td colspan="'+ labels.length +'">Total</td><td colspan="'+ labels.length +'">Hombres</td><td colspan="'+ labels.length +'">Mujeres</td></tr>'
  subTabuladoAnidado += '<tr>';
  for (var i = 0; i < 3; i++) {
    for (var j = 0; j < labels.length; j++) {
        subTabuladoAnidado += '<td>'+labels[j]+'</td>';
    }
  }
  subTabuladoAnidado += '</tr>';
  tabuladoAnidado = subTabuladoAnidado + tabuladoAnidado;
  $('#tabla').html(tabuladoAnidado);
}

function tablaACl(data){
  console.log(data);
  var labelYear = '';
  var tabuladoAnidado =  '';
  var subTabuladoAnidado =  '<table>';
  var primera = true;
  var cabezera =  false;
  var labels   = [];

  for (var i = 0; i < data.Series[0].Coberturas[0].Clasificaciones.length; i++) {

    labels.push(data.Series[0].Coberturas[0].Clasificaciones[i].Descrip_cla);

    if(labelYear == data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser){
        tabuladoAnidado += '<td>' + data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato + '</td>';
    }else if(primera){
      primera=false;
      tabuladoAnidado += '<tr><td>'+ data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser +'</td><td>'+data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato+'</td>';
      labelYear = data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser;
    }
    else{
      tabuladoAnidado += '</tr><tr><td>'+ data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser +'</td><td>'+data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.Dato_Formato+'</td>';
      labelYear = data.Series[0].Coberturas[0].Clasificaciones[i].ValorDato.AADato_ser;
    }
  }//fin for i
  tabuladoAnidado +=  '</tr></table>';
  console.log(tabuladoAnidado);
  console.log(labels);
  labels =  labels.unique();

  subTabuladoAnidado += '<tr><td>Periodo</td>';

    for (var j = 0; j < labels.length; j++) {
        subTabuladoAnidado += '<td>'+labels[j]+'</td>';
    }

  subTabuladoAnidado += '</tr>';
  tabuladoAnidado = subTabuladoAnidado + tabuladoAnidado;
  $('#tabla').html(tabuladoAnidado);
}

function tablaAS(data){
  console.log(data);
  var tabuladoAS =  '<table><tr><th>Periodo</th><th>'+ data.Descrip_ind +'</th></tr>';
  for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
    for (var j = 0; j < data.Series[0].Coberturas[i].ValorDato.length; j++) {
      tabuladoAS += '<tr><td>'+ data.Series[0].Coberturas[i].ValorDato[j].AADato_ser   +'</td><td>' + data.Series[0].Coberturas[i].ValorDato[j].Dato_Formato +'</td></tr>';
    }//fin for J
  }//fin for i
  tabuladoAS += '</table>';
  $('#tabla').html(tabuladoAS);
}

function tablaClA(data){
  var tabuladoClA =  '<table><tr><th>'+ data.Descrip_ind +'</th><th>'+ data.Series[0].Coberturas[0].Clasificaciones[0].ValorDato.AADato_ser+'</th></tr>';
  for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
    for (var j = 0; j < data.Series[0].Coberturas[i].Clasificaciones.length; j++) {
      if(data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato == ""){
        tabuladoClA += '<tr><td>'+ data.Series[0].Coberturas[i].Clasificaciones[j].Descrip_cla   +'</td><td> ND </td></tr>';
      }else{
        tabuladoClA += '<tr><td>'+ data.Series[0].Coberturas[i].Clasificaciones[j].Descrip_cla   +'</td><td>' + data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato +'</td></tr>';
      }
    }//fin for J
  }//fin for i
  tabuladoClA += '</table>';
  $('#tabla').html(tabuladoClA);
}

function CoClanidada(data){
  console.log(data);
  var tabulado =  '';
  var subTabuladoAnidado =  '<table>';
  var cabezera =  false;
  var clasificaciones = [];
  var years = [];
  var clasificaciones_diferentes;

  for (var i = 0; i < data.Series[0].Coberturas.length; i++) {
    if(!cabezera){
      for (var j = 0; j < data.Series[0].Coberturas[i].Clasificaciones.length; j++) {
        years.push(data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.AADato_ser);
        clasificaciones.push(data.Series[0].Coberturas[i].Clasificaciones[j].Descrip_cla);
      }
      years = years.unique();
      clasificaciones_diferentes = clasificaciones.unique().length;
      console.log(years.length);
      console.log(clasificaciones);
      console.log(clasificaciones_diferentes);
      cabezera = true;
    }

    tabulado += '<tr><td>' + data.Series[0].Coberturas[i].Descrip_cg + '</td>';
    for (var j = 0; j < data.Series[0].Coberturas[i].Clasificaciones.length; j++) {
      if(data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato == ""){
          tabulado += '<td> ND </td>';
      }else{
        tabulado += '<td>' + data.Series[0].Coberturas[i].Clasificaciones[j].ValorDato.Dato_Formato + '</td>';
      }
    }
    tabulado += '</tr>' ;
  }//fin for i
  tabulado += '</table>';
  var total = ((clasificaciones.length) / clasificaciones_diferentes ) / 3;
  var a = clasificaciones.length / years.length;

  subTabuladoAnidado +=  '<tr><th rowspan="3">Entidad Federativa</th>';

  for (var i = 0; i < years.length; i++) {
    subTabuladoAnidado += '<th colspan="'+ a +'">'+ years[i]+'</th>';
  }

  subTabuladoAnidado +=  '</tr><tr>';

  for (var i = 0; i < total; i++) {
      subTabuladoAnidado +=  '<th colspan="'+clasificaciones_diferentes+'">Total</th><th colspan="'+clasificaciones_diferentes+'">Hombres</th><th colspan="'+clasificaciones_diferentes+'">Mujeres</th>';
  }
  subTabuladoAnidado +=  '</tr><tr>';
  for (var i = 0; i < clasificaciones.length; i++) {
    subTabuladoAnidado +=  '<th>'+ clasificaciones [i]+'</th>';
  }

  subTabuladoAnidado +=  '</tr>';
  tabulado =  subTabuladoAnidado + tabulado;
  $('#tabla').html(tabulado);
}
