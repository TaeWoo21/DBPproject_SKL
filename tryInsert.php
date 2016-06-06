<?php
	require("connect_today.php");
	session_start();
	
	$date = $_GET['date'];
	$start = $_GET['start'];
	$finish = $_GET['finish'];
	$content = $_GET['content'];
	$range = $_GET['range'];

	$query_check = "select sch_start_time, sch_finish_time, content from schedule where id = '".$_SESSION['userid']."' and sch_date = '".$date."'";
	$result_check = mysql_query($query_check);

	$bol_check = true;
	while($check_row = mysql_fetch_assoc($result_check)) {
		if($check_row['sch_start_time'] == '00:00:00' && $check_row['sch_finish_time'] =='00:00:00'){
			if($check_row['content'] == $content) {
				$bol_check = false;
			}
			continue;
		}
		else if(!(($check_row['sch_start_time'] > $start && $check_row['sch_start_time'] > $finish) || ($check_row['sch_finish_time'] < $start && $check_row['sch_finish_time'] < $finish))) {
			$bol_check = false;
		}

	}
	if($bol_check) {
		$query_tryinsert = "insert into schedule (id, friend_range, sch_date, content, sch_start_time, sch_finish_time, cheer_num) values ('".$_SESSION['userid']."', ".$range.", '".$date."', '".$content."', '".$start."', '".$finish."', 0 )";
		$result_tryinsert = mysql_query($query_tryinsert);
	
		echo "<script>alert(\"일정이 추가되었습니다.\");</script>";
	}
	else {
		echo "<script>alert(\"일정이 겹쳐서 추가할 수 없습니다.\");</script>";
	}
	@mysql_close();
	$url = "http://localhost:81/main.php'";
	echo "<meta http-equiv='Refresh' content='0; URL=$url>"; 
?>