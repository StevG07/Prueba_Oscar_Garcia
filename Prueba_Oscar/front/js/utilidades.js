function eliminar(id){
	var r = confirm('¿Esta seguro que desea eliminar el usuario?');
	if (r == true) {
		window.location.href = "../controllers/DefaultController.php?id="+id+"&delete=true";
	}
}

function limpiarCampos() {
	window.location.href = "../views/registro.php";
};
