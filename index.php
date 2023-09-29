<?php  
require_once("Include/db.php");
$db=new DataManager();

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {        session_start();        
        $_SESSION["Category"]=$_POST["txtCategory"];        
       header('Location: Section_1.php' );        
    }
	   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Page-Enter" content="RevealTrans(Duration=3,Transition=22)">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="Scripts/Site.css" type="text/css">
        <script src="Scripts/jquery-1.4.1.min.js"></script>
        <title>Application Form</title>
    <style type="text/css">
    #apDiv1 {
	position:absolute;
	left:582px;
	top:103px;
	width:107px;
	height:22px;
	z-index:3;
	font-size: medium;
}
    </style>
    </head>
    <body>
    <div id="header">APPLICATION FORM </div>    
    <div id="content">
      <form name="form1" method="post" action="Index.php">
        Please select the form applicable to you: 
          <select name="txtCategory" id="txtCategory">
              <?php
                  $result=$db->getCategories();
                  while($row=mysql_fetch_array($result))
                  {
                      echo'<option value='.$row[0].'>'.$row[0].'</option>';
                  }              
              ?>
        </select> 
        <input type="submit" class="button"  id="go" value="Go">   
        <?php echo date('Y-m-j');  ?>
        
      </form>
       
    </div>
    <div id="apDiv1"><a href="AdminHome.php">Admin Login</a></div>
</body>
</html>
