<?php
require_once("Include/db.php");
$db=new DataManager();
session_start();
    if (array_key_exists("User", $_SESSION))
    {        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $isErr=false;
            
            if(!empty($_POST['byReg-Submit']))
            {
                if(!empty($_POST['txtRegNo']) || $_POST['txtRegNo']!="REG")
                {
                    $result=$db->getApplicantsByRegNo($_POST['txtRegNo']);
                    if(mysql_num_rows($result) > 0)
                    {
                        $_SESSION['Reg_No']=$_POST['txtRegNo'];
                        
                        header('Location: applicantInfo.php' );
                    }
                    else
                    {
                        $isErr=true;
                    }
                }
            }
            if(!empty($_POST['bySurname-Submit']))
            {
                 if(!empty($_POST['txtSurname']))
                  {
                     $result=$db->getApplicantsBySurname($_POST['txtSurname']);
                     $val=mysql_num_rows($result);
                     if(!($val < 1))
                     {
                        $_SESSION["criterion"]="SURNAME";
                        $_SESSION["Value"]=$_POST['txtSurname'];

                        header('Location: studentSearch.php' );
                     }
                     else
                     {
                         $isErr=true;
                     }
                  }                  
            }            
            if(!empty($_POST['byClass-Submit']))
            {
                if(!empty($_POST['txtClass']))
                {
                    $result=$db->getApplicantsByClass($_POST['txtClass']);
                     $val=mysql_num_rows($result);
                     
                    if(!($val < 1))
                    {
                        $_SESSION['criterion']="CLASS";
                        $_SESSION["Value"]=$_POST['txtClass'];

                        header('Location: studentSearch.php');
                    }
                    else
                     {
                         $isErr=true;
                     }
                }
            }
           if(!empty($_POST['byCategory-Submit'])) 
           {
                if(!empty($_POST['txtCategory']))
                {
                    $result=$db->getApplicantsByCategory($_POST['txtCategory']);
                     $val=mysql_num_rows($result);
                     
                     if(!($val < 1))
                     {
                        $_SESSION['criterion']="CATEGORY";

                        $_SESSION["Value"]=$_POST['txtCategory'];

                        header('Location: studentSearch.php');
                     }
                     else
                     {
                         $isErr=true;
                     }
                }
           }
           if(!empty($_POST['submit-password']))
           {
               $ermsg="";
               if(empty($_POST['txtOPw']) || empty($_POST['txtNPw']) || empty($_POST['txtRNPw']))
               {
                   $ermsg="Please Enter you old and new password";
               }
               else if($_POST['txtNPW'] != $_POST['txtRNPw'])
               {
                    $ermsg="Please Enter you old and new password";
               }
               else
               {
                   $db->changePassword($_SESSION['User'], $_POST['txtNPw'], $_POST['txtRNPw']);
                   $ermsg="Password Changed Sucessfully";
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
	color: #FFF;
}
body {
	background-color: #E47000;
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
#apDiv3 {
	position:absolute;
	left:49px;
	top:55px;
	width:1005px;
	height:334px;
	z-index:4;
	background-color: #E47000;
}
#apDiv4 {
	position:absolute;
	left:-1px;
	top:86px;
	width:513px;
	height:68px;
	z-index:5;
	background-color: #FFFFFF;
	line-height: 65px;
	color: #E47000;
}
#apDiv5 {
	position:absolute;
	left:505px;
	top:86px;
	width:505px;
	height:68px;
	z-index:5;
	background-color: #FFFFFF;
	line-height: 65px;
	color: #E47000;
}
#apDiv6 {
	position:absolute;
	left:0px;
	top:220px;
	width:512px;
	height:68px;
	z-index:5;
	background-color: #FFFFFF;
	line-height: 65px;
	color: #E47000;
}
#apDiv7 {
	position:absolute;
	left:501px;
	top:220px;
	width:507px;
	height:68px;
	z-index:5;
	background-color: #FFFFFF;
	line-height: 65px;
	color: #E47000;
}
#apDiv8 {
	position:absolute;
	left:368px;
	top:7px;
	width:346px;
	height:28px;
	z-index:4;
	background-color: #FFFFFF;
	color: #F00;
	font-weight: 900;
}
#apDiv9 {
	background-color:#000;
	color:#FFF;
	position:absolute;
	left:564px;
	top:511px;
	width:267px;
	height:55px;
	z-index:4;
}
#apDiv10 {
	position:absolute;
	left:393px;
	top:64px;
	width:305px;
	height:22px;
	z-index:4;
	background-color: #FFFFFF;
	font-style: italic;
	line-height: normal;
	font-weight: 700;
	color: #F00;
}
#dispRes {
	position:absolute;
	left:4px;
	top:2px;
	width:285px;
	height:24px;
	z-index:6;
	background-color: #FFF;
	font-size: medium;
	color: #E47000;
}
#appContent #stds {
	font-size: medium;
}
#nav {
	position:absolute;
	left:64px;
	top:740px;
	width:320px;
	height:42px;
	z-index:5;
	color: #E47000;
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
        <td width="27%" class="menuHovered" id="tdHome">SEARCH  </td>
      <a href="pwChange.php"><td width="27%" id="tdPword"> <a href="pwChange.php">PASSWORD </a></td></a> 
      <td width="27%" id="tdApp">  APPLICANTS </td>
      <td width="27%" id="tdEn">  ENROLLED </td>
    </tr>
  </table>
 </div>
