<?php

//group_chat.php

include('conexiune.php');

session_start();

if($_POST["action"] == "insert_data")
{
    $data = array(
        ':initiator'		=>	$_SESSION["id_utilizator"],
        ':mesaje'		=>	$_POST['chat_message'],
        ':status'			=>	'1'
    );

    $query = "
	INSERT INTO mesaje 
	(initiator, mesaje, status) 
	VALUES (:initiator, :mesaje, :status)
	";

    $statement = $connect->prepare($query);

    if($statement->execute($data))
    {
        echo fetch_group_chat_history($connect);
    }

}

if($_POST["action"] == "fetch_data")
{
    echo fetch_group_chat_history($connect);
}

?>