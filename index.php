<?php 

include_once('conexion.php');

$dbase = new DB_CONEXION();

$conn = $dbase->connect();

?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Editar Eliminar</title>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="./script.js"></script>

</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Gestionar <b>Usuarios</b></h2>
					</div>
					
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th >id</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Rol</th>
						<th>Fecha de registro</th>
						<th>Operaciones</th>
					</tr>
				</thead>
				<?php

        $usuario_query = mysqli_query($conn, "SELECT * FROM tbl_usuario");

        if (mysqli_num_rows($usuario_query) > 0) {
            while ($usuario = mysqli_fetch_assoc($usuario_query)) {

                echo "<tr>";
                echo "<td>". htmlspecialchars($usuario['idUsuario']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['nombreUsuario']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['emailUsuario']) . "</td>";


                $role_id = $usuario['idRol'];
                $role_query = mysqli_query($conn, "SELECT nombreRol FROM tbl_roles WHERE idRol = $role_id");
                $role = mysqli_fetch_assoc($role_query);
                echo "<td>" . htmlspecialchars($usuario['idRol']) . "</td>";
               

                echo "<td>" . htmlspecialchars($usuario['fechaRegistroUsuario']) . "</td>";
                echo '<td><a href="#editarUsuario" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#eliminarUsuario" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
        }
        ?>
					</tr> 
				</tbody>
			</table>
			
		</div>
	</div>        
</div>

<!-- Editar Modal HTML -->
<div id="editarUsuario" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="editar_usuario.php">
				<div class="modal-header">						
					<h4 class="modal-title">Editar usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">	
                <input class="id" name="id" value="">				
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Eliminar Modal HTML -->
<div id="eliminarUsuario" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="eliminar_usuario.php">

            <input hidden id="id" class="id" name="id" value="">	
				<div class="modal-header">						
					<h4 class="modal-title">Eliminar usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Seguro que desea eliminar el usuario elegido?</p>
					<p class="text-warning"><small>Los cambios no podran revertirse.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>