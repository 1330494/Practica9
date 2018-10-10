<?php
class MvcController{
	//Llamar a la plantilla
	public function plantilla(){
		//include se utiliza para invocar el archivo que ocntiene el codigo html
		include "views/template.php";
	}
	//INTERACCION CON EL USUARIO
	public function enlacesPaginasController(){
		//TRABAJAR CON LOS ENLACES DE LAS PAGINAS
		//VALIDAMOS SI LA VARIABLE "action" VIENE VACIA, ES DECIR, CUANDO SE ABRE LA PAGINA POR PRIMERA VEZ SE DEBE CARGAR LA VISTA index.php

		if(isset($_GET["action"])){
			//guardar el valor de la variable action en "views/modules/navegacion.php" en el cual se recibe mediante el metodo GET esa variable 
			$enlacesController = $_GET["action"];
		}
		else{
			//Si viene vacio inicializo con index
			$enlacesController = "index";
		}
		//Mostrar los archivos de los enlaces de cada una de las secciones: Inicio, Nosotros, etc
		//PARA ESTO HAY QUE MANDAR AL MODELO PARA QUE HAGA DICHO PROCESO Y MUESTRE LA INFORMACION
		$respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
		include $respuesta;
	}

	public function NavController()
	{
		EnlacesPaginas::NavegacionModel();
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Control para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteAlumnoController(){
		// Obtenemos el ID del alumno a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del alumno a eliminar
			$respuesta = AlumnoData::deleteAlumnoModel($datosController, "alumnos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de alumnos
				header("location:index.php?action=Alumnos");
			}
		}
	}

	# REGISTRO DE USUARIOS
	#------------------------------------
	public function nuevoAlumnoController(){

		if(isset($_POST["GuardarAlumno"])){
			//Recibe a traves del método POST el name (html) de matricula, imagen, nombre, carrera, situacion_academica, correo y tutor se almacenan los datos en una variable de tipo array con sus respectivas propiedades (matricula, imagen, nombre, carrera, situacion_academica, correo, tutor):
			$archivoTemp = $_FILES['imagenReg']['tmp_name'];
			$image =$_FILES['imagenReg']['name'];
			$format = explode('.', $image);
			//echo $archivoTemp." - ".$image." - ".$format[1]."<br>";

			$datosController = array( 
				"matricula"=>$_POST['matriculaReg'],
				"imagen"=>$_POST['matriculaReg'].".".$format[1],
				"nombre"=>$_POST['nombreReg'],
				"carrera"=>$_POST['carreraReg'],
				"situacion_academica"=>$_POST['situ_acaReg'],
				"correo"=>$_POST['correoReg'],
				"tutor"=>$_POST['tutorReg']
			);
			print_r($datosController);
	
			//Se le dice al modelo models/UsuarioCrud.php (AlumnoData::newAlumnoModel),que en la clase "AlumnoData", la funcion "newAlumnoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "alumnos":
			$respuesta = AlumnoData::newAlumnoModel($datosController, "alumnos");
			// Movemos el archivo de imagen al server				
			move_uploaded_file($archivoTemp, 'alumnos/'.$_POST['matriculaReg'].".".$format[1]);

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				
				header("Location: index.php?action=Ok");
			}
			else{
				header("location:index.php");
			}			
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaAlumnosController(){

		$respuesta = AlumnoData::viewAlumnosModel("alumnos");
		$par = "";
		$inpar = "";  
		$posPar = 0;
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table>
			<thead>
				<tr>
					<th>Img.</th>
					<th>Matricula</th>
					<th>Nombre</th>
					<th>Carrera</th>
					<th>Sit. Acad.</th>					
					<th>Correo</th>
					<th>Tutor</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>';
				foreach($respuesta as $alumno){
					if ($posPar%2 == 0) {$par="par";$inpar="inpar2";}
					else{$par="";$inpar="inpar";}
				echo'<tr>
					<td id="'.$inpar.'"><img class="icon" src="alumnos/'.$alumno["imagen"].'"></td>
					<td id="'.$par.'">'.$alumno["matricula"].'</td>
					<td id="'.$par.'">'.$alumno["nombre"].'</td>
					<td id="'.$par.'">'.$alumno["carrera"].'</td>
					<td id="'.$par.'">'.$alumno["situacion_academica"].'</td>
					<td id="'.$par.'">'.$alumno["correo"].'</td>
					<td style="width:180px;" id="'.$par.'">'.$alumno["tutor"].'</td>
					<td id="'.$par.'"><a href="index.php?action=Editar&idAlumno='.$alumno["matricula"].'">Editar</a></td>
					<td id="'.$par.'"><a id="delete" href="index.php?action=Eliminar&idBorrar='.$alumno["matricula"].'">Eliminar</a></td>
					</tr>
				';
					$posPar++;
				}
	  echo '</tbody>
			</table>';
	}	

	#EDITAR USUARIOS
	#------------------------------------

	public function editarAlumnoController(){

		$datosController = $_GET["idAlumno"];
		$respuesta = AlumnoData::editarAlumnoModel($datosController, "alumnos");

		echo'
		<h1 id="font">Editar Usuario</h1>
    		<!-- form start -->
    		<form method="POST">
        		<center><img src="alumnos/'.$respuesta["imagen"].'"></center>
        		<br>
              	<label>Cambiar imagen:<sup>*Opional</sup></label><br>
              	<input type="file" name="imagenEditar" >
              	<br>

              	<label>Matricula:</label><br>
              	<input type="text" value="'.$respuesta["matricula"].'" readonly name="matriculaEditar" required >
              	<br>

              	<label>Nombre:</label><br>
              	<input type="text" value="'.$respuesta["nombre"].'" readonly name="nombreEditar" required >
              	<br>

              	<label>Carrera:</label><br>
              	<input type="text" value="'.$respuesta["carrera"].'" readonly name="carreraEditar" required >
              	<br>

              	<label>Situacion Academica:</label><br>
              	<input type="text" value="'.$respuesta["situacion_academica"].'" readonly name="situ_acaEditar" required >
              	<br>

              	<label>Correo:</label><br>
              	<input type="email" value="'.$respuesta["correo"].'" name="correoEditar" required >
	         	<br>
              	
              	<label for="tutorEditar">Tutor:</label><br>
              	<input type="text" id="tutorEditar" value="'.$respuesta['tutor'].'" name=tutorEditar" >
              	<br>					
 				
           		<center> <input type="submit" value="Actualizar" name="AlumnoEditar"> </center>
    		</form>';
	}

	#ACTUALIZAR USUARIOS
	#------------------------------------
	public function actualizarAlumnoController(){

		if(isset($_POST["AlumnoEditar"])){
			$datosController = array(
					"matricula" => $_POST["matriculaEditar"],
					"nombre"=>$_POST["nombreEditar"],
					"imagen"=>$_POST["imagenEditar"],
					"carrera"=>$_POST["carreraEditar"],
					"situacion_academica"=>$_POST["situ_acaEditar"],
					"correo"=>$_POST["correoEditar"],
					"tutor"=>$_POST["tutorEditar"]
				);
			
			$respuesta = AlumnoData::actualizarAlumnoModel($datosController, "alumnos");

			if($respuesta == "success"){
				header("Location: index.php?action=Editar&idAlumno=".$_POST["id"]."&Cambio=1");
			}else{
				echo "error";
			}
		}
	}

}

?>
narcizo231195