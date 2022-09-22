<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario</title>
	<link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="boton.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	
</head>
<body>

	<div id="formularios">
		<form action="home.php" id="form_session" method="post">
			<p>Correo electrónico:</p>
			<div class="field-container">
				<i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>	
				<input name="usuario" type="text" class="field" placeholder="user@example.com" required> <br/>
			</div>
			<p>Contraseña:</p>
			<div class="field-container">
				<i class="fa fa-key fa-lg" aria-hidden="true"></i>	
				<input name="password" required type="password" class="field" placeholder="*******" > <br/>
			</div>
			<p class="center-content">
				<input type="submit" class="btn btn-green" value="Iniciar sesión"> <br/><br/>
				<a href="recibir_get.php?tipo_usuario=nuevo&navegador=chrome">Registra cuenta</a>
			</p>
		</form>	
</body>
</html>