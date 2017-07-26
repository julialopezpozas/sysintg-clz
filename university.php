<form action="#" method="post">
<input type="checkbox" name="university_list[]" value="De La Salle University"><label>De La Salle University</label><br/>
<input type="checkbox" name="university_list[]" value="Ateneo De Manila University"><label>Ateneo De Manila University</label><br/>
<input type="checkbox" name="university_list[]" value="Lyceum of the Philippines University"><label>Lyceum of the Philippines University</label><br/>
<input type="checkbox" name="university_list[]" value="Mapua Institute of Technology"><label>Mapua Institute of Technology</label><br/>
<input type="checkbox" name="university_list[]" value="University of Santo Tomas"><label>University of Santo Tomas</label><br/>
<input type="checkbox" name="university_list[]" value="University of the Philippines"><label>University of the Philippines</label><br/>
<input type="checkbox" name="university_list[]" value="Systems Technology Institute"><label>Systems Technology Institute</label><br/>
Age range: <input type="number" name="minAge"> to <input type="number" name="maxAge"><br/>
<input type="submit" name="submit" value="Submit"/>
</form>
<?php
session_start();
require_once('../mysql_connect.php');

if(isset($_POST['submit'])){//to run PHP script on submit
	if(!empty($_POST['university_list'])){
	// Loop to store and display values of individual checked checkbox.
		echo"
			<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Birthday</th>
					<th>University</th>
				</tr>
			";
		foreach($_POST['university_list'] as $selected){
			//echo $selected;
			$query ="select first, last, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age, university from sysintg.student_data where university='".$selected."' and TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >='".$_POST['minAge']."' and TIMESTAMPDIFF(YEAR, birthday, CURDATE()) <='".$_POST['maxAge']."' order by university, age"; 
			$result = mysqli_query($dbc, $query);
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td>{$row['first']}</td>";
				echo "<td>{$row['last']}</td>";
				echo "<td>{$row['age']}</td>";
				echo "<td>{$row['university']}</td>";
				echo "</tr>";
			}
			
		}
		echo"
		</table>
		";
	}
}
if(!isset($_POST['submit'])){
	echo 'Master List<br/>';
	$query = "select count(*) as total from sysintg.student_data";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo "Total number of entries: {$row['total']} <br/>";
	echo "Breakdown:<br/>";
	
	
	$query="select distinct(university) as university from sysintg.student_data";
	$result = mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$query1 = "select count(*) as total from sysintg.student_data where university = '".$row['university']."'";
		$result1 = mysqli_query($dbc, $query1);
		$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
		echo "{$row['university']}: {$row1['total']} <br/>";
	}

	echo"
			<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Birthday</th>
					<th>University</th>
				</tr>
			";
	$query ="select first, last, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age, university from sysintg.student_data order by university, age";
	$result = mysqli_query($dbc, $query);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<tr>";
			echo "<td>{$row['first']}</td>";
			echo "<td>{$row['last']}</td>";
			echo "<td>{$row['age']}</td>";
			echo "<td>{$row['university']}</td>";
			echo "</tr>";
	}
	echo"
	</table>
	";
	
}
?>