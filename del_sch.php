<?php

include "connect_today.php";

if (count($_GET) > 1) del_sch();
else {
	@mysql_close();
	echo "<script> alert('������ �������ּ���.'); window.location.replace('Calendar.php?value=".$_GET['value']."');</script>";
}

function del_sch() {
	for ($i = 0; $i < count($_GET)-1; $i++) {
		$query = "delete from schedule where sch_date = '".$_GET['value']."' and content = '".$_GET[$i]."';";	//id �߰��Ұ�
		mysql_query($query);
	}

	@mysql_close();

	echo "<script> alert('������ �����Ǿ����ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."');</script>";
}

?>