<?php

//sterge_chat.php

include('conexiune.php');

if(isset($_POST["chat_message_id"]))
{
    $query = "
	UPDATE mesaje 
	SET status = '2' 
	WHERE id_mesaje = '".$_POST["chat_message_id"]."'
	";

    $statement = $connect->prepare($query);

    $statement->execute();
}

?>