
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php 
include_once("db_connect.php");
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
        <br>
            <div class="row">
                <form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
                    <div class="col-md-3 panel-heading">
                        <input type="file" name="file" />
                    </div>
                    <div class="col-md-3 panel-heading">
                        <input type="submit" class="btn btn-primary" name="import_data" value="Importar a la Base de datos">
                    </div>
                    <div class="col-md-3 panel-heading">
                        <a href="export.php" class="btn btn-success pull-right">Exportar a csv</a>
                    </div>
                </form>
            </div>
            <br>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                    <th>Id</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Código de entidad</th>
                    <th>Código de tramo</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Causales</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "select b.id, b.ben_id, b.ben_nombre, b.ben_apellidop, b.ben_apellidom, b.ben_cod_entidad, b.ben_cod_tramo, b.ben_estado, b.ben_fecha, c.causales
                    from beneficiarios b
                    join causales c on b.ben_id=c.beneficiario_id
                    order by b.id";
                    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                    if(mysqli_num_rows($resultset)) {
                        while( $rows = mysqli_fetch_assoc($resultset) ) {
                        ?>
                        <tr>
                        <td><?php echo $rows['id']; ?></td>
                        <td><?php echo $rows['ben_id']; ?></td>
                        <td><?php echo $rows['ben_nombre']; ?></td>
                        <td><?php echo $rows['ben_apellidop']; ?></td>
                        <td><?php echo $rows['ben_apellidom']; ?></td>
                        <td><?php echo $rows['ben_cod_entidad']; ?></td>
                        <td><?php echo $rows['ben_cod_tramo']; ?></td>
                        <td><?php echo $rows['ben_estado']; ?></td>
                        <td><?php echo $rows['ben_fecha']; ?></td>
                        <td><?php echo $rows['causales']; ?></td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="5">No hay registros para mostrar.....</td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>