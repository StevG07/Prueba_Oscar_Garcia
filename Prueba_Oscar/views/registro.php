<?php 
	include 'menu.php';
?>

<div class="container">
		<h3 align="center">Registro</h3>
		<?php if (isset($msn)): ?>
			<div id="alerta" class="row">
			    <div class="col s6 m12">
			      <div class="card  red darken-1">
			        <div class="card-content white-text">
			          <span class="card-title">Alerta!!</span>
			          <p><?php echo $msn; ?></p>
			        </div>
			      </div>
			    </div>
			</div>
		<?php endif; ?>

		<form id="form" action="../controllers/DefaultController.php" method="POST">
			<div hidden=True>
				<input id="id" type="number" name="id" value="<?= isset($result->id) ? $result->id : null ?>">
			</div>
			<div>
				<label>Nombre de producto</label>
				<input id="nombre" type="text" name="nombre" value="<?= isset($result->nombre_producto) ? $result->nombre_producto : null ?>">
			</div>
			<div>
				<label>Referencia</label>
				<input id="referencia" type="text" name="referencia" value="<?= isset($result->referencia) ? $result->referencia : null ?>">
			</div>
			<div>
				<label>Precio</label>		
				<input id="precio" type="number" name="precio" value="<?= isset($result->precio) ? $result->precio : null ?>">
			</div>
			<div>
				<label>Peso</label>		
				<input id="peso" type="number" name="peso" value="<?= isset($result->peso) ? $result->peso : null ?>">
			</div>
			<div>
				<label>Categoría</label>
				<input id="categoria" type="text" name="categoria" value="<?= isset($result->categoria) ? $result->categoria : null ?>">
			</div>
			<div>
				<label>Stock</label>		
				<input id="stock" type="number" name="stock" value="<?= isset($result->stock) ? $result->stock : null ?>">
			</div>
			<div>
				<label>Fecha de creación</label>		
				<input id="fecha" type="date" name="fecha" value="<?= isset($result->fecha_creacion) ? $result->fecha_creacion : null ?>">
			</div> 
			<br>
			<button class="waves-effect waves-light btn" type="submit" name="guardar">Guardar</button>
			<button class="waves-effect waves-light btn blue-grey" onclick="limpiarCampos()" 
				type="button" name="limpiar">Limpiar</button>
		</form>
		<hr>
	</div>
</body>
</html>