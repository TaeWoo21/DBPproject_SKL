<?php
	/*testuser1을 세션으로 유지되는 Id값으로 바꿔야함*/
	require("connect_today.php");
	
	$index = $_GET['index'];
	$query_comDelete = "delete from comment where com_index = ".$index."";
	$result_comDelete = mysql_query($query_comDelete);
	
	echo "<script>alert('댓글이 삭제되었습니다.')</script>";

	@mysql_close();
	$url = "http://localhost:81/first(check).php?id=testuser1'";
	echo "<meta http-equiv='Refresh' content='0; URL=$url>"; 
?>