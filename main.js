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