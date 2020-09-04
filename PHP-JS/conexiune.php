<?php

//conexiune.php

$connect = new PDO("mysql:host=127.0.0.1;dbname=chat", "root", "");

date_default_timezone_set('Europe/Bucharest');

function fetch_user_last_activity($user_id, $connect)
{
    $query = "
	SELECT * FROM detalii 
	WHERE id_utilizator = '$user_id'  
	LIMIT 1
	";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        return $row['activitate'];
    }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
    $query = "
	SELECT * FROM mesaje 
	WHERE (initiator = '".$from_user_id."' 
	AND receptor = '".$to_user_id."') 
	OR (initiator = '".$to_user_id."' 
	AND receptor = '".$from_user_id."') 
	
	";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '<ul class="list-unstyled">';
    foreach($result as $row)
    {
        $user_name = '';
        $dynamic_background = '';
        $chat_message = '';
        if($row["initiator"] == $from_user_id)
        {
            if($row["status"] == '2')
            {
                $chat_message = '<em>This message has been removed</em>';
                $user_name = '<b class="text-success" style="color: darkblue">You</b>';
            }
            else
            {
                $chat_message = $row['mesaje'];
                $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$row['id_mesaje'].'" style="background-color: red">x</button>&nbsp;<b class="text-success" style="color: darkblue">You</b>';
            }


            $dynamic_background = 'background-color:snow;';
        }
        else
        {
            if($row["status"] == '2')
            {
                $chat_message = '<em>This message has been removed</em>';
            }
            else
            {
                $chat_message = $row["mesaje"];
            }
            $user_name = '<b class="text-danger" style="color: black">'.get_user_name($row['initiator'], $connect).'</b>';
            $dynamic_background = 'background-color: snow;';
        }
        $output .= '
		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.'
				<div align="right">
					- <small><em>'.$row['timp'].'</em></small>
				</div>
			</p>
		</li>
		';
    }
    $output .= '</ul>';
    $query = "
	UPDATE mesaje 
	SET status = '0' 
	WHERE initiator = '".$to_user_id."' 
	AND receptor = '".$from_user_id."' 
	AND status = '1'
	";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $output;
}

function get_user_name($user_id, $connect)
{
    $query = "SELECT nume FROM login WHERE id_utilizator = '$user_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        return $row['nume'];
    }
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
    $query = "
	SELECT * FROM mesaje 
	WHERE initiator = '$from_user_id' 
	AND receptor = '$to_user_id' 
	AND status = '1'
	";
    $statement = $connect->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
    $output = '';
    if($count > 0)
    {
        $output = '<span class="label label-success">'.$count.'</span>';
    }
    return $output;
}

function fetch_is_type_status($user_id, $connect)
{
    $query = "
	SELECT scrie FROM detalii 
	WHERE id_utilizator = '".$user_id."'  
	LIMIT 1
	";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        if($row["scrie"] == 'yes')
        {
            $output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
        }
    }
    return $output;
}

function fetch_group_chat_history($connect)
{
    $query = "
	SELECT * FROM mesaje 
	WHERE receptor = '0'  
	
	";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    $output = '<ul class="list-unstyled">';
    foreach($result as $row)
    {
        $user_name = '';
        $dynamic_background = '';
        $chat_message = '';
        if($row["initiator"] == $_SESSION["id_utilizator"])
        {
            if($row["status"] == '2')
            {
                $chat_message = '<em>This message has been removed</em>';
                $user_name = '<b class="text-success" style="color: darkblue">You</b>';
            }
            else
            {
                $chat_message = $row["mesaje"];
                $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat " id="'.$row['id_mesaje'].'" style="background-color: red " >x</button>&nbsp;<b class="text-success" style="color: darkblue">You</b>';
            }

            $dynamic_background = 'background-color:snow;';
        }
        else
        {
            if($row["status"] == '2')
            {
                $chat_message = '<em>This message has been removed</em>';
            }
            else
            {
                $chat_message = $row["mesaje"];
            }
            $user_name = '<b class="text-danger" style="color: black">'.get_user_name($row['initiator'], $connect).'</b>';
            $dynamic_background = 'background-color:snow;';
        }

        $output .= '

		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.' 
				<div align="right" style="color: black">
					- <small><em>'.$row['timp'].'</em></small>
				</div>
			</p>
		</li>
		';
    }
    $output .= '</ul>';
    return $output;
}


?>