<?php 
// constantes
  const SERVIDOR = 'localhost';
  const USUARIO = 'root';
  const CONTRASENIA = '';
  CONST BBDD = 'merana';

// detectamos su recibimos datos por post

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      
         // conexión a la BBDD
        $conn = mysqli_connect(SERVIDOR, USUARIO, CONTRASENIA, BBDD);

        if(!$conn){
          die("La conexión a fallado: ". mysqli_connect_error());
        }

      // recopilación de los datos entregados por POST
      $rut = $_POST['rut'];
      $edad = $_POST['edad'];
      $genero = $_POST['genero'];
      $frecuencia = $_POST['frecuencia'];
      $horario = $_POST['horario'];
      $linea = implode($_POST['linea'], ",");
      $calidad = $_POST['calidad'];
      $observaciones = $_POST['observaciones'];

      // validación en el backend

      if(!empty($rut) && !empty($edad) && !empty($genero) && !empty($frecuencia) && !empty($horario) && !empty($linea) && !empty($calidad) && !empty($observaciones)){

              // consulta de la base de datos

          $query = "INSERT INTO merana.encuesta_metro 
          (rut,edad,genero,frecuencia,horario,linea_metro,calidad_servicio,observaciones,fecha_hora) 
          VALUES 
          ('$rut',$edad,'$genero','$frecuencia','$horario','$linea','$calidad','$observaciones',now());";
        
          // var_dump($query);
          // exit;

          if(mysqli_query($conn, $query)){
            
            header('Location: index.php?insert=true&rut='.$rut.'&edad='.$edad.'&genero='.$genero.'&frecuencia='.$frecuencia.'&horario='.$horario.'&linea='.$linea.'&calidad='.$calidad.'&observaciones='.$observaciones);

          } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
          }
          
          mysqli_free_result($query);

          } else{
            header('Location: index.php?error=true');
          }

          mysqli_close($conn);

    }


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/estilos.css">

    <title>MERANA FORM</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <!-- validación en backend -->
              <?php 
              // validación error
              if (isset($_GET['error'])) {
                    echo "<i style='color: red;'>Error al procesar los datos, intente nuevamente</i>";
                  }
              if(isset($_GET['insert'])){
                $rut = $_GET['rut'];
                $edad = $_GET['edad'];
                $genero = $_GET['genero'];
                $frecuencia = $_GET['frecuencia'];
                $horario = $_GET['horario'];
                $linea = $_GET['linea'];
                $calidad = $_GET['calidad'];
                $observaciones = $_GET['observaciones'];
                $resumenObs = substr($observaciones,-20);


                echo "<i style='color: green; font-size: 30px;'><b>Felicidades<br>Los datos han sido insertados de forma correcta en la base de datos</b></i>";
                echo "<p style='border: 1px solid black; overflow:hidden'>Con la siguiente información:<br><br>
                          <b>RUT</b>: $rut<br>
                          <b>Edad</b>: $edad<br>
                          <b>Genero</b>: $genero<br>
                          <b>Frecuencia</b>: $frecuencia<br>
                          <b>Horario</b>: $horario<br>
                          <b>Línea</b>: $linea<br>
                          <b>Calidad</b>: $calidad<br>
                          <b>Extracto Observaciones</b>: <i>$resumenObs</i>...<br>

                </p>";
                

              }
                  
                  ?>
              <!-- fin de mensaje de validación -->


            
            <h1  class="mb-5 mt-3 titulo"><i>Encuesta <b>Online</b></i></h1>
            <!-- logo creado con la herramienta https://www.canva.com/ -->
            <img class="logo mt-3" src="img/logo.png" alt="Logo Merana">
          
          <div class="clearfix"></div>
            <!-- inicio formulario -->
            <form action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="POST" id="formulario" >

             <!-- INFORMACIÓN:
               input oculto con fecha y hora
               cerca del final de este documento esta el script realizado para dar el valor de este 
               campo oculto de manera automatica, la función creada se llama dateTime()
               tambien se puede visualizar desde Chrome en las opciones de desarollador en la consola
            -->

              <!-- MENSAJE: Este INPUT es reemplazado por el uso del campo fecha_hora tipo timestamp en la base de datos              
              <input type="hidden" name="datetime" id="datetime"  value="" disabled> -->

              <!-- FIN input oculto con fecha y hora  -->

                <!-- Datos personales -->
                <h2>Datos personales</h2>
                <br>
                <div class="form-group row">
                  <label for="RUT" class="col-sm-2 col-form-label">RUT</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      class="form-control"
                      type="text"
                      name="rut"
                      id="rut"
                      maxlength="12"
                      pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}-[0-9kK]"
                      placeholder="11.111.111-1"
                      autofocus
                      required
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="edad" class="col-sm-2 col-form-label">Edad</label>
                  <div class="col-sm-10">
                    <input
                      class="form-control"
                      type="number"
                      name="edad"
                      id="edad"
                      maxlength="3"
                      min="10"
                      max="120"
                      placeholder="edad.."
                      required
                    />
                  </div>
                </div>
                <!-- Fin Datos personales -->
                <hr>
                <!-- Género -->
                <h2>Género</h2>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="genero"
                    id="generoM"
                    value="M"
                    required
                  />
                  <label class="form-check-label" for="generoM">
                    Masculino
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="genero"
                    id="generoF"
                    value="F"
                    required
                  />
                  <label class="form-check-label" for="generoF">
                    Femenino
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="genero"
                    id="generoO"
                    value="O"
                    required
                  />
                  <label class="form-check-label" for="generoO">
                    Otro
                  </label>
                </div>
              <!-- Fin Género -->
                <hr />
                <!-- Uso del servicio -->
                <h2>Uso del servicio</h2>
                <div class="form-group col-md-4">
                  <label for="frecuencia">Frecuencia</label>
                  <select id="frecuencia" class="form-control" name="frecuencia" required>
                    <option value=''>--Seleccione--</option>
                    <option value="nunca">Nunca</option>
                    <option value="poca">Poca</option>
                    <option value="regularmente">Regularmente</option>
                    <option value="siempre">Todo el tiempo</option>
                  </select>
                </div>
                <hr />
                <div class="form-group col-md-4">
                  <label for="horario">Horario</label>
                  <select id="horario" class="form-control" name="horario" required>
                    <option value=''>--Seleccione--</option>
                    <option value="punta">Punta</option>
                    <option value="medio">Medio</option>
                    <option value="valle">Valle</option>
                  </select>
                </div>
                <!-- Fin Uso del servicio -->
                <hr>
                <!-- Líneas de metro -->
                <h2 class="mb-3">Líneas de metro</h2>
                <i style="color: green"><b>Puede realizar una selección múltiple</b></i>
                <br><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea1" value="1">
                    <label class="form-check-label" for="linea1">Línea 1</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea2" value="2">
                    <label class="form-check-label" for="linea2">Línea 2</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea3" value="3" >
                    <label class="form-check-label" for="linea3">Línea 3</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea4" value="4" >
                    <label class="form-check-label" for="linea4">Línea 4</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea4a" value="4a" >
                    <label class="form-check-label" for="linea4a">Línea 4a</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea5" value="5" >
                    <label class="form-check-label" for="linea5">Línea 5</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="linea[]" type="checkbox" id="linea6" value="6" >
                    <label class="form-check-label" for="linea6">Línea 6</label>
                  </div>
                <!-- Fin Líneas de metro -->
                <hr>
                <!-- Calidad general del servicio -->
                <h2>Calidad general del servicio</h2>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="calidad" id="malo" value="malo" required>
                  <label class="form-check-label" for="malo">Malo</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="calidad" id="deficiente" value="deficiente" required>
                  <label class="form-check-label" for="deficiente">Deficiente</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="calidad" id="regular" value="regular" required>
                  <label class="form-check-label" for="regular">Regular</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="calidad" id="bueno" value="bueno" required>
                  <label class="form-check-label" for="bueno">Bueno</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="calidad" id="excelente" value="excelente" required>
                  <label class="form-check-label" for="excelente">Excelente</label>
                </div>
                <!-- Fin Calidad general del servicio -->
                <hr>
                <!-- Observaciones -->
                <div class="form-group">
                  <i style="color: green"><b>Máximo 200 caracteres</b></i>
                  <div id="res">0 caractere/s</div>
                  <br>
                  <label for="observaciones">Observaciones personales</label>
                  <textarea 
                  class="form-control" 
                  id="observaciones" 
                  name="observaciones"
                  rows="3" 
                  maxlength="200" 
                  onpaste="contarcaracteres();" 
                  onkeyup="contarcaracteres();"
                  required
                  ></textarea>
                </div>
                <!-- Fin Observaciones -->
                <br>
                <input type="submit" id='enviar' class="btn btn-primary mt-3" value="Enviar" />
                <input type="reset" class="btn btn-info mt-3" value="Restablecer formulario" />
            </form>
            <!-- Fin del formulario  -->
            <hr>
            <footer>&copy; Felipe Ignacio Mancilla Reyes</footer>
            <br><br>
          </div>
        </div>
      </div>
    </div>


    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <!-- IMPORTANTE: Script de JavaScript Personales -->
    <script>
      
        // Script para la validación de los check's de las líneas de metro
          document.getElementById('formulario').onsubmit = function (e) {
            var checkbox = document.getElementsByName("linea[]"),
                i,
                checked;
            for (i = 0; i < checkbox.length; i += 1) {
              checked = (checkbox[i].checked||checked===true)?true:false;
            }

            if (checked == false) {
              alert('Seleccione al menos una línea de metro!');
              e.preventDefault();
              return false;
            } 
            // else if(confirm('confirm submit?')) {
            //   alert('done!');
            //   return true;
            // }
          }
        // fin sctipt 

      // contador de catacteres 

      function contarcaracteres(){
		
    //Contador de caracteres permitidos
          var total=200;

            setTimeout(function(){
            var valor=document.getElementById('observaciones');
            var respuesta=document.getElementById('res');
            var cantidad=valor.value.length;
            document.getElementById('res').innerHTML = cantidad + ' caractere/s, te quedan ' + (total - cantidad);

              if(cantidad>total){
                respuesta.style.color = "red";
              }
              else {
              respuesta.style.color = "black";
              }
            },10);

            }
    //Fin contador de caracteres permitidos

            // Validar inputs vacíos

            $(document).ready(function() {
              $("#enviar").click(function() {

                //var contenido = $("#miParrafo").text();

                var campo_rut = $("#rut").val().trim();
                var campo_edad = $("#edad").val().trim();
                var campo_observaciones = $("#observaciones").val().trim();

                //si esta vacio lanza error
                if (campo_rut.length == 0 ||
                campo_edad.length == 0 ||
                campo_observaciones.length == 0) {
                  alert("Alerta:\n Los campos rut, edad y observaciones no deben estar vacíos!");
                } 
                // else {
                //   alert("Todo correcto");
                // }

              });
            });





    </script>
    <!-- FIN Script de JavaScript Personales -->

  </body>
</html>