</div>
<div id="appContent">
    <div id="dispRes"><?php echo 'Displaying Last Few Result(s)'; ?></div>
  <table width="1065" border="0"  align="center" cellspacing="5" cellpadding="5" id="stds">
  <caption class="cap">
      <strong>APPLICANTS LIST</strong>
    </caption>
    <tr bgcolor="#E47000">
      <th width="282">full Name</th>
      <th width="116">Gender</th>
      <th width="198">Class Applying To</th>
      <th width="248">Sponsor's Name</th>
      <th width="141">Sponsor's Phone</th>
    </tr>
      <?php
       $result=$db->getApplicants();
       
        if(mysql_num_rows($result) > 0)
        {
           while($row= mysql_fetch_array($result))
           {
               $fullname=$row[1].' '.$row[3];
               $RegNo=$row[0];
               $sex=$row[4];
               $pc=$row[6];
               $cp=$row[7];
               $sn=$row[8];
               $sp=$row[9];
            echo
            '<tr>
              <td><a href="applicantInfo.php?Reg_No='.$RegNo.'">'.$fullname.'</a></td>
              <td>'.$sex.'</td>  
              <td>'.$cp.'</td>
              <td>'.$sn.'</td>    
              <td>'.$sp.'</td>    
            </tr>';
           }
        }
        else
        {
            echo '
                <tr bgcolor="#E47000">
                    <th colspan="6">Sorry, No Record Found</th>
                </tr>  
                ';
        }
      ?>  
  </table>
</div>
</div>
    <a name="enContent"></a>
<div id="enContent">
  <div id="dispRes"><?php echo 'Displaying Last Few Result(s)' ?></div>
  <table width="1068" border="0" align="center" cellpadding="5" cellspacing="5" id="stds">
    <caption class="cap">
      <strong>Enrolled Students</strong>
    </caption>
    <tr bgcolor="#E47000" class="odd">
      <th width="257">full Name</th>
      <th width="125">Sex</th>
      <th width="231">Class Applying To</th>
      <th width="228">Sponsor's Name</th>
      <th width="147">Sponsor's Phone</th>
    </tr>
       <?php
       $result=$db->getEnrolledStudents();

        if(mysql_num_rows($result) > 0)
        {
           while($row= mysql_fetch_array($result))
           {
               $fullname=$row[1].' '.$row[3];
               $RegNo=$row[0];
               $sex=$row[4];
               $school=$row[6];
               $sn=$row[7];
               $sp=$row[8];
            echo
            '<tr>
              <td><a href="applicantInfo.php?Reg_No='.$RegNo.'">'.$fullname.'</a></td>
              <td>'.$sex.'</td>
              <td>'.$school.'</td>
              <td>'.$sn.'</td>
              <td>'.$sp.'</td>
            </tr>';
           }
        }
        else
        {
            echo '
                <tr bgcolor="#E47000">
                    <th colspan="6">Sorry, No Record Found</th>
                </tr>  
                ';
        }
      ?> 
             			
  </table>
