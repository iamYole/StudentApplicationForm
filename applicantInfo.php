<?php
require_once("Include/db.php");
$db=new DataManager();
session_start();
    if (array_key_exists("User", $_SESSION))
    {        
//        //$getReg=$_
        if( array_key_exists("Reg_No", $_REQUEST) || array_Key_exists("Reg_No",$_SESSION))
        {
            $regNo=$_SESSION['Reg_No'];
            if(!(isset($regNo)))
            {
                $regNo=$_REQUEST['Reg_No'];
            }
//            else
//            {
//                header('Location: AdminHome.php' );
//            }
            
            
                if(!empty($_POST['btnGrant']))
                {
                    $today = date("Y-m-j");
                    $db->grantAdmission($regNo,$today);
                    $msg="Operation Sucessesful";
                }
                if(!empty($_POST['btnRevoke']))
                {
                    $db->revokeAdmission($regNo);
                    $msg="Operation Sucessesful";
                }            
        }        
        else
        {
            header('Location: AdminHome.php' );
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
<title>Applicant</title>
<link rel="stylesheet" href="Scripts/Site.css" type="text/css">
<script src="Scripts/jquery-1.4.1.min.js"></script>
<style type="text/css">
#apDiv1 {
	position:absolute;
	left:1px;
	top:554px;
	width:383px;
	height:71px;
	z-index:3;
	background-color: #FFFFFF;
}
#form_preview1 {
	font-size: medium;
}
#apDiv2 {
	position:absolute;
	left:466px;
	top:287px;
	width:364px;
	height:21px;
	z-index:3;
	font-size: medium;
	color: #00F;
}
</style>
</head>

<body bgcolor="#ECCD8D">
<div id="consoleLogo">
<img src="Scripts/Images/crest.png" width="180" height="120" align="left" />
<h2>APPLICANT INFO</h2>
</div>
<div id="menuBar">
<div id="menuItem">
  <table width="99%" border="0" cellspacing="5" cellpadding="5">
    <tr align="center">
      <td width="27%" id="tdHome"><a href="AdminHome.php">ADMIN HOME  </a></td>
      <td width="27%" id="tdPword">
         <?php
            $result=$db->ultimateSearch($regNo);
            $row=mysql_fetch_array($result);
             if($row['AdmissionStatus']=="PENDING")
             {                
                 echo'
              <form id="actionForm" method="post" action="applicantInfo.php?Reg_No='.$regNo.'">
                <input name="btnGrant" type="submit" class="button2" id="btnGrant" value="GRANT ADMISSION">
              </form>';
             }
             else if($row['AdmissionStatus']=="ADMITTED")
             {                 
                 echo'
               <form id="actionForm" method="post" action="applicantInfo.php?Reg_No='.$regNo.'">
                 <input name="btnRevoke" type="submit" class="button2" id="btnRevoke" value="REVOKE ADMISSION">
               </form>';
             }
         ?>
      </td>
      </tr>
  </table>
 </div>
</div>
<div id="form_preview1">
    <form id="appForm" action="Section_1.php" method="post">
    <div id="formHeader1">PERSONAL DETAILS</div>
    
    <div id="formC_preview_1">        
  <table width="564" border="0" align="left" cellpadding="5" cellspacing="5">
          <?php
          $result=$db->ultimateSearch($regNo);
          $row=mysql_fetch_array($result);
          echo'
        <tr>
          <td width="179" align="right">Surname :</td>
          <td width="252" align="left">'.$row[1].' </td>
        </tr>
        <tr>
          <td align="right">Middle Name :</td>
          <td align="left">'.$row['MiddleName'].'</td>
        </tr>
        <tr>
          <td align="right">First Name :</td>
          <td align="left">'.$row['FirstName'].'</td>
        </tr>
        <tr>
          <td align="right">Sex :</td>
          <td align="left">'.$row['Gender'].'</td>
        </tr>
        <tr>
          <td align="right" valign="top">Address :</td>
          <td align="left">'.$row['Address'].'</td>
        </tr>
        <tr>
          <td align="right">Phone Number :</td>
          <td align="left">'.$row['Telephone'].'</td>
        </tr>
        <tr>
          <td align="right">Date Of Birth :</td>
          <td align="left">'.$row['DOB'].'</td>
        </tr>
        <tr>
          <td align="right">Place Of Birth :</td>
          <td align="left">'.$row['PlaceOfBirth'].'</td>
        </tr>
        <tr>
          <td align="right">State Of Origin :</td>
          <td align="left">'.$row['StateOfOrigin'].'</td>
        </tr>
        <tr>
          <td align="right">Nationality :</td>
          <td align="left">'.$row['Nationality'].'</td>
        </tr>
        <tr>
          <td align="right">Religion :</td>
          <td align="left">'.$row['Religion'].'</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input type="btn" class="button" id="toAca" value="NEXT" /></td>
        </tr>
        ';?>
      </table>
      <div id="apDiv1">
      <table width="352" border="0" align="left" cellpadding="5" cellspacing="5">
  <?php
          $result=$db->ultimateSearch($regNo);
          $row=mysql_fetch_array($result);
          if($row['AdmissionStatus']=="PENDING")
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Applied</td>
                    <td>'.$row['DateApplied'].'</td>
              </tr>';          
          }
          else
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Admitted</td>
                    <td>'.$row['DateAdmitted'].'</td>
              </tr>'; 
          }
