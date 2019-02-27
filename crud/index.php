<?php
include_once("config.php");
include_once("controller.php");
$usuarioDAO = Controller::getInstance();
$lista = $usuarioDAO->Lista();
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>

<a href="add.html">Add New Data</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Age</td>
		<td>Email</td>
		<td>Update</td>
	</tr>
	<?php 
	
	foreach($lista as $res) { 
		echo "<tr>";
		echo "<td>".$res["nome"]."</td>";
		echo "<td>".$res["celular"]."</td>";
		echo "<td>".$res["email"]."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"controller.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
