<?php 

if(isset($_GET["idBorrar"])){
	$idBorrar = $_GET["idBorrar"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new MvcController();
	$eliminar -> deleteAlumnoController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idBorrar" id="idBorrar" value="<?php echo $idBorrar; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idBorrar').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar el alumno?");

	if (resp && confirmed!="true") {
			alert("Eliminado correctamente.");
			var timer = 2;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=Eliminar&idBorrar="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=Alumnos";
	}

</script>
<?php 



?>