?>
</table>
</div>
      <div id="IMGPRE">        
        <?php
                $Image_File=$db->getImage($regNo);
                $row=  mysql_fetch_array($Image_File);
                $path='Include/ImgDB/'.$row['IMG_NAME'];
              echo '<img src="'.$path.'" width="260" height="230"/>';
          ?>
    </div>
    </div> 
    </form>
    </div>
    <div id="form_preview2">
    <form id="appForm" action="Section_2.php" method="post">
    <div id="formHeader1">ACADEMIC DETAILS</div>
    <div id="formContent1">
          <table width="697" border="0" cellspacing="5" cellpadding="5" align="left">
      <?php
          $result=$db->ultimateSearch($regNo);
          $row=mysql_fetch_array($result);      
      echo'
        <tr>
          <td width="263" align="right">Primary School Attended :</td>
          <td width="344" align="left">'.$row['PrimarySchool'].'</td>    
        </tr>
        <tr>
          <td align="right">Last School Attended :</td>
          <td align="left">'.$row['LastSchool'].'</td>
        </tr>
        <tr>
          <td align="right">Previous Class :</td>
          <td align="left">'.$row['LastClass'].'</td>
        </tr>
        <tr>
          <td align="right">Class Seeking Admission To :</td>
          <td align="left">'.$row['PresentClass'].'</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input type="Button"  class="button" id="p1" value="BACK"/><input type="button"  class="button" id="toFam" value="NEXT"/>
        </tr>
        ';?>
      </table>
      <div id="apDiv1">
      <table width="352" border="0" align="left" cellpadding="5" cellspacing="5">
 <?php
          $result=$db->ultimateSearch($regNo);
          $row=mysql_fetch_array($result);
          if($row['AdmissionStatus']=="PENDING")
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Applied</td>
                    <td>'.$row['DateApplied'].'</td>
              </tr>';          
          }
          else
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Admitted</td>
                    <td>'.$row['DateAdmitted'].'</td>
              </tr>'; 
          }
?>
</table>
</div>
    </div>
  
    </form>
      </div>
      <div id="form_preview3">
    <form id="appForm" action="Section_3.php" method="post">
    <div id="formHeader1">FAMILY DETAILS</div>
   <div id="formContent1">      
      <table width="652" border="0" align="left" cellpadding="5" cellspacing="5">
      <?php
      $result=$db->ultimateSearch($regNo);
      $row=mysql_fetch_array($result);
      echo'
        <tr>
          <td width="179" align="right">Father\'s Name :</td>
          <td width="252" align="left">'.$row['FattherName'].'</td>    
        </tr>
        <tr>
          <td align="right">Father\'s Phone No.:</td>
          <td align="left">'.$row['FPhone'].'</td>
        </tr>
        <tr>
          <td align="right">Father\'s Occupation :</td>
          <td align="left">'.$row['FJob'].'</td>
        </tr>
        <tr>
          <td align="right">Mother\'s Name:</td>
          <td align="left">'.$row['Mothername'].'</td>
        </tr>
        <tr>
          <td align="right">Mother\'s Phone No. :</td>
          <td align="left">'.$row['MPhone'].'</td>
        </tr>
        <tr>
          <td align="right">Mother\'s Occupation :</td>
          <td align="left">'.$row['MJob'].'</td>
        </tr>
        <tr>
          <td align="right">Sponsor\'s Name :</td>
          <td align="left">'.$row['SponsorName'].'</td>
        </tr>
        <tr>
          <td align="right">Sponsor\'s Phone No.:</td>
          <td align="left">'.$row['SPhone'].'</td>
        </tr>
        <tr>
          <td align="right">Family Doctor :</td>
          <td align="left">'.$row['Doctor'].'</td>
        </tr>
        <tr>
          <td align="right">Doctor\'s Phone No.:</td>
          <td align="left">'.$row['Phone'].'</td>
        </tr>
        <tr>
          <td align="right">Any Usual Ailment?</td>
          <td align="left">'.$row['Illness'].'</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input name="p2" type="button" class="button" id="p2" value="BACK"/>             
        </tr>
        ';?>
      </table>
      <div id="apDiv1">
      <table width="352" border="0" align="left" cellpadding="5" cellspacing="5">
          <?php
          $result=$db->ultimateSearch($regNo);
          $row=mysql_fetch_array($result);
          if($row['AdmissionStatus']=="PENDING")
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Applied</td>
                    <td>'.$row['DateApplied'].'</td>
              </tr>';          
          }
          else
          {
              echo'
                  <tr>
                    <td width="149">Admission Status</td>
                    <td width="137">'.$row['AdmissionStatus'].'</td>
                  </tr>
                  <tr>
                    <td>Date Admitted</td>
                    <td>'.$row['DateAdmitted'].'</td>
              </tr>'; 
          }
?>
      </table>
</div>
      </div>
		</form>
        </div>
    
    <div id="apDiv2"><?echo $msg;?></div>
    <script>
$(document).ready(function()
	 	{		
			
			$('#form_preview3').hide();
			$('#form_preview2').hide();
						
			
			$('#p2').click(function()
			 {
             		$('#form_preview3').fadeOut('slow');
					
					$('#form_preview2').fadeIn('slow');
			 });
			 $('#p1').click(function()
			 {
             		$('#form_preview2').fadeOut('slow');
					
					$('#form_preview1').fadeIn('slow');		
			 });
			 $('#toAca').click(function()
			 {
             		$('#form_preview1').fadeOut('slow');
					
					$('#form_preview2').fadeIn('slow');
			 });	
			 $('#toFam').click(function()
			 {
             		$('#form_preview2').fadeOut('slow');
					
					$('#form_preview3').fadeIn('slow');
			 }); 		 
			 
		});
</script>
</body>
</html>