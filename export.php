<?php
//Include database configuration file
include_once("db_connect.php");

//Get records from database
$query = $conn->query("select b.id, b.ben_id, b.ben_nombre, b.ben_apellidop, b.ben_apellidom, b.ben_cod_entidad, b.ben_cod_tramo, b.ben_estado, b.ben_fecha, c.causales
from beneficiarios b
join causales c on b.ben_id=c.beneficiario_id
order by b.id");

if($query->num_rows > 0){
    $delimiter = "|";
    $filename = "respuesta_desafio_bb.csv";
    
    //Create a file pointer
    $f = fopen('php://memory', 'w');
    
    //Set column headers
    $fields = array('"id"|"nombre"|"apellido_paterno"|"apellido_materno"|"cod_entidad"|"cod_tramo"|"estado"|"fecha"|"causales"');
    fputcsv($f, $fields, $delimiter);
    
    //Output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['id'], $row['ben_id'], $row['ben_nombre'], $row['ben_apellidop'], $row['ben_apellidom'], $row['ben_cod_entidad'], $row['ben_cod_tramo'], $row['ben_estado'], $row['ben_fecha'], $row['causales'] );
        fputcsv($f, $lineData, $delimiter);
    }
    
    //Move back to beginning of file
    fseek($f, 0);
    
    //Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //Output all remaining data on a file pointer
    fpassthru($f);
}
exit;
//Return to index.php
include('index.php');
?>