<?php



$usuario = $_POST['usuario'];
$password = $_POST['password'];

$tasks = [];
$ids = [];

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

        $ids[] = $row['id'];
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="style_home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/061b60d2ca.js" crossorigin="anonymous"></script>
        <title>Document</title>
    </head>

    <body>

        <div class="main">
            <h1>TODO PHP</h1>
            <div class = "search_box">
                <form action="home.php" method="post" class="form">
                    <input type="text" class="field" name="taskform" placeholder="Agrega tu tarea" required>
                    <input type="submit" class="btn btn-success" value="add">

                </form>
            </div>
            <div class="content">
                <?php
                $long_task = count($tasks);

                for ($i = 0; $i < $long_task; $i++) {
                ?>


                    <div class='taskdiv'>
                    <p><?php echo $ids[$i] ?>-
                                <?php echo $tasks[$i]; ?> </p>

                        <form id='formulario <?php echo $ids[$i]?>' class='form-' action='home.php' method='POST'>
                            <i class='fa-solid fa-trash delete' id='<?php echo $ids[$i] ?>' onclick='eliminarTask(this)' name='completar'></i>
                            <input type="hidden" value="<?php echo $ids[$i]?>" name="eliminar">
                        </form>


                        <form id='edit <?php echo $ids[$i]?>' class='form-' action='home.php' method='POST'>
                            <i class="fa-solid fa-pen-to-square edit" id='<?php echo $ids[$i] ?>' onclick='editTask(this)' name='completar'></i>
                            <input type="hidden" value="<?php echo $ids[$i]?>" name="editar">
                            
                        </form>
                    </div>
                    

                <?php
                }


                if (isset($_POST['taskform'])) {
                    $new_task = $_POST['taskform'];
                    $task_call_bd = "INSERT INTO `tasks` (`id`, `id_user`, `content`) VALUES (NULL, '1', '{$new_task}')";
                    if ($conexion->query($task_call_bd) === true && $new_task != "") {
                        
                            ?>
            
            
                                <div class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea agregada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button>
                                </div>
                                
            
                            <?php
                            
                    }
                } else if (isset($_POST['eliminar'])) {
                    $erase = $_POST['eliminar'];
                    $erase_call = "DELETE FROM tasks WHERE `tasks`.`id` = {$erase}";
                    if($conexion->query($erase_call)===true){?>
                        <div  class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea eliminada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button>
                                </div>
                    <?php
                            }
                } 
                else if(isset($_POST['editar'])){
                    $editar = $_POST['editar'];
                    ?>
                    <div  class ="alert alert-primary" role="alert">
                    <form action="home.php" id="confirm_edit <?php echo $ids[$i]?>" method="POST">
                    <input type="text" placeholder="Edite su tarea" name="confirm" class="field">
                    <input type="hidden" name="id" value="<?php echo $editar; ?>">
                    <input type="submit"  class="btn btn-info" id="btn">
                    </form>
                    </div>
                    <?php
                    
                }
                else if(isset($_POST['confirm'])){
                   $edit_confirm = $_POST['confirm'];
                   $edit_id = $_POST['id'];
                   $edit_call = "UPDATE `tasks` SET `content` = '{$edit_confirm}' WHERE `tasks`.`id` = {$edit_id}";
                   if($conexion-> query($edit_call) === true){
                    ?>
                     <div  class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea editada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button>
                                </div>
                    <?php
                   }
                }

                ?>
            
            </div>


        </div>
    </body>
    <script>
        function eliminarTask(e) {
            var id = "formulario " + e.id;
            var formulario = document.getElementById(id);
            formulario.submit();
            console.log(e.id)

        }
        function editTask(e) {
            var id = "edit " + e.id;
            var formulario = document.getElementById(id);
            formulario.submit();
            console.log(e.id)

        }
        function accept(){
            location.href="home.php";
        }
    </script>

    </html>




<?php } else {
    echo "no";
}





?>