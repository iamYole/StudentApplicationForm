<?php 
include_once ("Include/db.php");
$db=new DataManager();
      session_start();
    if (array_key_exists("Category", $_SESSION))
    {
        $Category=$_SESSION["Category"];
            if (array_key_exists("RegNo_Fam", $_SESSION))
            {                

                $surname=false;

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $RegNo=$_SESSION["RegNo_Fam"];
                    $Fn=$_POST["txtFN"];
                    $Fpn=$_POST["txtFPN"];
                    $Fj=$_POST["txtFO"];
                    $Mn=$_POST["txtMN"];
                    $Mpn=$_POST["txtMPN"];
                    $Mj=$_POST["txtMO"];
                    $Sn=$_POST["txtSN"];
                    $Spn=$_POST["txtSPN"];
                    $Dc=$_POST["txtDc"];
                    $Dp=$_POST["txtDPO"];
                    $Ill=$_POST["txtSickness"];  
                    
                    
                    if(empty($Fn))
                        $fnV=true;
                    if(empty($Fpn) || !is_numeric($Fpn))
                        $fpnV=true;
                    if(empty($Fj))
                        $fjV=true;
                    if(empty($Mn))
                        $mnV=true;
                    if(empty($Mj))
                        $mjV=true;
                    if(empty($Mpn) || !is_numeric($Mpn))
                        $mpnV=true;
                    if(empty($Sn))
                        $snV=true;
                    if(empty($Spn) || !is_numeric($Fpn))
                        $spnV=true;
                    if(empty($Dc))
                        $dcV=true;
                    if(empty($Dp)  || !is_numeric($Dp))
                        $dpV=true;

                    if($Fn=="" || $Fpn=="" || $Fj=="" || $Mn=="" || $Mpn=="" || $Mj=="" || $Sn==""
                            || $Spn==""  ||  $Dc=="" || $Dp=="")
                    {
                        $isValid=true;
                    }
                    else
                    {
                        if(is_numeric($Fpn) && is_numeric($Mpn) && is_numeric($Dp))
                        {
                            $isValid=false ;
                            $db->saveFamily_Info($RegNo, $Fn, $Fpn, $Fj, $Mn, $Mpn, $Mj, $Sn, $Spn, $Dc, $Dp, $Ill);
                            $_SESSION["RegNo_Img"]=$RegNo;
                            header('Location: Section_4.php' ); 
                        }
                        else
                        {
                            $isValid=true;
                        }
                    }                 
                }
            }
            else
            {
                header('Location: Section_2.php' );
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
        <meta http-equiv="Page-Enter" content="RevealTrans(Duration=3,Transition=22)">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Application Form</title>
                <link rel="stylesheet" href="Scripts/Site.css" type="text/css">
    <style type="text/css">
    #form1 #appForm #formContent1 table {
	font-size: medium;
}
    </style>
    </head>
<body>
        <div id="img">
    <img src="Scripts/Images/logo.png" width="1060" height="191" alt="Logo">
    </div>
    <div id="Schoolheader"><?php echo $Category ?> School Form</div>
    
    
    <div id="form1">
    <form id="appForm" action="Section_3.php" method="post">
    <div id="section1">Section 3 of 4</div>
    <div id="formHeader1">FAMILY DETAILS</div>
   <div id="formContent1">   
    <?php
        if($isValid)
        {
            echo'    <p><strong><font color="#FF0000">Please Fill In All Fields Correctly</font></strong></p>';
        }
        ?>
      <table width="723" border="0" cellspacing="5" cellpadding="5" align="center">
        <tr>
          <td width="220" align="right">Father's Name :</td>
          <td width="202" align="left">
          <input name="txtFN" type="text" id="txtFN" size="30" value="<?php echo $_POST['txtFN'];?>" placeholder="Father's Full Name"></td>
          <td width="251" align="left">
              <?php
              if($fnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>    
        </tr>
        <tr>
          <td align="right">Father's Phone No.:</td>
          <td align="left"><input name="txtFPN" type="text" id="txtFPN" size="30" value="<?php echo $_POST['txtFPN'];?>" placeholder="Father's Phone No."></td>
          <td align="left">
              <?php
              if($fpnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Father's Occupation :</td>
          <td align="left"><input name="txtFO" type="text" id="txtFO" size="30" value="<?php echo $_POST['txtFO']; ?>" placeholder="Father's Occupation"></td>
          <td align="left">
              <?php
              if($fjV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Mother's Name:</td>
          <td align="left">
            <input name="txtMN" type="text" id="txtMN" size="30" value="<?php echo $_POST['txtMN'];?>" placeholder="Mother's Full Name">
          </label></td>
          <td align="left">
              <?php
              if($mnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Mother's Phone No. :</td>
          <td align="left"><input name="txtMPN" type="text" id="txtMPN" size="30" value="<?php echo $_POST['txtMPN'];?>" placeholder="Mother's Phone No."></td>
          <td align="left">
              <?php
              if($mpnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Mother's Occupation :</td>
          <td align="left"><input name="txtMO" type="text" id="txtMO" size="30" value="<?php echo $_POST['txtMO'];?>" placeholder="Mother's Occupation"></td>
          <td align="left">
              <?php
              if($mjV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Sponsor's Name :</td>
          <td align="left"><input name="txtSN" type="text" id="txtSN" size="30" value="<?php echo $_POST['txtSN'];?>" placeholder="Sponsors Full Name"></td>
          <td align="left">
              <?php
              if($snV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Sponsor's Phone No.:</td>
          <td align="left"><input name="txtSPN" type="text" id="txtSPN" size="30" value="<?php echo $_POST['txtSPN'];?>" placeholder="Sponsors Phone No."></td>
          <td align="left">
              <?php
              if($spnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Family Doctor :</td>
          <td align="left"><input name="txtDc" type="text" id="txtDc" size="30" value="<?php echo $_POST['txtDc'];?>" placeholder="Personal Doctor's Name"></td>
          <td align="left">
              <?php
              if($dcV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Doctor's Phone No.:</td>
          <td align="left"><input name="txtDPO" type="text" id="txtDPO" size="30" value="<?php echo $_POST['txtDPO'];?>" placeholder="Personal Doctor's No."></td>
          <td align="left">
              <?php
              if($dpV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Any Usual Ailment?</td>
          <td align="left">
          <textarea name="txtSickness" id="txtSickness" cols="30" rows="5" placeholder="Any Ailment or Nill if None"><?php echo $_POST['txtSickness'];?></textarea></td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input type="Submit" class="button" id="p2" value="Next"/>             
          <td align="left">          
        </tr>
      </table>
  </div>
		</form>
        </div>
    </body>
</html>
