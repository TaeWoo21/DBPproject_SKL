<?php require("connect_today.php"); ?>

<!DOCTYPE>
<html>
<head> <title> ���� ���� ������ </title> </head>
<body>

<script type = "text/javascript" src = "today.js"> </script>

<h1> ���� ���� ������ </h1>

<table> <th> <td>
<div id = "Cal" align = "left" style = "position : relative; width : 750px;"> </div> </td>

<td valign = "top">
<div id = "View" align = "left" style = "position : relative; width : 300px; border : thin solid black; padding-left : 20px; padding-right : 20px; word-wrap:break-word;">

<h3 style = "text-align : center"> ���� ��� </h3>

<?php
if ($_GET['value']) display_list($_GET['value']);

function display_list($date_now) {
	$query = "select content from schedule where sch_date = '$date_now'";	//���̵� �߰��Ǹ� where �ڿ� �߰��� ��
	$result = mysql_query($query);
	$arr_list = mysql_fetch_assoc($result);

	$div_string = "<h3 style = 'text-align : center'> <b>- ".$_GET['value']." -</b> </h3>";

	if ($arr_list) {
		foreach($arr_list as $put) {
			$div_string .= $put;
			$div_string .= "</p>";
		}
		unset($put);
	}

	$div_string .= "<br>";
	$div_string .= "<a href = 'add_sch.php?value=".$_GET['value']."'>";
	$div_string .= "<div style = \"background-image : url('test.png'); width : 100px; height : 50px; margin : 0 auto;\"> </div> </a>";	//���� �������� �Ѿ�� ��ư
	$div_string .= "<br></p>";

	echo $div_string;
}
?>

</div> </td> </th> </table>

<?php @mysql_close(); ?>
</body>
</html>