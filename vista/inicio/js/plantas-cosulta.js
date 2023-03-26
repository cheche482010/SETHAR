window.onload = function(){
var chat = document.getElementById('chat');
var user_input = document.getElementById('user-input');
var caracteristicas = [];
var btn_guardar = document.getElementById('guardar');

first_message();

function first_message(){
    cargar_mensaje('Hola!',1);
    setTimeout(function(){
        cargar_mensaje('Intentare adivinar la planta en la que piensas, ¿estás preparado(a)?',1);
        var button = document.createElement('button');
        button.className = 'btn btn-info mx-auto';
        button.type = 'button';
        button.innerText = 'Vamos!';
        button.onclick = function(){
            user_input.innerHTML = '';
            cargar_mensaje(`Vamos!`,0);
            setTimeout(function(){
                ask_question();
            },2000);
        }
        setTimeout(function(){
            user_input.querySelector('div').appendChild(button);
        },3000);
    },2500);
}

function cargar_mensaje(mensaje,tipo){
    var div = document.createElement('div');
    tipo == 1 ? div.className = 'loader loader-ia' : div.className = 'loader loader-user';
    var time = 2500;
    chat.appendChild(div);
    chat.scrollTop = chat.scrollHeight + 50;
    tipo == 1? time = 2500 : time = 800;
    setTimeout(function(){
        for (var i = 0; i < chat.children.length; i++){
            if(chat.children[i] == div){
                tipo == 1? div.className = 'ia' : div.className = 'user';
                div.innerText = mensaje;
            }
        }
    },time);
}

function ask_question(){
    $.ajax({
        type: "POST",
        url: BASE_URL + 'Plantas/get_question',
        data: {'caracteristicas' : caracteristicas}
    }).done(function(result){
          var datos = JSON.parse(result);
          //console.log(caracteristicas);
          //console.log(JSON.parse(datos['resp']));
          var btn_si = document.createElement('button');
          var btn_no = document.createElement('button');
          btn_si.className = 'btn btn-info';
          btn_si.style.marginRight = '30px';
          btn_no.className = 'btn btn-danger';
          btn_no.innerText =  'NO';
          btn_si.innerText = 'SI';
          btn_si.type = btn_no.type = 'button';
          var caracteristica = new Object();
          caracteristica['pregunta'] = datos['mensaje'];
          caracteristica['plantas'] = datos['id_plantas'];
          if(datos['resultados'] == 0){
            cargar_mensaje(datos['mensaje'],1);  
            btn_si.onclick = function(){
                user_input.innerHTML = '';
                caracteristica['respuesta'] = 1;
                caracteristicas.push(caracteristica);
                cargar_mensaje('Si',0);
                setTimeout(function(){
                    ask_question();
                },2000);
            }
            btn_no.onclick = function(){
                user_input.innerHTML = '';
                caracteristica['respuesta'] = 0;
                caracteristicas.push(caracteristica);
                cargar_mensaje('No',0);
                setTimeout(function(){
                    ask_question();
                },2000);

            }

           setTimeout(function(){
            user_input.appendChild(btn_si);
            user_input.appendChild(btn_no);
        },3000);
          }
          else{
            if(datos['resultados'] == 1){
            var mensaje_ia = '';
            var id_planta_result = '';
            datos['resp'] = JSON.parse(datos['resp']);
            for (var i = 0; i< datos['resp'].length; i++){
                var dato = datos['resp'][i];
                if(dato['descripcion']!=''){
                    mensaje_ia = '¿Su planta se puede describir como: '+ dato['descripcion'] + ' ?';
                    id_planta_result = dato['id'];
                }
            }
            cargar_mensaje(mensaje_ia,1);  
            btn_si.onclick = function(){
                user_input.innerHTML = '';
                caracteristica['respuesta'] = 1;
                caracteristicas.push(caracteristica);
                cargar_mensaje('Si',0);
                setTimeout(function(){
                    consultar_resultado(id_planta_result);
                },2000);
            }
            btn_no.onclick = function(){
                user_input.innerHTML = '';
                caracteristica['respuesta'] = 0;
                caracteristicas.push(caracteristica);
                cargar_mensaje('No',0);
                if(caracteristicas.length < 30){
                    ask_question();
                }
                else{
                    cargar_mensaje('No he podido adivinar aun tu planta :c . Si la registras, podria adivinarla una próxima ocasión...',1);
                    setTimeout(function(){
                        $('#modal_registro').modal('show');
                    },4000);
                }
            }
           setTimeout(function(){
            user_input.appendChild(btn_si);
            user_input.appendChild(btn_no);
        },3000);
    }
    else{
        $('#modalRegistro').modal('show');
    }
          }
    });
}

function consultar_resultado(id) {
    $.ajax({
        type : "POST",
        url: BASE_URL + 'Plantas/get_planta',
        data: {'id' : id}
    }).done(function(result){
        //console.log(result);
        var btn_si = document.createElement('button');
          var btn_no = document.createElement('button');
          btn_si.className = 'btn btn-info';
          btn_si.style.marginRight = '30px';
          btn_no.className = 'btn btn-danger';
          btn_no.innerText =  'NO';
          btn_si.innerText = 'SI';
          btn_si.type = btn_no.type = 'button';
          cargar_mensaje(result,1); 
          btn_si.onclick = function(){
            user_input.innerHTML = '';
            cargar_mensaje('Si',0); 
            setTimeout(function(){
                cargar_mensaje('Te dije que adivinaría tu planta ;)...',1);
            },3000);
        }

        btn_no.onclick = function(){
            user_input.innerHTML = '';
            cargar_mensaje('No',0);
            setTimeout(function(){
                    ask_question();
            },2000);
        }
        setTimeout(function(){
            user_input.appendChild(btn_si);
            user_input.appendChild(btn_no);
        },3000);
    })
}

btn_guardar.onclick = function(){
    $('#modal_registro').modal({backdrop: 'static', keyboard: false});
    var nombre_comun = document.getElementById('nombre_comun');
    var nombre_cientifico = document.getElementById('nombre_cientifico');
    var familia_cientifica = document.getElementById('familia_cientifica');
    var forma = document.getElementById('forma');
    var tamanio = document.getElementById('tamanio');
    var textura = document.getElementById('textura');
    var color = document.getElementById('color');
    var hojas = document.getElementById('hojas');
    var tronco = document.getElementById('tronco');
    var flores = document.getElementById('flores');
    var descripcion = document.getElementById('descripcion');
    var habitat = document.getElementById('habitat');

    if(nombre_cientifico.value == '' || nombre_comun.value == '' || familia_cientifica.value == '' 
    || forma.value == '' || tamanio.value == '' || textura.value == '' 
    || color.value == '' || hojas.value == '' || flores.value == '' 
    || tronco.value == '' || descripcion.value == '' ){
        
        swal({
            type: 'error',
            title: 'Error',
            text: 'Todos los campos deben ser llenados',
            timer: 2000,
            showConfirmButton: false
        });
    }
    else{
        var datos = new Object();
        datos['nombre_comun'] = nombre_comun.value;
        datos['nombre_cientifico'] = nombre_cientifico.value;
        datos['familia_cientifica'] = familia_cientifica.value;
        datos['forma'] = forma.value;
        datos['tamanio'] = tamanio.value;
        datos['textura'] = textura.value;
        datos['color'] = color.value;
        datos['hojas'] = hojas.value;
        datos['tronco'] = tronco.value;
        datos['descripcion'] = nombre_comun.value;
        datos['id_habitats'] = habitat.value;
        datos['flores'] = flores.value;

        $.ajax({
            type: "POST",
            url: BASE_URL + 'Plantas/insert_planta',
            data: {'datos' : datos}
        }).done(function(result){
            swal({
                type: 'success',
                title: 'Exito',
                text: 'Ahora podre recordar esta planta en futuras ocasiones',
                timer: 2000,
                showConfirmButton: false
            });
            $('#modal_registro').modal('hide');
            cargar_mensaje('Gracias por hablar conmigo ;)',1);
        })
    }
}
}
