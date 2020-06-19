<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "managerview.jpg">
<ul>
<li class="dropdown"><font color="yellow" size="10">ADMIN MODE</font></li>
<br>
<h2>
<li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Usuario</a>
    <div class="dropdown-content">
      <a href="adddoctor.php">Agregar usuario</a>
      <a href="deletedoctor.php">Eliminar usuario</a>
      <a href="showdoctor.php">Mostrar usuario</a>
	  <a href="showdoctorschedule.php">Mostrar citas de usuario</a>
    </div>
  </li>
  
  <li class="dropdown">
  <a href="javascript:void(0)" class="dropbtn">Establecimiento</a>
    <div class="dropdown-content">
      <a href="addclinic.php">Añadir establecimiento</a>
      <a href="deleteclinic.php">Eliminar establecimientp</a>
      <a href="adddoctorclinic.php">Agregar usuario en establecimiento</a>
	  <a href="addmanagerclinic.php">Agregar cita a establecimiento</a>
	  <a href="deletedoctorclinic.php">Borrar usuario de establecimiento</a>
	  <a href="deletemanagerclinic.php">Borrar cita de establecimiento</a>
	  <a href="showclinic.php">Mostrar cita de establecimiento</a>
    </div>
  </li>
  <li class="dropdown">    
  <a href="javascript:void(0)" class="dropbtn">Cita</a>
    <div class="dropdown-content">
      <a href="addmanager.php">Agregar cita</a>
      <a href="deletemanager.php">Eliminar cita</a>
	  <a href="showmanager.php">Mostrar citas</a>
    </div>
  </li>
  <li>  
	<form method="post" action="mainpage.php">	
	<button type="submit" class="cancelbtn" name="logout" style="float:right;font-size:22px"><b>Log Out</b></button>
	</form>
  </li>
	
</ul>
</h2>
<h1>
<center><h1>ELIMINAR CITA</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Enter MID:<center><input type="number" name="mid"></center>
			<button type="submit" name="Submit1">Delete by DID</button>
			<br>---------OR---------<br>
Select Name:<br><?php
				require_once('dbconfig.php');
				$manager_result = $conn->query('select * from manager order by MID ASC');
				?>
				<center>
				<select name="managername">
				<option value="">---Select Name---</option>
				<?php
				if ($manager_result->num_rows > 0) {
				while($row = $manager_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["MID"]; ?>"><?php echo "(MID=".$row["MID"].") ".$row["Name"]; ?></option>
				<?php
					}
					}
				?>
				</select></center>
				
				<button type="submit" name="Submit2">Delete by Name</button>
</form>			
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit1']))
{
	$mid=$_POST['mid'];
	$sql = "DELETE FROM manager WHERE MID= $mid ";
	$sql1="update clinic set MID=0 where MID=$mid";
	if (mysqli_query($conn, $sql))
		{
		echo "Record deleted successfully.Refreshing....";
		header( "Refresh:3; url=deletemanager.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
				if (mysqli_query($conn, $sql1)) 
				{
							echo "<h2>Record reseted in CLINIC TABLE!!</h2>";
							echo "Please wait...Refreshing...";
							header( "Refresh:2; url=deletemanager.php");

				} 
				else
				{
					echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}
				
}
if(isset($_POST['Submit2']))
{
	$mid=$_POST['managername'];
	$sql = "DELETE FROM manager WHERE mid = $mid ";
	$sql1="update clinic set MID=0 where MID=$mid";
	if (mysqli_query($conn, $sql))
		{
		echo "Record deleted successfully.Refreshing....";
		header( "Refresh:3; url=deletemanager.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
				
				if (mysqli_query($conn, $sql1)) 
				{
							echo "<h2>Record reseted in CLINIC TABLE!!</h2>";
							echo "Please wait...Refreshing...";
							header( "Refresh:2; url=deletemanager.php");

				} 
				else
				{
					echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}

}	
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
?>			
</body>
</html>