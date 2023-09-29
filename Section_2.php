<?php 
require_once("Include/db.php");
$db=new DataManager();
      session_start();
    if (array_key_exists("Category", $_SESSION))
    {
        $Category=$_SESSION["Category"];
            if(array_key_exists("Reg_Edu", $_SESSION))
            {
                $isValid=false;

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $RegNo=$_SESSION["Reg_Edu"];
                    $Ps=$_POST["txtPschool"];
                    $Ls=$_POST["txtLschool"];
                    $Lc=$_POST["txtLclass"];
                    $Pc=$_POST["txtPclass"];
                    $Cat=$_SESSION["Category"];

                    if(empty($Ps))
                        $psV=true;
                    if(empty($Ls))
                        $lsV=true;
                    
                    if($Ps=="" || $Ls=="" || $Lc=="" || $Pc=="")
                    {
                        $isValid=true;
                        $msg="Please Fill All Fields Correctly";
                    }
                    else
                    {
                        $isValid=false;
                        $db->saveEducational_Info($RegNo, $Ps, $Ls, $Pc,$Lc, $Cat);
                        $_SESSION["RegNo_Fam"]=$RegNo;
                        header('Location: Section_3.php' ); 
                    }                 
                }
            }
            else
            {
                header('Location: Section_1.php' );
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
        <meta http-equiv="Page-Enter" content="RevealTrans(Duration=3,Transition=22)">
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
    <div id="Schoolheader"><?php echo $Category ?> School Form </div>
    
    <div id="form1">
    <form id="appForm" action="Section_2.php" method="post">
    <div id="section1">Section 2 of 4</div>
    <div id="formHeader1">ACADEMIC DETAILS</div>
    <div id="formContent1">
    <?php
        if($isValid)
        {
            echo'    <p><strong><font color="#FF0000">';echo $msg; echo '</font></strong></p>';
        }
        ?>
      <table width="761" border="0" cellspacing="5" cellpadding="5" align="center">
        <tr>
          <td width="251" align="right">Primary School Attended :</td>
          <td width="300" align="left">
          <input name="txtPschool" type="text" id="txtPschool" size="50" value="<?php echo $_POST['txtPschool']; ?>" placeholder="Primary School or Nill of None"></td>
          <td width="160" align="left">
              <?php
              if($psV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>    
        </tr>
        <tr>
          <td align="right">Last School Attended :</td>
          <td align="left">
          <input name="txtLschool" type="text" id="txtLschool" size="50" value="<?php echo $_POST['txtLschool']; ?>" placeholder="Previous School or Nill of None"></td>
          <td align="left">
              <?php
              if($lsV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Previous Class :</td>
          <td align="left">
              <select name="txtLclass" id="txtLclass">
                  <?php
                    $result=$db->getAllClasses();
                    while($row=  mysql_fetch_array($result))
                    {
                        echo'<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
                  ?>
              </select>
          </td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Class Seeking Admission To :</td>
          <td align="left">
            <select name="txtPclass" id="txtPclass">
                <?php
                    $result=$db->getClasses($Category);
                    while($row=  mysql_fetch_array($result))
                    {
                        echo'<option value="'.$row[0].'">'.$row[0].'</option>';
                    }
                  ?>
            </select>
          </td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input type="Submit"  class="button" id="p1" value="NEXT"/>
          <td align="left">          
        </tr>
      </table>
    </div>
  
    </form>
      </div>	
    </body>
</html>
