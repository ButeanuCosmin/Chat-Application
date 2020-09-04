<?php

//update_last_activity.php

include('conexiune.php');

session_start();

$query = "
UPDATE detalii 
SET activitate = now() 
WHERE id_detalii = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>

