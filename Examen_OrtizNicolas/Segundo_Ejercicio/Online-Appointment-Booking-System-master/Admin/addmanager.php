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
<center><h1>AÑADIR CITA</h1><hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  MID:<input type="number" name="mid" required>
  <br>
  Name: <input type="text" name="name" required>
  <br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <br>
  DOB: <input type="date" name="dob" required>
  <br>
  Contact no.: <input type="number" name="contact" maxlength="10" minlength="10" required>
  <br>
  Address: <input type="text" name="address" required>
  <br>
  Username: <input type="text" name="username" required>
  <br>
  Password: <input type="password" name="pwd" required>
  <br>
  Region: <input type="text" name="region" required>
  <br>
  <button type="submit" name="Submit">REGISTER</button>
</form>
</font></b>
</center>
<?php
session_start();
if(isset($_POST['logout'])){
		session_unset();
		session_destroy();
		header( "Refresh:1; url=alogin.php"); 
	}
function newUser()
{
	include 'dbconfig.php';
		$mid=$_POST['mid'];
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$contact=$_POST['contact'];
		$address=$_POST['address'];
		$username=$_POST['username'];
		$password=$_POST['pwd'];
		$region=$_POST['region'];
		$sql = "INSERT INTO manager (MID, Name, Gender, DOB,Contact,Address,Username,Password,region) VALUES ('$mid','$name','$gender','$dob','$contact','$address','$username','$password','$region') ";

	if (mysqli_query($conn, $sql)) 
	{
		echo "<h2>Record created successfully!! Refreshing....</h2>";
		header( "Refresh:2; url=addmanager.php");

	} 
	else
	{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
function checkmid()
{
	include 'dbconfig.php';
	$mid=$_POST['mid'];
	$sql= "SELECT * FROM manager WHERE MID = '$mid'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>MID already exists!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		newUser();
	}

	
}
function checkusername()
{
	include 'dbconfig.php';
	$usn=$_POST['username'];
	$sql= "SELECT * FROM manager WHERE Username = '$usn'";

	$result=mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)!=0)
       {
			echo"<b><br>Username already exists!!";
       }
	else 
		if(isset($_POST['Submit']))
	{ 
		checkmid();
	}

	
}
if(isset($_POST['Submit']))
{
	if(!empty($_POST['mid'])&& !empty($_POST['region']) && !empty($_POST['username']) && !empty($_POST['pwd']) &&!empty($_POST['name']) &&!empty($_POST['dob'])&& !empty($_POST['gender']) &&!empty($_POST['address']) && !empty($_POST['contact']))
		checkusername();
	else
		echo "EMPTY VALUES NOT ALLOWED";
}

?>

</body>
</html>