</div>
</div>


<div id="searchContent">
<div id="apDiv1">Search Students</div>
<div id="apDiv3">
    <?php
        if($isErr)
        {
            echo '<div id="apDiv8">NO STUDENT FOUND</div>';
        }
    ?>
<div id="apDiv4">
    <form id="byReg" action="AdminHome.php" method="POST">
Search by RegNo:
  <input name="txtRegNo" type="text" id="txtRegNo" placeholder="E.g 01" size="10" /> 
  <input name="byReg-Submit" type="submit" class="button" id="btnSend" value="Submit" />
</form>
 </div>
 <div id="apDiv5">
<form id="bySurname" action="AdminHome.php" method="POST">
Search by Surname:
  <input name="txtSurname" type="text" id="txtRegNo"  size="25" /> 
  <input name="bySurname-Submit" type="submit" class="button" id="btnSend" value="Submit" />
</form>
 </div>
 <div id="apDiv6">
<form id="byCategory" action="AdminHome.php" method="POST">
Search by Category:
  <select name="txtCategory">
     <option value="Primary">Primary</option>
     <option value="Secondary">Secondary</option>
   </select>
  <input name="byCategory-Submit" type="submit" class="button" id="btnSend" value="Submit" />
</form>
 </div>
 <div id="apDiv7">
<form id="byClass" action="AdminHome.php" method="POST">
Search by Class:
   <select name="txtClass">
     <?php
        $result=$db->getAllClasses();
        while($row=  mysql_fetch_array($result))
        {
            echo'<option value="'.$row[0].'">'.$row[0].'</option>';
        }
     ?>
   </select>
  <input name="byClass-Submit" type="submit" class="button" id="btnSend" value="Submit" />
</form>
 </div>
</div>
  
</div>

<script>
$(document).ready(function()
	 	{
			$('#stds tr:even').addClass('odd');
			$('#stds tr:odd').addClass('even');
			
			$('#appContent').hide();
			$('#enContent').hide();
			$('#pwContent').hide();
			
			$('#stds tr').mouseover(function()
			{
				$(this).addClass('mHover');
			});
			$('#stds tr').mouseout(function()
			{
				$(this).removeClass('mHover');
			});
			
			$('#tdHome').click(function()
			 {
             		$(this).addClass('menuHovered');
					$('#tdPword').removeClass('menuHovered');
					$('#tdApp').removeClass('menuHovered');
					$('#tdEn').removeClass('menuHovered');
					
					$('#appContent').fadeOut('slow');
					$('#enContent').fadeOut('slow');
					$('#pwContent').fadeOut('slow');
					$('#searchContent').fadeIn('slow');
			 });
			 /*$('#tdPword').click(function()
			 {
                    $(this).addClass('menuHovered');
					$('#tdHome').removeClass('menuHovered');
					$('#tdApp').removeClass('menuHovered');
					$('#tdEn').removeClass('menuHovered');
					
					$('#searchContent').fadeOut('slow');
					$('#enContent').fadeOut('slow');
					$('#appContent').fadeOut('slow');
					$('#pwContent').fadeIn('slow');                                    
			 });*/
			 $('#tdApp').click(function()
			 {
             		$(this).addClass('menuHovered');
					$('#tdPword').removeClass('menuHovered');
					$('#tdHome').removeClass('menuHovered');
					$('#tdEn').removeClass('menuHovered');
					
					$('#searchContent').fadeOut('slow');
					$('#enContent').fadeOut('slow');
					$('#pwContent').fadeOut('slow');
					$('#appContent').fadeIn('slow');
			 });	
			 $('#tdEn').click(function()
			 {
             		$(this).addClass('menuHovered');
					$('#tdPword').removeClass('menuHovered');
					$('#tdApp').removeClass('menuHovered');
					$('#tdHome').removeClass('menuHovered');
					
					$('#searchContent').fadeOut('slow');
					$('#pwContent').fadeOut('slow');
					$('#appContent').fadeOut('slow');
					$('#enContent').fadeIn('slow');
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