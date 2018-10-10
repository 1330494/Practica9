<?php 
//Crearemos un controlador que muestre la plantilla y la navegacion
$mvc = new MvcController();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Practica 09 </title>
	<style type="text/css"> 
		body {
	    	font-family: "Tahoma";	    	
		}
		
		img{
			width: 150px;
			height: 170px;
			border-radius: 15px;
		}

		h1 {
	    	color: #FFF;
	    	font-family: "Arial";
		}

		label{
			color: #0E1C37;
	    	font-size: 18px;
		}

		header{
			position: relative;
			margin: auto;
			text-align: center;
			padding: 15px;

		}

		nav{
			position: relative;
			margin: auto;
			width: 100%;
			height: auto;
			background: #17343C;
		}

		nav ul{
			position: relative;
			margin:	auto;
			width:	50%;
			text-align: center;
		}
		
		nav ul li{
			display: inline-block;
			width: 18%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color: #3880A2;
			text-decoration: none;
			font-size: 20px;
		}

		nav ul li a:hover{
			color: #C7EDFF;
			font-size: 21px;
		}

		section{
			width: 60%;
			margin-right: auto;
			margin-left: auto;
		}

		section h1{
			position: relative;
			margin: auto;
			padding: 10px;
			text-align: center;
		}

		#font{
			position: relative;
			color: #245ABE;
			margin: auto;
			padding: 10px;
			text-align: center;
		}

		section form{
			position: relative;
			margin:auto;
			width: 400px;
		}

		section form input{
			display: inline-block;
			padding: 10px;
			width: 195px;
			margin: 5px;
		}

		section form input[type='submit']{
			position: relative;
			margin: 20px auto;			
			font-size: 17px;
			width: 95px;
			left: 4.5%;
		}

		section form input[type='file']{
			position: relative;
			margin: 20px auto;			
			font-size: 17px;
			width: 95px;
		}

		section table a:hover{
			font-size: 17px;
			color: #1B731E;
			width: 700px;
		}

		section table a:visited{
			font-size: 15px;
			color: #5C9399;
		}

		section table a{
			font-size: 16px;
			color: #1B4E1B;
		}

		section table {
			width: 700px;
		}

		#delete:hover{
			color: red;
		}

		#delete{
			color: #FF6060;
		}		

		table{
			position: relative;
			margin: auto;
			width: 60%;
			left: -10%;
		}

		table thead tr{
			background-color: #061132;
			margin: 20px auto;
		}

		table thead tr th{
			color: #B5C8FF;
			border-radius: 5px;
			height: 30px;
			width: auto;
		}		

		table tbody tr td{
			border: 1px solid black;
			text-align: center;
			align-content: center;
			color: white;
			background-color: black;
			border-radius: 5px;
			font-size: 16px;
		}

		#par{
			color: black;
			background-color: white;
		}

		#inpar{
			background-color: white;
			color: black;
			border-radius: 10px;
		}

		#inpar2{
			background-color: black;
			color: white;
			border-radius: 10px;
		}

		.thumb{
		    height: 75px;
		    width: 90px;
		    max-height: 75px;
		    max-width: 90px;
		    border: 1px solid black;
		    margin: 10px 5px 0 0;
		    border-radius: 20px;
		}

		.icon{
		    height: 35px;
		    width: 40px;
		    max-height: 75px;
		    max-width: 90px;
		    border: 1px solid black;
		    margin: 10px 5px 0 0;
		    border-radius: 20px;
		}
	</style>

	</head>
	<body bgcolor="grey">
	<header><h1>Sistema de alumnos</h1></header>
	<br>
	<!-- Mostramos la navegacion -->
	<?php $mvc -> NavController(); //include 'modules/navegacion.php'; ?>
	<section>
	<?php				
		//Mostramos la funcion
		$mvc -> enlacesPaginasController();
	?>

	</section>
	</body>
</html>