<?php
	require_once "../models/DefaultModel.php";

	# Se intancia la clase DefaultController
	$usuarioC = new DefaultController;


	# Se realiza validacion si existe guardar.
	if( isset($_POST['guardar']) ){	

		# Se realiza la validacion de los campos.
		if (validarCampos()) {

			#cuando se realiza la validacion y todo esta bien se va al metodo de guardar.
			$usuarioC->guardar();
		} else {

			# Si la validacion de los campos es false envia un mensaje a la vista
			$msn = '¡Se deben diligenciar todos los campos!';
			require_once("../views/registro.php");
		}
	}


	/*Se realiza validacion por get y post, ya que se ingresa al menu por GET 
		y por post es cuando se consulta el nombre del producto desde la vista listar 
	*/
	if( isset($_POST['consultar']) or isset($_GET['consultar'])){
		$usuarioC->consultar();
	}


	# Se hace la validacion que exista id y delete para llamar el metodo de eliminar
	if ( isset($_GET['id']) && isset($_GET['delete'])) {
		$usuarioC->eliminar();
	}


	# Se hace la validacion que exista id y editar para llamar el motodo de editar
	if ( isset($_GET['id']) && isset($_GET['editar'])) {
		$usuarioC->consultarID();
	}


	# Se cargan los datos del producto para realizar la venta
	if(isset($_GET['id']) && isset($_GET['venta'])){
		$usuarioC->consultarProductoVenta($_GET['id']);
	}


	# Se hace la validacion que exista id y vender para realizar la venta
	if ( isset($_POST['id']) && isset($_POST['vender'])) {

		# Se realiza la validacion que si haya los suficientes productos en stock para la venta
		if($_POST['stock'] < $_POST['cantidad']){
			$menor_stock = True;
			$usuarioC->consultarProductoVenta($_POST['id'], $menor_stock);			
		}else{
			$usuarioC->vender();
		}
	}


	# Se verifica que exista reporte para consultar los reportes
	if (isset($_GET['reporte'])) {
		$usuarioC->reporte();
	}


	# Se realiza validacion de los campos antes de guardarlos
	function validarCampos(){
		if (isset($_POST['nombre']) && $_POST['nombre'] !== "" && 
			isset($_POST['referencia']) && $_POST['referencia'] !== "" && 
			isset($_POST['precio']) && $_POST['precio'] !== "" && 
			isset($_POST['peso']) && $_POST['peso'] !== "" && 
			isset($_POST['categoria']) && $_POST['categoria'] !== "" && 
			isset($_POST['stock']) && $_POST['stock'] !== "" ) 
		{
			return True;
		}else{
			return False;
		} 
		
	}



	class DefaultController
	{
		function __construct(){}

		# Se crea la funcion de guardar y se hace una instancia de modelo para guardar
		public function guardar(){
			$usuarioM = new DefaultModel();	
	        $usuarioM->nombre_producto = $_POST['nombre'];
	        $usuarioM->referencia = $_POST['referencia'];
	        $usuarioM->precio = $_POST['precio'];
	        $usuarioM->peso = $_POST['peso'];
	        $usuarioM->categoria = $_POST['categoria'];
	        $usuarioM->stock = $_POST['stock'];
	        $usuarioM->fecha_creacion = $_POST['fecha'];

	        /* Se realiza esta validacion ya que se esta usando la misma vista para el guardar y modificar y asi ahorrar codigo, si existe id es una actualizacion, si no existe 
	        es un producto nuevo  */
	        if($_POST['id'] !== ''){
	        	$usuarioM->id = $_POST['id'];
	        	$usuarioM->update($usuarioM);
	        }else{
	        	$usuarioM->save($usuarioM);
	        }	
	      	         

	        /* Se llama al metodo search para cargar todos los productos en la vista listar
	        	ya que si lo mando a la vista sin hacer la consulta no se van a mostrar los productos */
	        $result = $usuarioM->search(Null);
	        require_once("../views/listar.php");
	    }


	    # metodo para cultar los productos de la base de datos
	    public function consultar(){
	        $usuario = new DefaultModel();

	        /* Se realzia la validacion si se necesita listar todos los productos y si estan 
	        	buscando uno en especifico */
	        if (isset($_POST['buscador']) && $_POST['buscador'] !== "") {
	        	$buscar = $_POST['buscador'];
	        } else {
	        	$buscar = Null;	
	        }

	        /* Se llama al metodo search del modelo opara consultar y se pasa el parametro con los datos */
	        $result = $usuario->search($buscar);

	        require_once("../views/listar.php");
	    }


	    # Se crea metodo para eliminar
	    public function eliminar(){
	    	$usuarioM = new DefaultModel();

	    	$usuarioM->id = $_GET['id'];
	        $usuarioM->deleteById($usuarioM->id);
	       	
	       	/* Se llama al metodo search para cargar todos los productos en la vista listar
	        	ya que si lo mando a la vista sin hacer la consulta no se van a mostrar los productos */
	        $result = $usuarioM->search(Null);
	        require_once("../views/listar.php");
	    }


	    /*la diferencia de este metodo consultarID al consultar de arriba, es que el metodo de consultar es solo para listar todos los prodcutos o hacer la busqueda por nombre producto, y con este metodo consultarID lo que hacemos es traer los datos con el id para realizar la actualizacion del producto */
	    public function consultarID(){
	    	$usuarioM = new DefaultModel();

	    	$usuarioM->id = $_GET['id'];
	        $result = $usuarioM->searchID($usuarioM->id);

	        /* Se envia a la vista de registro con los datos del producto, se envia a la misma vista del guardar ya que tenemos una sola vista de para crear y actualizar y asi ahorrar codigo. */	
	        require_once("../views/registro.php");
	    }


	    # Se crea metodo para realizar la venta de un producto
	    public function vender(){
	    	$usuarioM = new DefaultModel();

	    	$usuarioM->id = $_POST['id'];
	    	$usuarioM->nombre_producto = $_POST['nombre'];
	    	$usuarioM->cantidad = $_POST['cantidad'];
	    	
	    	# Se llama al metodo venta para realizar la venta
	        $venta = $usuarioM->venta($usuarioM);

	        /* Se llama al metodo search para cargar todos los productos en la vista listar
	        	ya que si lo mando a la vista sin hacer la consulta no se van a mostrar los productos */
	        $result = $usuarioM->search(Null);
	        require_once("../views/listar.php");

	        
	    }


	    # Se crea metodo para realizar las 2 consultas de los reportes
	    public function reporte(){
	    	$usuarioM = new DefaultModel();

	        $producto_mas_vendido = $usuarioM->reporteMasVendido();
	        $producto_mas_stock = $usuarioM->reporteMasStock();

	        require_once("../views/reporte.php");
	    }


	    # Consultar datos producto para la venta
	    public function consultarProductoVenta($id, $menor_stock=False){
	    	$usuarioM = new DefaultModel();

	    	$usuarioM->id = $id;
	        $result = $usuarioM->searchID($usuarioM->id);

	        if($menor_stock){
	        	$msn = '¡No hay la cantidad de productos en Stock!';
	        }

	        require_once("../views/venta.php");
	    }	    

	}

?>