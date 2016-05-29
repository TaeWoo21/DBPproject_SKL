<?php require("connect_today.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>기본화면</title>
	</head>
	<body>
		<header>
			 <img src = "img/test1.png" width = "100px" height = "50px" style="margin-left:20px;">
			 <img src = "img/news.png" width = "40px" height = "40px" style="position:absolute; left:1000px;" onclick="location.href='http://localhost:81/first(check).php' "; onmouseover = "this.src = 'img/news(over).png' "; onmouseout = "this.src = 'img/news.png' "; onmousedown = " this.src = 'img/news(click).png' "; onmouseup = "this.src = 'img/news(over).png' ";>
			 <img src = "img/test2.png" width = "40px" height = "40px" style="position:absolute; left:1060px;">
			 <img src = "img/test2.png" width = "40px" height = "40px" style="position:absolute; left:1120px;">
		</header>
		<hr/>
		<?php
			$query = "select id, sch_date, content, sch_start_time, sch_finish_time from schedule order by sch_index desc";
			$result = mysql_query($query);

			while($row = mysql_fetch_assoc($result)){
				$string = "<form>";
				$string .="<fieldset style='width:500px; display: table; margin-left: auto; margin-right: auto;'>";
				$string .="<legend>";
				$string .="<table>";
				$string .="<tr>";
				$string .="<td>";
				$string .="<img src= 'img/person.png' width = '40px' height= '40px'>";
				$string .="</td>";
				$string .="<td>";
				$string .= $row['id']."";
				$string .= "</td></tr></table></legend>";
				$string .= "<div>";
				$string .= "&lt;" . $row['sch_date'] . "&gt";
				$string .= "</div>";
				$string .= "<div>";
				$string .= "<table style='width:100%;''>";
				$string .= "<tr>";
				$string .= "<td style='width:200px; text-align:center;''>";
				if($row['sch_start_time']==null || $row['sch_finish_time']==null)  $string .= "";
				else $string .= $row['sch_start_time'] . " ~ " . $row['sch_finish_time'];
				$string .= "</td>";
				$string .= "<td>". $row['content'] ."</td></tr></table></div><br/>";

				$string .= "<img src = 'img/try.png' style='position:relative; bottom:-5px; margin-right:5px; float:right;'' onclick = ' '; onmouseover='this.src=\"img/try(over).png\" '; onmouseout='this.src=\"img/try.png\" '; onmousedown='this.src=\"img/try(click).png\"'; onmouseup='this.src=\"img/try(over).png\" '>";
				$string .= "<img src = 'img/comment.png' style='position:relative; bottom:-5px; margin-right:10px; float:right;' onclick = ' '; onmouseover='this.src=\"img/comment(over).png\" '; onmouseout='this.src=\"img/comment.png\" '; onmousedown='this.src=\"img/comment(click).png\"'; onmouseup='this.src=\"img/comment(over).png\" '>";
				$string .= "<img src = 'img/cheer.png' style='position:relative; bottom:-5px; margin-right:10px; float:right;' onclick = ' '; onmouseover='this.src=\"img/cheer(over).png\" '; onmouseout='this.src=\"img/cheer.png\" '; onmousedown='this.src=\"img/cheer(click).png\"'; onmouseup='this.src=\"img/cheer(over).png\" '>";
				$string .= "</fieldset></form></body></html><br/><br/>";

				echo $string;
			}			
		?>
		<!--		
		<form>
			<fieldset style="width:500px; display: table; margin-left: auto; margin-right: auto;">
				<legend>
					<table>
						<tr>
							<td>
								<img src= "img/person.png" width = "40px" height="40px">
							</td>
							<td>
								이태우
							</td>
						<tr>
					</table>
				</legend> 
				<div>&lt;2016-05-26 (목)&gt;</div><br/> 
				<div>
					<table style="width:100%;">
						<tr>
							<td style="width:200px; text-align:center;">PM 10:00 ~ PM 11:00</td> 
							<td>코딩하기</td>
						</tr>
					</table>
				</div><br/>
				<img src = "img/button.png" style="position:relative; bottom:-5px; margin-right:5px; float:right;">
				<img src = "img/button.png" style="position:relative; bottom:-5px; margin-right:10px; float:right;">
				<img src = "img/button.png" style="position:relative; bottom:-5px; margin-right:10px; float:right;">
			</fieldset>
		</form> -->
	</body>
</html>