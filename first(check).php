<?php require("connect_today.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>기본화면</title>
		<script type="text/javascript">
			var db = (document.body) ? 1 : 0
			var scroll = (window.scrollTo) ? 1 : 0

			function setCookie(name, value, expires, path, domain, secure) {
				var curCookie = name + "=" + escape(value) + ((expires) ? "; expires=" + expires.toGMTString() : "") + ((path) ? "; path=" + path : "") + ((domain) ? "; domain=" + domain : "") + ((secure) ? "; secure" : "");
			document.cookie = curCookie;
			}

			function getCookie(name) {
				var dc = document.cookie;
				var prefix = name + "="
			  	var begin = dc.indexOf("; " + prefix);
			  	if (begin == -1) {
			    	begin = dc.indexOf(prefix);
			    	if (begin != 0) return null;
				} else {
			    	begin += 2
			  	}
			  	var end = document.cookie.indexOf(";", begin);
			  	if (end == -1) end = dc.length;
			  	return unescape(dc.substring(begin + prefix.length, end));
			}

			function saveScroll() {
				if (!scroll) return
				var now = new Date();
				now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000);
				var x = (db) ? document.body.scrollLeft : pageXOffset;
				var y = (db) ? document.body.scrollTop : pageYOffset;
				setCookie("xy", x + "_" + y, now);
			}

			function loadScroll() {
			  	if (!scroll) return
			  	var xy = getCookie("xy");
			  	if (!xy) return
			  	var ar = xy.split("_");
			  	if (ar.length == 2) scrollTo(parseInt(ar[0]), parseInt(ar[1]));
			  	dom.style = "visibility: visible;"
			}

			function commentView(num) {
				dom = document.getElementById("comment_click"+num);
				if(dom.style.visibility=="visible"){
					dom.style.visibility = "hidden";
					dom.style.height = "0px";
				}
				else{
					dom.style = "visibility: visible;"
				}
			}
		</script>
	</head>
	<body onLoad="loadScroll()" onUnload="saveScroll()">
		<header>
			 <img src = "img/test1.png" width = "100px" height = "50px" style="margin-left:20px;">
			 <img src = "img/news.png" width = "40px" height = "40px" style="position:absolute; left:1000px;" onclick="location.href='http://localhost:81/first(check).php?id=testuser1' "; onmouseover = "this.src = 'img/news(over).png' "; onmouseout = "this.src = 'img/news.png' "; onmousedown = " this.src = 'img/news(click).png' "; onmouseup = "this.src = 'img/news(over).png' ";> <!--testuser1 값을 세션값으로 바꿔줘야함-->
			 <img src = "img/test2.png" width = "40px" height = "40px" style="position:absolute; left:1060px;">
			 <img src = "img/test2.png" width = "40px" height = "40px" style="position:absolute; left:1120px;">
		</header>
		<hr/>
		<?php
			$query = "select distinct s.sch_index, s.id, s.sch_date, s.content, s.sch_start_time, s.sch_finish_time from friend as f, schedule as s where (f.id_friend = s.id and f.id = '".$_GET['id']."' and s.friend_range > 0) or s.id = '".$_GET['id']."' order by s.sch_modify_time desc";
			$result = mysql_query($query);
			$num = 0;
			while($row = mysql_fetch_assoc($result)){
				$string = "<form method='get' action='commentInsert.php'>";
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
				$string .= "<table>";
				$string .= "<tr><td style='width:340px'></td>";
				$string .= "<td>";
				$string .= "<img src = 'img/try.png' style='position:relative; bottom:-5px; margin-right:10px; float:right;' onclick = ''; onmouseover='this.src=\"img/try(over).png\" '; onmouseout='this.src=\"img/try.png\" '; onmousedown='this.src=\"img/try(click).png\"'; onmouseup='this.src=\"img/try(over).png\" '>";
				$string .= "<img src = 'img/comment.png' style='position:relative; bottom:0px; margin-right:10px; float:right;' onclick ='commentView(".$row['sch_index'].");' ; onmouseover='this.src=\"img/comment(over).png\" '; onmouseout='this.src=\"img/comment.png\" '; onmousedown='this.src=\"img/comment(click).png\"'; onmouseup='this.src=\"img/comment(over).png\" '>";

				$query_cheer = "select sp.sup_index from schedule as s, support as sp where sp.sch_index = ".$row['sch_index']." and sp.id ='".$_GET['id']."' and sp.flag = 'true'";
				$result_cheer = mysql_query($query_cheer);
				if(mysql_num_rows($result_cheer)==0){
					$string .= "<img id='".$num."' src = 'img/cheer.png' style='position:relative; bottom:-3px; margin-right:10px; float:right;' onclick = 'location.href=\"http://localhost:81/cheerClick.php?index=".$row['sch_index']."\"';  onmouseover='this.src=\"img/cheer(over).png\" '; onmouseout='this.src=\"img/cheer.png\" '; onmousedown='this.src=\"img/cheer(click).png\"'; onmouseup='this.src=\"img/cheer.png\";'>";
				}
				else {
					$string .= "<img id='".$num."' src = 'img/cheer(click).png' style='position:relative; bottom:-3px; margin-right:10px; float:right;' onclick = ' location.href=\"http://localhost:81/cheerClick.php?index=".$row['sch_index']."\"'; onmouseover='this.src=\"img/cheer(over).png\" '; onmouseout='this.src=\"img/cheer(click).png\" '; onmousedown='this.src=\"img/cheer(click).png\"'; onmouseup='this.src=\"img/cheer(click).png\";'>";
				}
				$string .= "</td></tr></table>";

				$string .= "<hr/>";
				$string .= "<table><tr><td>";
				$string .= "<textarea name='comment' cols='50' rows='5' style='position:relative'></textarea></td>";
				$string .= "<input name='for_index' type='hidden' value='".$row['sch_index']."'>";
				$string .= "<td style='width:110px;'><input type='image' id='".$num."' src='img/comment(insert).png' style='position:relative; bottom:2px; float:right;' onmouseover='this.src=\"img/comment(insert)(over).png\" '; onmouseout='this.src=\"img/comment(insert).png\" '; onmousedown='this.src=\"img/comment(insert)(click).png\"'; onmouseup='this.src=\"img/comment(insert)(over).png\" '>";
				$string .= "</td></tr>";
				$string .= "</table>";
				
				$query_comment = "select com_index, id, com_date, content from comment where sch_index = ".$row['sch_index']." order by com_date desc";
				$result_comment = mysql_query($query_comment);

				$string .= "<div id='comment_click".$row['sch_index']."' style='visibility:hidden; height:0px;'>";
				while($row2 = mysql_fetch_assoc($result_comment)){
					$string .= "<hr/>";
					$string .= "<table>";
					$string .= "<tr>";
					$string .= "<td rowspan='3'>";
					$string .= "<img src= 'img/person.png' width = '30px' height= '30px'>";
					$string .= "</td>";
					$string .= "<td>";
					$string .= "".$row2['id']."";
					$string .= "</td>";
					$string .= "</tr>";
					$string .= "<tr>";
					$string .= "<td>";
					$string .= "".$row2['com_date']."";
					$string .= "</td>";
					$string .= "</tr>";
					$string .= "<tr>";
					$string .= "<td style='width: 430px;'>";
					$string .= "".$row2['content']."";
					$string .= "</td>";
					$string .= "<td>";
					if($row2['id']=='testuser1')  {// testuser1을 세션 값으로 바꿔야함
						$string .= "<img src= 'img/buttonX.png' width = '20px' height= '20px' onclick = 'location.href=\"http://localhost:81/deleteComment.php?index=".$row2['com_index']."\"'; onmouseover='this.src=\"img/buttonX(over).png\" '; onmouseout='this.src=\"img/buttonX.png\" '; onmousedown='this.src=\"img/buttonX(click).png\"'; onmouseup='this.src=\"img/buttonX(over).png\" '>";
					}
					$string .= "</td>";
					$string .= "</tr>";

					$string .= "</table>";
				}
				$string .= "</div>";
				$string .= "</fieldset></form><br/><br/>";

				echo $string;
				$num++;
			}
		?>
	</body>
</html>