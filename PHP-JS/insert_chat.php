<?php

//insert_chat.php

include('conexiune.php');

session_start();

$data = array(
    ':receptor'		=>	$_POST['to_user_id'],
    ':initiator'		=>	$_SESSION['id_utilizator'],
    ':mesaje'		=>	$_POST['chat_message'],
    ':status'			=>	'1'
);

$query = "
INSERT INTO mesaje 
(receptor, initiator, mesaje, status) 
VALUES (:receptor, :initiator, :mesaje, :status)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
    echo fetch_user_chat_history($_SESSION['id_utilizator'], $_POST['to_user_id'], $connect);
}

?>