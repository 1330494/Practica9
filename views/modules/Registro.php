<?php ob_start(); ?>
<h1 id="font">+ Registrar Alumno</h1>

<form method="POST" enctype="multipart/form-data">
	<label>Matricula:</label><br>
	<input type="text" name="matriculaReg" placeholder="Matricula" required>
	<br>
	<label>Imagen:</label><br>
	<input type="file" id="imagenReg" name="imagenReg" required title="Selecciona una imagen" accept="image/*" required>
	<br>
	<center><output id="foto"></output></center>
	<br>
	<label>Nombre:</label><br>
	<input type="text" name="nombreReg" placeholder="Nombre" required>
	<br>	
	<label>Carrera:</label><br>
	<input type="text" name="carreraReg" placeholder="Carrera" required>
	<br>
	<label>Situacion Academica:</label><br>
	<input type="text" name="situ_acaReg" placeholder="Situacion Academica" required>
	<br>
	<label>E-Mail:</label><br>
	<input type="email" name="correoReg"  placeholder="E-Mail" required>
	<br>
	<label>Tutor:</label><br>
	<input type="text" name="tutorReg" placeholder="Tutor" required>
	<br>
	<center><input type="submit" name="GuardarAlumno" value="Guardar"></center>
</form>
<script type="text/javascript">
function archivo(evt) 
{
  var files = evt.target.files; // FileList object
  //Obtenemos la imagen del campo "file". 
  for (var i = 0, f; f = files[i]; i++) {         
    //Solo admitimos imágenes.
    if (!f.type.match('image.*')) {
      alert('Formato de imagen no valido.');
      break;
    }else{
      var reader = new FileReader();
         
      reader.onload = (function(theFile) {
        return function(e) {
          // Creamos la imagen.
          document.getElementById("foto").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
}
document.getElementById('imagenReg').addEventListener('change', archivo, false);
</script>
<?php 
	$registro = new MvcController();

	//se invoca la función nuevoGrupoController de la clase MvcController:
	$registro -> nuevoAlumnoController();

	if(isset($_GET["action"])){
	  if($_GET["action"] == "Ok"){
	    echo "<center><font size='6' color='green'>Registro Exitoso</font></center>";
	  }
	}

?>