<html>
<head>
<script src="jquerypart.js" type="text/javascript"></script>
<link rel="stylesheet" href="adminmain.css"> 
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getclinic.php",
	data:'city='+val,
	success: function(data){
		$("#clinic-list").html(data);
	}
	});
}
function getManager(val) {
	$.ajax({
	type: "POST",
	url: "getmanager.php",
	data:'cid='+val,
	success: function(data){
		$("#manager-list").html(data);
	}
	});
}

</script>
</head>
<body background= "clinicview.jpg">
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
<center><h1>ELIMINAR CITA DE ESTABLECIMIENTO</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<label style="font-size:20px" >City:</label>
		<select name="city" id="city-list" class="demoInputBox"  onChange="getState(this.value);">
		<option value="">Select City</option>
		<?php
		include 'dbconfig.php';
		$sql1="SELECT distinct City FROM clinic";
         $results=$conn->query($sql1); 
		while($rs=$results->fetch_assoc()) { 
		?>
		<option value="<?php echo $rs["City"]; ?>"><?php echo $rs["City"]; ?></option>
		<?php
		}
		?>
		</select>
        
	
		<label style="font-size:20px" >Clinic:</label>
		<select id="clinic-list" name="clinic" onchange="getManager(this.value);" >
		<option value="">Select Clinic</option>
		</select>
		
		<label style="font-size:20px" >Manager:</label>
		<select name="manager" id="manager-list" >
		<option value="">Select Manager</option>
		</select>
		
		
		<button name="Submit" type="submit">Submit</button>
	</form>
<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['Submit']))
{
	$cid=$_POST['clinic'];
	$mid=$_POST['manager'];
	$sql = "DELETE FROM manager_clinic WHERE CID= $cid AND MID= $mid";
	$sql1="update clinic set MID = 0 where MID= $mid";

	if (mysqli_query($conn, $sql))
		{
		echo "Record deleted successfully in manager_clinic table.Refreshing....";
		header( "Refresh:2; url=deletemanagerclinic.php");
		}
	else
		{
			echo "Error deleting record: " . mysqli_error($conn);
		}
	if (mysqli_query($conn, $sql1)) 
				{
							echo "<h2>Record created successfully( CID=$cid MID=$mid )in CLINIC TABLE!!</h2>";
							echo "Please wait...Refreshing...";
							header( "Refresh:2; url=deletemanagerclinic.php");

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