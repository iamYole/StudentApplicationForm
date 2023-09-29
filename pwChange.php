<?php
require_once("Include/db.php");
$db=new DataManager();
session_start();
    if (array_key_exists("User", $_SESSION))
    {        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {         
           if(!empty($_POST['submit-password']))
           {
               $ermsg="";
               if(empty($_POST['txtOPw']) || empty($_POST['txtNPw']) || empty($_POST['txtRNPw']))
               {
                   $ermsg="Please Enter you old and new password";
               }
               else if($_POST['txtNPw'] != $_POST['txtRNPw'])
               {
                    $ermsg="Your New Password MUST Be the Same The Re-New Password";
               }
               else
               {
                   $result=$db->authenticate($_SESSION['User'],$_POST['txtOPw'] );
                   if(mysql_num_rows($result)> 0)
                   {
                        $db->resetPw($_SESSION['User'], $_POST['txtOPw'], $_POST['txtRNPw']);
                        $ermsg="Password Changed Sucessfully";
                   }
                   else
                   {
                       $ermsg="Invalid Password";
                   }
               }
           }
        }
     }
    else
    {
        header('Location: AdminConsole.php' );
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Console| Home</title>
<link rel="stylesheet" href="Scripts/Site.css" type="text/css">
<script src="Scripts/jquery-1.4.1.min.js"></script>
<style type="text/css">
body,td,th {
	font-size: medium;
	color: #FFF;
}
body {
	background-color: #E47000;
}
#apDiv10 {
	position:absolute;
	left:350px;
	top:64px;
	width:450px;
	height:22px;
	z-index:4;
	background-color: #FFFFFF;
	font-style: italic;
	line-height: normal;
	font-weight: 700;
	color: #F00;
}
#apDiv1 {
	position:absolute;
	left:399px;
	top:5px;
	width:278px;
	height:29px;
	z-index:4;
	background-color: #E47000;
	line-height: normal;
	font-weight: 900;
	color: #FFF;
}
#apDiv2 {
	position:absolute;
	left:320px;
	top:128px;
	width:440px;
	height:164px;
	z-index:4;
	background-color: #E47000;
	line-height: normal;
	font-weight: 900;
}
</style>
</head>

<body>
<div id="consoleLogo">
<img src="Scripts/Images/crest.png" width="180" height="120" align="left" />
<h2>ADMIN CONSOLE</h2>
</div>
<div id="menuBar">
<div id="menuItem">
  <table width="99%" border="0" cellspacing="5" cellpadding="5">
    <tr align="center">
      <a href="AdminHome.php"><td width="27%" id="tdHome"><a href="AdminHome.php">BACK</a></td></a>
      <td width="27%" class="menuHovered" id="tdPword">  PASSWORD  </td>
      <td width="27%" id="tdApp"> </td>
      <td width="27%" id="tdEn"></td>
    </tr>
  </table>
 </div>
</div>

<div id="pwContent">
<div id="apDiv1">Password Change</div>
<?php
    echo '<div id="apDiv10">'.$ermsg.'</div>';
?>
 <div id="apDiv2">
     <form id="pw" method="POST" action="pwChange.php"> 
  <table width="383" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td width="168" align="right">Old Password</td>
      <td width="180"><label for="txtOPw"></label>
      <input type="password" name="txtOPw" id="txtOPw" placeholder="Enter Password"/></td>
    </tr>
    <tr>
      <td align="right">New Password</td>
      <td><input type="password" name="txtNPw" id="txtNPw" placeholder="New Password"/></td>
    </tr>
    <tr>
      <td align="right">RE-New Password</td>
      <td><input type="password" name="txtRNPw" id="txtRNPw" placeholder="Confirm Password"/></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input name="submit-password" type="submit" class="button" id="submit-password" value="Save" /></td>
    </tr>
  </table>
    </form>
</div>
</div>
<script>
$(document).ready(function()
	 	{			
			$('#stds tr').mouseover(function()
			{
				$(this).addClass('mHover');
			});
			$('#stds tr').mouseout(function()
			{
				$(this).removeClass('mHover');
			});
			
			/*$('#tdHome').click(function()
			 {
             		$(this).addClass('menuHovered');
					$('#tdPword').removeClass('menuHovered');
					$('#tdApp').removeClass('menuHovered');
					$('#tdEn').removeClass('menuHovered');
					
					$('#appContent').fadeOut('slow');
					$('#enContent').fadeOut('slow');
					$('#pwContent').fadeOut('slow');
					$('#searchContent').fadeIn('slow');
			 });*/
			 $('#tdPword').click(function()
			 {
             		$(this).addClass('menuHovered');
					$('#tdHome').removeClass('menuHovered');
					$('#tdApp').removeClass('menuHovered');
					$('#tdEn').removeClass('menuHovered');
					
					$('#searchContent').fadeOut('slow');
					$('#enContent').fadeOut('slow');
					$('#appContent').fadeOut('slow');
					$('#pwContent').fadeIn('slow');
			 });			
			 
			 $('#menuItem td').hover(function()
				{
					$(this).addClass('menuHover');
				},function()
				{
					$(this).removeClass('menuHover');	
			});
		});
</script>
</body>
</html>