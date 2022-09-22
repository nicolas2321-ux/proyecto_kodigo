<?php



$usuario = $_POST['usuario'];
$password = $_POST['password'];

$tasks = [];

$dominio = "localhost";
$nombre = "root";
$password_bd = "palodecoco2321";
$bd = "proyecto_kodigo";

$conexion = new mysqli($dominio, $nombre, $password_bd, $bd);


$sql = "SELECT * FROM `users` WHERE `username` LIKE 'nick2321' AND `password` LIKE 'palodecoco2321'";
$resultado = $conexion->query($sql);
if ($resultado->num_rows > 0) {
    $task = "SELECT * FROM `tasks` WHERE `id_user` = 1";
    $call_result_task = $conexion->query($task);
    while ($row = $call_result_task->fetch_assoc()) {
        $tasks[] = $row['content'];
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="boton.css">
        <script src="https://kit.fontawesome.com/061b60d2ca.js" crossorigin="anonymous"></script>
        <title>Document</title>
    </head>

    <body>

        <div class="maincontent">
            <div class>
                <form action="home.php" method="post" class="form">
                    <input type="text" class="field" name="taskform" placeholder="Agrega tu tarea">
                    <input type="submit" class="btn-little" value="add">

                </form>
            </div>
            <div class="content">
                <?php
                $long_task = count($tasks);
                for ($i = 0; $i < $long_task; $i++) {
                    echo "<p>" . $tasks[$i] . "</p>";
                }

                if (isset($_POST['taskform'])) {
                    $new_task = $_POST['taskform'];
                    $task_call_bd = "INSERT INTO `tasks` (`id`, `id_user`, `content`) VALUES (NULL, '1', '{$new_task}')";
                    if($conexion->query($task_call_bd) === true){
                       echo "<p>".$new_task."</p>";
                    }
                
                } else {
                    echo "AAAAAAAAAAA1111";
                }

                ?>
            </div>


        </div>
    </body>
    <script>
        function clickMe() {
            location.reload();
        }
    </script>

    </html>




<?php } else {
    echo "no";
}





?>