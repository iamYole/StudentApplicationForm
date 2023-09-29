<?php  
require_once("Include/db.php");
$db=new DataManager();

$isValid=true;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {       
        if(empty ($_POST['txtUsername']) || empty($_POST['txtPword']))
        {
            $isValid=true;
            $msg="Fill in your Login Credentials";
        }
        else
        {
            $result=$db->authenticate($_POST['txtUsername'], $_POST['txtPword']);

            if(mysql_num_rows($result)>0)
            {
                session_start();        
                $_SESSION["User"]=$_POST["txtUsername"];        
                header('Location: AdminHome.php' );  
            }
            else
            {
                $isValid=true;
                $msg="Invalid UserId And/Or Password";
            }
        }
    }
	   
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Console</title>
<link rel="stylesheet" href="Scripts/Site.css" type="text/css">
<style type="text/css">

#apDiv2 {
	position:absolute;
	left:448px;
	top:342px;
	width:402px;
	height:148px;
	z-index:2;
	line-height: normal;
	color:#E47000;
}
#apDiv1 {
	position:absolute;
	left:445px;
	top:310px;
	width:415px;
	height:24px;
	z-index:3;
	color: #F00;
	font-size: medium;
}
#apDiv2 #login table {
	font-size: medium;
}
</style>
</head>

<body>
<div id="consoleLogo">
<img src="Scripts/Images/crest.png" width="180" height="120" align="left" />
<h1>ADMIN CONSOLE</h1>
</div>

<div id="apDiv2">
<form id="login" action="AdminConsole.php" method="post">
  <table width="346" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="115" align="right">User Name</td>
      <td width="172"><label for="txtUsername"></label>
        <input name="txtUsername" type="text" id="txtUsername" size="25" /></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><label for="txtPword"></label>
        <input name="txtPword" type="password" id="txtPword" size="25" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td align="left"><input name="btnSend" type="submit" class="button" id="btnSend" value="Submit" /></td>
    </tr>
  </table>
  </form>
</div>
<div id="apDiv1">
<?php
    if($isValid)
        echo $msg;
?>
</div>
</body>
</html>