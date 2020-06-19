<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="adminmain.css"> 
</head>
<body background= "doctordesk.jpg">
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
<center><h1>ELIMINAR USUARIO</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Enter DID:<center><input type="number" name="did"></center>
			<button type="submit" name="Submit1">Delete by DID</button>
			<br>---------OR---------<br>
Select Name:<br><?php
				require_once('dbconfig.php');
				$doctor_result = $conn->query('select * from doctor order by DID ASC');
				?>
				<center>
				<select name="doctorname">
				<option value="">---Select Name---</option>
				<?php
				if ($doctor_result->num_rows > 0) {
				while($row = $doctor_result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["DID"]; ?>"><?php echo "(DID= $row[DID]) Dr. ".$row["Name"]; ?></option>
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
	$did=$_POST['did'];
	$sql = "DELETE FROM doctor WHERE DID= $did ";
	$sqlda = "DELETE FROM doctor_availability WHERE DID= $did ";
	if (mysqli_query($conn, $sql))
		{
		echo "Record deleted successfully from doctors table.Refreshing....";
		header( "Refresh:3; url=deletedoctor.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
		
	if (mysqli_query($conn, $sqlda))
		{
		echo "Record deleted successfully from doctors_availability table.Refreshing....";
		header( "Refresh:3; url=deletedoctor.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
}
if(isset($_POST['Submit2']))
{
	$did=$_POST['doctorname'];
	$sql = "DELETE FROM doctor WHERE did = $did ";
	$sqlda = "DELETE FROM doctor_availability WHERE DID= $did ";
	if (mysqli_query($conn, $sql))
		{
		echo "Record deleted successfully.Refreshing....";
		header( "Refresh:3; url=deletedoctor.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
	if (mysqli_query($conn, $sqlda))
		{
		echo "Record deleted successfully from doctors_availability table.Refreshing....";
		header( "Refresh:3; url=deletedoctor.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
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