<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>함께하기</title>
		<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
		<script type="text/javascript">

		</script>
	</head>

	<?php
		$date = date("Y-m-d");
		$Y = date("Y");
		$M = date("m");
	?>

	<body class = "body">
	<table width = "100%" class = "main"> <tr> <td>
		<div style = "text-align : left; margin-left : 20px;">
			<img src = "img/logo.png" width = "100px" height = "50px">
		</div> </td>
		<td align : right> <div style = "text-align : right; margin-right : 20px;">
			<img src = "img/home.png" width = "50px" height = "50px" onclick="window.location.replace('main.php');">
			<img src = "img/friend_menu.png" width = "50px" height = "50px" onclick = "window.location.replace('friend_main.php')">
			<img src = "img/sch_menu.png" width = "50px" height = "50px" onclick = <?php echo "\"window.location.replace('Calendar.php?value=$date&Y=$Y&M=$M');\""; ?> >
	</div> </td> </tr> </table>
		<form method='get' action=''>
			<fieldset style='background-color : #ffffff; width:500px; display: table; margin-left: auto; margin-right: auto;'>
		<?php
				$index = $_GET['index'];
				$query_try = "select id, sch_date, content, friend_range, sch_start_time, sch_finish_time from schedule where sch_index = ".$index."";
				$result_try = mysql_query($query_try);
				$row = mysql_fetch_assoc($result_try);
				$string ="<legend>";
				$string .="<table>";
				$string .="<tr>";
				$string .="<td>";
				$string .="'".$row['id']."'";
				$string .="</td>";
				$string .="<td>";
				$string .="님과  함께하시겠습니까?";
				$string .= "</td></tr></table></legend>";
				$string .= "<div>";
				$string .= "&lt;" . $row['sch_date'] . "&gt";
				$string .= "</div>";
				$string .= "<div>";
				$string .= "<table style='width:100%;''>";
				$string .= "<tr>";
				$string .= "<td style='width:200px; text-align:center;''>";
				if($row['sch_start_time']==null || $row['sch_finish_time']==null || $row['sch_start_time']=='00:00:00' || $row['sch_finish_time']=='00:00:00')  $string .= "";
				else $string .= $row['sch_start_time'] . " ~ " . $row['sch_finish_time'];
				$string .= "</td>";
				$string .= "<td>". $row['content'] ."</td></tr></table></div><br/>";
				$string .= "<table>";
				$string .= "<tr><td style='width:370px'></td>";
				$string .= "<td>";
				$string .= "<img src= 'img/cancle(default).png'  onclick='history.back();' onmouseover='this.src=\"img/cancle(over).png\" '; onmouseout='this.src=\"img/cancle(default).png\"';>";
				$string .= "</td>";
				$string .= "<td>";
				$string .="<img src= 'img/add(default).png' onclick='location.href=\"http://localhost:81/tryInsert.php?date=".$row['sch_date']."&start=".$row['sch_start_time']."&finish=".$row['sch_finish_time']."&content=".$row['content']."&range=".$row['friend_range']."\"'  onmouseover='this.src=\"img/add(over).png\" '; onmouseout='this.src=\"img/add(default).png\"';>";
				$string .= "</td></tr></table>";
				$string .= "</div>";
				$string .= "</fieldset></form><br/><br/>";

				echo $string;
		?>
	</body>
</html>