<?php 

function connection_BD(){
$dominio = "localhost";
$nombre = "root";
$password_bd = "palodecoco2321";
$bd = "proyecto_kodigo";

$conexion = new mysqli($dominio, $nombre, $password_bd, $bd);

return $conexion;
}



function getUsers (){
    $users = "SELECT * FROM `users` WHERE `username` LIKE 'nick2321' AND `password` LIKE 'palodecoco2321'";
    return $users;

}

function getTasks(){
    $task = "SELECT * FROM `tasks` WHERE `id_user` = 1";
    return $task;
}

function newTask($new_task){
    $Newtask = "INSERT INTO `tasks` (`id`, `id_user`, `content`) VALUES (NULL, '1', '{$new_task}')";
    return $Newtask;
}

function eraseTask($erase){
    $eraseTask= "DELETE FROM tasks WHERE `tasks`.`id` = {$erase}";
    return $eraseTask;
}

function editTask($edit_id, $edit_confirm){
    $editTask = "UPDATE `tasks` SET `content` = '{$edit_confirm}' WHERE `tasks`.`id` = {$edit_id}";
    return $editTask;
}