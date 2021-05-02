<?php
include_once("db_connect.php");
    if(isset($_POST['import_data'])){
    // Validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            // Get data records from csv file
                while(($emp_record = fgetcsv($csv_file)) !== FALSE){
                    $emp_record1 = explode('|', $emp_record[0]);
                    $nombre_exp = explode(' - ', $emp_record1[1]);
                    $causales_exp = explode(',', $emp_record1[6]);
                    if(isset($emp_record[1])){
                        $causales_exp[1] = $emp_record[1];
                    }
                   
                    // Will not insert the first row with the column data
                    if($emp_record1[0] != "id"){
                        // Insert data beneficiarios
                        $mysql_insert = "INSERT INTO beneficiarios (ben_id, ben_nombre, ben_apellidop, ben_apellidom, ben_cod_entidad, ben_cod_tramo, ben_estado, ben_fecha)VALUES('".$emp_record1[0]."', '".$nombre_exp[0]."', '".$nombre_exp[1]."', '".$nombre_exp[2]."', '".$emp_record1[2]."', '".$emp_record1[3]."', '".$emp_record1[4]."', '".$emp_record1[5]."')";
                        mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));

                        // Insert data causales
                        for($i = 0; $i<count($causales_exp); $i++){
                            $mysql_insert = "INSERT INTO causales (beneficiario_id, causales )VALUES('".$emp_record1[0]."', '".$causales_exp[$i]."')";
                            mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                        }
                        
                    }
                    
                }
            
            // Data success or data error
            fclose($csv_file);
            $import_status = '?import_status=success';
            } else {
                $import_status = '?import_status=error';
            }
        } else {
            $import_status = '?import_status=invalid_file';
        }
    }
header("Location: index.php".$import_status);
?>