<?php
	require("connect_today.php");
	$index = $_GET['index'];
	$query_cheer = "select sp.sup_index from schedule as s, support as sp where sp.sch_index = ".$index." and sp.id ='testuser1' and sp.flag = 'true'";
	$result_cheer = mysql_query($query_cheer);
	if(!mysql_num_rows($result_cheer)) {
		$query_cheer_add = "insert into support(sch_index, id, flag) values(".$index.", 'testuser1', 'true')";
		$result_cheer_add = mysql_query($query_cheer_add);
		$query_cheer_up = "update schedule set cheer_up = cheer_up + 1 where sch_index = ".$index."";
		$result_cheer_up = mysql_query($query_cheer_up);
	}
					
	else {
		$query_cheer_delete = "delete from support where sch_index = ".$index." and id= 'testuser1'";
		$result_cheer_delete = mysql_query($query_cheer_delete);
		$query_cheer_down = "update schedule set cheer_up = cheer_up - 1 where sch_index = ".$index."";
		$result_cheer_down = mysql_query($query_cheer_down);
	}
	
	@mysql_close();
	$url = "http://localhost:81/first(check).php?id=testuser1'";
	echo "<meta http-equiv='Refresh' content='0; URL=$url>"; 
?>