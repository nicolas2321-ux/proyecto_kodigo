<?php
include 'conexion.php';



$usuario = $_POST['usuario'];
$password = $_POST['password'];

$tasks = [];
$ids = [];

$conexion = connection_BD(); //conexion a la BD

$users = getUsers(); //sacar el usuario relacionado 
$resultado = $conexion->query($users); //query
if ($resultado->num_rows > 0) { //comprobar si la query tiene una respuesta
    $task = getTasks(); //pedir a la BD las tareas relacionadas con el usuario
    $call_result_task = $conexion->query($task); //query
    while ($row = $call_result_task->fetch_assoc()) { //while para recorrer toda la tabla
        $tasks[] = $row['content']; //guardar las tareas

        $ids[] = $row['id']; //guardar el id de las tareas
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
                    <!-- formulario para agregar una tarea -->

                </form>
            </div>
            <div class="content">
                <?php
                $long_task = count($tasks);

                for ($i = 0; $i < $long_task; $i++) {
                ?>


                    <div class='taskdiv'>
                    <p><?php echo $ids[$i] ?>-
                                <?php echo $tasks[$i];  //for para recorrer las tareas  ?>    </p>

                        <form id='formulario <?php echo $ids[$i]?>' class='form-' action='home.php' method='POST'>
                        

                            <i class='fa-solid fa-trash delete' id='<?php echo $ids[$i] ?>' onclick='eliminarTask(this)' name='completar'></i>
                            <input type="hidden" value="<?php echo $ids[$i]?>" name="eliminar">

                            <!-- formualario para eliminar una tarea -->
                        </form>


                        <form id='edit <?php echo $ids[$i]?>' class='form-' action='home.php' method='POST'>
                            <i class="fa-solid fa-pen-to-square edit" id='<?php echo $ids[$i] ?>' onclick='editTask(this)' name='completar'></i>
                            <input type="hidden" value="<?php echo $ids[$i]?>" name="editar">

                            <!-- formulario para editar una tarea -->
                            
                        </form>
                    </div>
                    

                <?php
                }


                if (isset($_POST['taskform'])) { //si al recibir el metodo post taskform esta definido
                    $new_task = $_POST['taskform']; //sacar el valor del input
                    $task_call_bd = newTask($new_task); //llamada a la BD
                    if ($conexion->query($task_call_bd) === true && $new_task != "") { //query
                        
                            ?>
            
            
                                <div class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea agregada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button> 
                                <!-- notificacion -->
                                </div>
                                
            
                            <?php
                            
                    }
                } else if (isset($_POST['eliminar'])) { //si eliminar esta definido
                    $erase = $_POST['eliminar']; //sacar el valor de eliminar (id)
                    $erase_call = eraseTask($erase); //llamada a la BD
                    if($conexion->query($erase_call)===true){?>
                        <div  class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea eliminada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button>
                                <!-- notificacion -->
                                </div>
                    <?php
                            }
                } 
                else if(isset($_POST['editar'])){ //si editar esta definido
                    $editar = $_POST['editar']; //sacar el valor de editar (id)
                    ?>
                    <div  class ="alert alert-primary" role="alert">
                    <form action="home.php" id="confirm_edit <?php echo $ids[$i]?>" method="POST">
                    <input type="text" placeholder="Edite su tarea" name="confirm" class="field">
                    <input type="hidden" name="id" value="<?php echo $editar; ?>">
                    <input type="submit"  class="btn btn-info" id="btn">

                    <!-- nuevo formulario donde ingresara el nuevo valor -->
                    </form>
                    </div>
                    <?php
                    
                }
                else if(isset($_POST['confirm'])){ //confirmacion de editar tarea
                   $edit_confirm = $_POST['confirm']; //sacar el valor del input donde ingresa la tarea
                   $edit_id = $_POST['id']; //sacar el valor del id
                   $edit_call = editTask($edit_id, $edit_confirm); //llamada a la base de datos
                   if($conexion-> query($edit_call) === true){
                    ?>
                     <div  class ="alert alert-primary" role="alert">
                                <p class="alertP">Tarea editada correctamente</p>
                                <button onclick="accept()" class="btn btn-info"> Aceptar</button>
                                </div>
                                <!-- notificacion -->
                    <?php
                   }
                }

                ?>
            
            </div>


        </div>
    </body>
            <script src="main.js"> </script>

    </html>




<?php } else {
    echo "no";
}





?>