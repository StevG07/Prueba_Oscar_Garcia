<?php
	class DefaultModel
	{		
	    public $conectar;
	    public $id;
	    public $nombre_producto;
	    public $referencia;
	    public $precio;
	    public $peso;
	    public $categoria;
	    public $stock;
	    public $fecha_creacion;
	    public $cantidad;

			
	    public function __construct() {
	        require_once '../config/db.php';
	        $this->conectar = $pdo;
	    }
	     	     

 		/* 
			Función para guardar
 		*/
	    public function save($usuario) {

	    	$query = "INSERT INTO productos(nombre_producto, referencia, precio, peso, categoria, stock, fecha_creacion)
	    		VALUES ('$usuario->nombre_producto', '$usuario->referencia', $usuario->precio,
	    		$usuario->peso, '$usuario->categoria', $usuario->stock, '$usuario->fecha_creacion')";
			$result = $this->conectar->query($query);
			if ($result) {
				echo "Se guardo exitosamente";
			} else {
				echo '<br>Error';
			}
	    }

	    
	    /* 
			Función para Buscar
 		*/
	    public function search($valor){
	    	
	    	if($valor){
	    		$query = "SELECT * FROM productos WHERE lower(nombre_producto) like lower('%$valor%')";
	    	}else{
	    		$query = 'SELECT * FROM productos ORDER BY id Asc';
	    	}
	    	
			$consulta= $this->conectar->query($query);

			$result = [];

	        while ($row = $consulta->fetch()) {
	            $result[] = (object) $row;
	        }

			return $result;
	    }



	    /* 
			Función para Borrar
 		*/
	    public function deleteById($id){
	    	$query = "DELETE FROM productos WHERE id = $id";
	        $consulta = $this->conectar->query($query);
	        if ($consulta) {
	        	echo "Eliminado exitosamente";
	        } else {
	        	echo "<br>Error al eliminar";
	        }
	 	}


	 	/* 
			Función para Actualizar
 		*/
	 	public function update($usuarioM) {
	 		$query = "SELECT * FROM productos WHERE id = $usuarioM->id";
	 		$consulta= $this->conectar->query($query);

	    	if ($consulta) {
	    		$query2 = "UPDATE productos SET nombre_producto = '$usuarioM->nombre_producto', referencia = '$usuarioM->referencia', precio = $usuarioM->precio, peso = $usuarioM->peso, categoria = '$usuarioM->categoria', 
	    			stock = $usuarioM->stock, fecha_creacion = '$usuarioM->fecha_creacion' 
	    			WHERE id = $usuarioM->id";
	    	 	$stmt = $this->conectar->query($query2);
	    	 	if ($stmt) {
	    	 		echo "Actualizado exitoso";
	    	 	} else {
	    	 		echo '<br>Error';
	    	 	}
	    	}
	    }


	    /* 
			Función para buscar por id
 		*/
		public function searchID($id){	    	
	  
	    	$query = "SELECT * FROM productos WHERE id=$id";

			$consulta= $this->conectar->query($query);

			$resultSet = [];

	        if ($row = $consulta->fetch()) {
	            $resultSet = $row;
	        }

        	return (object) $resultSet;
	    }


	    /* 
			Función para realizar venta y restar en el sotck la cantidad y registrar la venta en la tabla ventas
 		*/
		public function venta($venta){	

	    	$query = "UPDATE productos SET stock = stock - $venta->cantidad WHERE id=$venta->id";
			$consulta= $this->conectar->query($query);

			if ($consulta) {
	    	 	$query2 = "INSERT INTO ventas(id_producto, nombre_producto, cantidad_vendida) VALUES ($venta->id, '$venta->nombre_producto', $venta->cantidad)";
	    	 	$result = $this->conectar->query($query2);
				if ($result) {
					echo "Se guardo exitosamente";
				} else {
					echo '<br>Error';
				}
    	 	} else {
    	 		echo '<br>Error';
    	 	}
	    }


	    /* 
			Función para mostrar el producto mas vendido
 		*/
		public function reporteMasVendido(){	    	
	  
	    	$query = "SELECT nombre_producto, sum(cantidad_vendida) as total_vendidos from ventas GROUP by id_producto ORDER by total_vendidos DESC LIMIT 1";
			$consulta= $this->conectar->query($query);

			$result = [];

	        if ($row = $consulta->fetch()) {
	            $result = $row;
	        }

        	return (object) $result;
	    }


	    /* 
			Función para mostrar el producto con mas stock
 		*/
		public function reporteMasStock(){	    	
	  
	    	$query = "SELECT * from productos ORDER by stock DESC LIMIT 1";
			$consulta= $this->conectar->query($query);

			$result = [];

	        if ($row = $consulta->fetch()) {
	            $result = $row;
	        }

        	return (object) $result;
	    }
	         	    
	}

?>
