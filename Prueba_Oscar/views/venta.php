<?php 
	include 'menu.php';
?>

<div class="container">
		<h3 align="center">Venta</h3>
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
				<input id="id" type="number" name="id" value="<?= $result->id ?>">
			</div>
			<div>
				<label>Nombre de producto</label>
				<input id="nombre" type="text" name="nombre" value="<?= $result->nombre_producto ?>" readonly>
			</div>
			<div>
				<label>Stock</label>		
				<input id="stock" type="number" name="stock" value="<?= $result->stock ?>"
				readonly>
			</div>
			<div>
				<label>Cantidad</label>		
				<input id="cantidad" type="number" name="cantidad">
			</div>
			<br>
			<button class="waves-effect waves-light btn" type="submit" name="vender">Vender</button>
		</form>
		<hr>
	</div>
</body>
</html>