<?php
// Authorization Check
// If there is no guild ID, only user availability is checked. You must pass null Instead of GDID

function CheckAuth($AID, $GDID, $AuthToken) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
	
	$conn = new PDO('mysql:host=' . $cfg_db_ip . ';dbname=' . $cfg_db_name , $cfg_db_user , $cfg_db_pass);
	if ($GDID != null) {
		$sql = "SELECT 1 FROM `guild` JOIN `char` ON `guild`.`char_id`=`char`.`char_id` JOIN `token`.`token` ON `char`.`account_id`=`token`.`account_id` WHERE `char`.`account_id`= :AID AND `guild`.`guild_id`= :GDID and `token`.`authtoken`= :AuthToken ";
		$query = $conn->prepare($sql);
		$query->bindValue(':AID', $AID);
		$query->bindValue(':GDID', $GDID);
		$query->bindValue(':AuthToken', $AuthToken);
	} else {
		$sql = "SELECT 1 FROM `char` JOIN `token`.`token` ON `char`.`account_id`=`token`.`account_id` WHERE `char`.`account_id`= :AID and `token`.`authtoken`= :AuthToken ";
		$query = $conn->prepare($sql);
		$query->bindValue(':AID', $AID);
		$query->bindValue(':AuthToken', $AuthToken);
	}
	$query->execute();

	$count = $query->rowCount();
	

	// For a test without connecting to the database, delete the comment at the line $ count = 1; And comment all higher
	// $count = 1;

	if($count == 1) {
		return true;
	} else {
		return false;
	}

}
