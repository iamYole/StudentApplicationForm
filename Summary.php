<?php 
include_once ("Include/db.php");
$db=new DataManager();
      session_start();
    if (array_key_exists("Category", $_SESSION))
    {
        $Category=$_SESSION["Category"];
            if (array_key_exists("Summary", $_SESSION))
            {      
                $RegNo=$_SESSION["Summary"];
                $P_Details=$db->p_info($RegNo);
                $E_Details=$db->e_info($RegNo);
                $Image_File=$db->getImage($RegNo);
            }
            else
            {
                header('Location: Section_4.php' );
            }
     }
    else
    {
        header('Location: index.php' );
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Summary</title>
        <link rel="stylesheet" href="Scripts/Site.css" type="text/css">
    <style type="text/css">
    #p_Details {
	position:absolute;
	left:57px;
	top:229px;
	width:985px;
	height:428px;
	z-index:2;
	background-image: url(Scripts/Images/crest.png);
}
    #IMG {
	position:absolute;
	left:669px;
	top:4px;
	width:260px;
	height:230px;
	z-index:3;
	border: thick outset #CCC;
}
    #slipContect {
	position:absolute;
	left:23px;
	top:75px;
	width:943px;
	height:263px;
	z-index:4;
	background-color: #FFFFFF;
	line-height: normal;
}
    #aSlip {
	position:absolute;
	left:272px;
	top:4px;
	width:413px;
	height:57px;
	z-index:5;
	line-height: 50px;
	font-weight: 900;
	color: #F00;
	background-color: #000;
	font-size: large;
}
    #apDiv4 {
	position:absolute;
	left:425px;
	top:151px;
	width:376px;
	height:61px;
	z-index:6;
}
    #apDiv1 {
	position:absolute;
	left:436px;
	top:287px;
	width:83px;
	height:34px;
	z-index:3;
}
    </style>
    </head>
    <body>
    <div id="consoleLogoSum">
<img src="Scripts/Images/crest.png" width="180" height="152" align="top" />
<h1>&nbsp;</h1>
    </div>
    <div id="p_Details">
    
    <div id="aSlip">AKNOWLDEGMENT SLIP</div>
    <div id="slipContect">
    <div id="IMG">        
        <?php
                $Image_File=$db->getImage($RegNo);
                $row=  mysql_fetch_array($Image_File);
                $path='Include/ImgDB/'.$row['IMG_NAME'];
              echo '<img src="'.$path.'" width="260" height="230"/>';
          ?>
    </div>    
      <table width="669" border="0" align="left" cellpadding="5" cellspacing="5">
        <tr>
          <td width="310" align="right" valign="middle" class="td1">Registration No  :</td>
          
          <td width="338" valign="middle" class="td2">
          <?php
                $P_Details=$db->p_info($RegNo);
              $row=  mysql_fetch_array($P_Details);
              echo 'REG0'.$row[0];
          ?>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" class="td1">Student Name :</td>
          <td valign="middle" class="td2">
          <?php
                $P_Details=$db->p_info($RegNo);
                
                  $row=  mysql_fetch_array($P_Details); 

                  $FullName=$row[1].' '.$row[2].' '.$row[3];
                  echo $FullName;
          ?>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" class="td1">Gender :</td>
          <td valign="middle" class="td2">
           <?php
                $P_Details=$db->p_info($RegNo);
              $row=  mysql_fetch_array($P_Details);
              echo $row[4];
          ?>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" class="td1">Category:</td>
          <td valign="middle" class="td2">
          <?php
                $E_Details=$db->e_info($RegNo);
              $row=  mysql_fetch_array($E_Details);
              echo $row[6].' School Category';
          ?>
          </td>
        </tr>
        <tr>
          <td align="right" valign="middle" class="td1">Class Seeking Admission Into :</td>
          <td valign="middle" class="td2">
          <?php
                $P_Details=$db->e_info($RegNo);
              $row=  mysql_fetch_array($P_Details);
              echo $row[5];
          ?>
          </td>
        </tr>
      </table>
      <div id="apDiv1">
          <input name="btnPrint" type="submit" class="button" id="btnPrint" value="Print" onclick="window.print()">
    </div>
    </div>    
    </div>
    
    
</body>
</html>
