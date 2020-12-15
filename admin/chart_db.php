<?php

header('Content-Type: application/json');

require_once '../connect.php';

$sqlQuery = "SELECT tbl_type.t_name as name , count(tbl_product.t_id) as number 
             FROM tbl_type
             INNER JOIN tbl_product  
             ON tbl_type.t_id = tbl_product.t_id
             GROUP BY tbl_product.t_id ORDER BY p_name ASC";


$result =  mysqli_query($conn, $sqlQuery);

$data = array();

foreach ($result as $key => $row) {
    $data[] = $row;
}
mysqli_close($conn);

echo json_encode($data);
