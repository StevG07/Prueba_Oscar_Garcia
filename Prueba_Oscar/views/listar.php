<?php 
	include 'menu.php';
?>


	<div class="container">
		<h3>Listado</h3>
		<form action="../controllers/DefaultController.php" method="POST">
			<input type="text" name="buscador" placeholder="Ingrese nombre">
			<button class="waves-effect waves-light btn" type="submit" name="consultar">Consultar</button>
		</form>
		<?php if (isset($result)) { ?>
		<table border="1">
			<tr>
				<td><b>Id</b></td>
				<td><b>nombre_producto</b></td>
				<td><b>referencia</b></td>
				<td><b>precio</b></td>
				<td><b>peso</b></td>
				<td><b>categoria</b></td>
				<td><b>stock</b></td>
				<td><b>fecha_creacion</b></td>
			</tr>
			<?php foreach ($result as $key => $value): ?>
			<tr>
				<td><?= $value->id ?></td>
				<td><?= $value->nombre_producto ?></td>
				<td><?= $value->referencia ?></td>
				<td><?= $value->precio ?></td>
				<td><?= $value->peso ?></td>
				<td><?= $value->categoria ?></td>
				<td><?= $value->stock ?></td>
				<td><?= $value->fecha_creacion ?></td>
				<td><a class="btn-floating btn-large waves-effect waves-light btn #03a9f4 light-blue" 
					href="../controllers/DefaultController.php?id=<?= $value->id ?>&nombre=<?= $value->nombre_producto ?>&stock=<?= $value->stock ?>&venta=true">Venta</a>
					<button id="eliminar" type="button" class="waves-effect waves-light btn red" 
						onclick="eliminar(<?= $value->id ;?>)">Eliminar</button>	
					<a class="waves-effect waves-light btn" 
					href="../controllers/DefaultController.php?id=<?= $value->id ?>&editar=true">Editar</a>
				</td>
			</tr>
		<?php endforeach; }?>
		</table>
	</div>
</body>
</html>