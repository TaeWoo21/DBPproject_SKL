<?php require("connect_today.php"); ?>

<!DOCTYPE>
<html>
<head> <title> ���� �߰� ������ </title> </head>
<body>

<h1> ���� �߰� ������ </h1>


<?php
if ($_GET['content']) {
	add_content($_GET['value'], $_GET['content']);
	display_list($_GET['value']);
}
else echo "<script> alert('������ �Է����ּ���.'); window.location.replace('Calendar.php?value=".$_GET['value']."');</script>";

function display_list($date_now) {
	$query = "select content from schedule where sch_date = '$date_now'";	//���̵� �߰��Ǹ� where �ڿ� �߰��� ��
	$result = mysql_query($query);
	$arr_list = mysql_fetch_assoc($result);

	$div_string = '<div id = "View" align = "left" style = "position : relative; width : 300px; border : thin solid black; padding-left : 20px; padding-right : 20px; margin : 0px; word-wrap:break-word;">';
	$div_string .= "<h3> <b> ���� �߰� �Ϸ� </b> </h3> <h3 style = 'text-align : center'> <b>- ".$_GET['value']." -</b> </h3>";

	if ($arr_list) {
		foreach($arr_list as $put) {
			$div_string .= $put;
			$div_string .= "<p>";
		}
		unset($put);
	}

	$div_string .= "<br><p>";
	$div_string .= "<a href = 'Calendar.php?value=$date_now'> <input type = 'button' value = 'Ȯ��'> </a>";

	echo $div_string;
}

function add_content($date_now, $content) {
	$date_now = explode("-", $date_now);
	if ($date_now[1] < 10) $date_now[1] = "0".$date_now[1];
	if ($date_now[2] < 10) $date_now[2] = "0".$date_now[2];

	$query = "insert into schedule (id, friend_range, cheer_num, sch_date, content) values ('qwer', 1, 0, $date_now[0]$date_now[1]$date_now[2], '$content')";
	mysql_query($query);
}

?>
</div>

<?php @mysql_close(); ?>

</body>
</html>
