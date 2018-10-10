<?php 
ob_start();

$editar = new MvcController();

$editar -> editarAlumnoController();

$editar -> actualizarAlumnoController();

if(isset($_GET["Cambio"])){
	if($_GET["Cambio"]){
	   echo "<center><font size='6' color='green'>Alumno Actualizado Correctamente</font></center>";
	}
}
 ?>