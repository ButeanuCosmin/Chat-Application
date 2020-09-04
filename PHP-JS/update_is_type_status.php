<?php

//update_is_type_status.php

include('conexiune.php.php');

session_start();

$query = "
UPDATE detalii 
SET scrie = '".$_POST["is_type"]."' 
WHERE id_detalii = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>