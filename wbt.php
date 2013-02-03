<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" title="My Style" href="../style.css">
		<title>INSE COURSEWORK</title>
	</head>
	
	<body>
		<header> 
			<p>DIAGRAM MASTER</p>
			<form action=" ">
				<input type="text" name="FirstName" value=""><br>
				<input type="submit" value="Search">
			</form>
		</header>
		<article>
			<h1>Tasks</h1>
			<?php
				$link = mysql_connect("localhost", "root", "") 
					OR die("Could not connect to server");
		
				mysql_select_db('inse')
					OR die('Could not select database.');
					
				include ("task.php");
				
				getAllTasks();
				
				function getAllTasks() {
					$table = mysql_query("SELECT * FROM wbt_task WHERE task_parent = '0'");
					$row = mysql_fetch_assoc($table);
					//echo ucfirst($row["task_name"])."\n";
					$task = new Task($row["task_id"], $row["task_name"], $row["task_parent"]);
					echo "<ul id = 'wbt_tasks'>";
					echo "<li>&nbsp;&nbsp;".ucfirst($task->getName())."\n</li>";
					getSubtasks($task);
					echo "</ul>";
				}
				
				function getSubtasks($t) {
					$subtasks = $t->getSubtasks();
					echo "<p>";
					if (count($subtasks) != 0) {
						foreach ($subtasks as $sub) {
							echo "<li>".($sub->getId()-1)."&nbsp;&nbsp;".ucfirst($sub->getName())."\n</li>";
							getSubtasks($sub);
						}
					}
				}						
			?>
			
		</article>
		
		<footer>
		</footer>
	</body>
</html>
