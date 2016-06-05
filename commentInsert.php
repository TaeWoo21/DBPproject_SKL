<?php
	/*testuser1을 세션으로 유지되는 Id값으로 바꿔야함*/
	require("connect_today.php");
	
	$index = $_GET['for_index'];
	if($comment = $_GET['comment']){
		$query_insert = "insert into comment (sch_index, id, content) values (".$index.", 'testuser1', '".$comment."')";
		$result_insert = mysql_query($query_insert);
	}
	else {
   		@mysql_close();
   		echo "<script> alert('댓글을 입력해주세요.');</script>";
	}
	
	@mysql_close();
	$url = "http://localhost:81/first(check).php?id=testuser1'";
	echo "<meta http-equiv='Refresh' content='0; URL=$url>"; 
?>