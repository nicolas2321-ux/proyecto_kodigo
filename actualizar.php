<?php
function newtask($task)
{
?>


    <div class='taskdiv'>
            <?php echo $task; ?> </p>
        <form id='formulario  class='form-' action='home.php' method='POST'>
            <i class='fa-solid fa-trash delete'   name='completar'></i>
            <input type="hidden" name="eliminar">
        </form>
    </div>


<?php
}

?>