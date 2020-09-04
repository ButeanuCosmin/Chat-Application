<?php

//fetch_user_chat_history.php

include('conexiune.php');

session_start();

echo fetch_user_chat_history($_SESSION['id_utilizator'], $_POST['to_user_id'], $connect);

?>