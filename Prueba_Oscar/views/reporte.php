<?php 
	include 'menu.php';
?>

<?php if (isset($producto_mas_vendido->total_vendidos)) { ?>
	<h1 align="center"  class="card-panel teal lighten-2">Producto mas vendido</h1>
	<table class="highlight centered" style="width: 50%" align="center" >
		<tr>
			<td><b>Nombre producto</b></td>
			<td><b>Total Productos vendidos</b></td>
		</tr>
		<tr>
			<td><?= $producto_mas_vendido->nombre_producto ?></td>
			<td><?= $producto_mas_vendido->total_vendidos ?></td>
		</tr>
	</table>	
<?php } ?>

<br><br><br>

<?php if (isset($producto_mas_stock->stock)) { ?>
	<h1 align="center"  class="card-panel teal lighten-2">Producto con mas cantidad en Stock</h1>
	<table class="highlight centered" style="width: 50%" align="center" >
		<tr>
			<td><b>Nombre producto</b></td>
			<td><b>Cantidad en Stock</b></td>
		</tr>
		<tr>
			<td><?= $producto_mas_stock->nombre_producto ?></td>
			<td><?= $producto_mas_stock->stock ?></td>
		</tr>
	</table>		
<?php } ?>