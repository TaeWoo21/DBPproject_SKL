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
				$query_cheer_people = "select id from support where sch_index = ".$index."";
				$result_cheer_people = mysql_query($query_cheer_people);
				
				$string ="<legend>";
				$string .="<table>";
				$string .="<tr>";
				$string .="<td>";
				$string .="<이 글을 응원하는 사람>";
				$string .= "</td></tr></table></legend>";
				
				while($row_people = mysql_fetch_assoc($result_cheer_people)){
					$string .= "<div>";
					$string .= "<table style='width:100%;''>";
					$string .= "<tr>";
					$string .= "<td style='width:200px; text-align:center;''>";
					$string .= "<img src= 'img/person.png' width = '30px' height= '30px'>";
					$string .= "</td>";
					$string .= "<td>". $row_people['id'] ."</td></tr></table></div><br/>";
				}
				$string .= "<table>";
				$string .= "<tr><td style='width:370px'></td>";
				
				$string .= "<td>";
				$string .= "<img src= 'img/cancle(default).png'  onclick='history.back();' onmouseover='this.src=\"img/cancle(over).png\" '; onmouseout='this.src=\"img/cancle(default).png\"';>";
				$string .= "</td></tr></table>";
				$string .= "</fieldset></form><br/><br/>";

				echo $string;
		?>
	</body>
</html>