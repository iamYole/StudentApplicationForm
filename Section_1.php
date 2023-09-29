<?php 
require_once("Include/db.php");
$db=new DataManager();
session_start();
    if (array_key_exists("Category", $_SESSION))
    {
        $Category=$_SESSION["Category"];
        
        $isValid=false;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $Sn=$_POST["txtSurname"];
            $Mn=$_POST["txtMiddleName"];
            $Fn=$_POST["txtFirstName"];
            $Sex=$_POST["txtSex"];
            $Addy=$_POST["txtAddress"];
            $Phone=$_POST["txtPhone"];
            $day=$_POST["txtDate"];
            $month=$_POST["txtMonth"];
            $yr=$_POST["txtYear"];            
            $POB=$_POST["txtPOB"];
            $SOO=$_POST["txtSOO"];
            $Nat=$_POST["txtNationality"];
            $Rel=$_POST["txtReligion"];
            
            if(empty($Sn))
                $snV=true;
            if(empty($Mn))
                $mnV=true;
            if(empty($Fn))
                $fnV=true;
            if(empty($Sex))
                $sexV=true;
            if(empty($Phone)  || !is_numeric($Phone))
                $foneV=true;
            if(empty($Addy))
                $addyV=true;
            if(empty($POB))
                $pobV=true;
            if(empty($Nat))
                $natV=true;
            if($Rel=="Select")
                $relV=true;
            if($SOO=="Select")
                $sooV=true;
            if($day=="Date"  || $month== "Month" || $yr== "Year")
                $dobV=true;
            
            if($day== "Date" || $month== "Month" || $yr== "Year" || $SOO=="Select" || $Rel=="Select")
            {
                $DOB="";
                $SOO="";
                $Rel="";
                $isValid=true;
            }            
            else
            {
                $DOB=$yr.'-'.$month.'-'.$day;
                if($Sn=="" || $Mn=="" || $Fn=="" || $Sex=="" || $Addy=="" || $POB=="" || $DOB=="" ||
                        $SOO=="" || $Nat=="" || $Rel=="")

                {
                    $isValid=true;
                }
                else
                {
                    if(is_numeric($Phone))
                    {
                        $isValid=false;
                        $dap=date('Y-m-j');
                        $db->savePersonal_Info($Sn, $Mn, $Fn, $Sex, $Phone, $Addy, $DOB, $POB, $SOO, $Nat, $Rel,$dap);
                        $RegNo=mysql_insert_id();
                        $_SESSION['Reg_Edu']=$RegNo;
                        header('Location: Section_2.php' );   
                    }
                    else
                    {
                        $isValid=true;
                        $foneV=true;
                    }
                }
            }                                    
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
        <link rel="stylesheet" href="Scripts/Site.css" type="text/css">
        <script src="Scripts/jquery-1.4.1.min.js">           
        </script>
        <title>Application Form </title>
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
    <form id="appForm" action="Section_1.php" method="post">
    <div id="section1">Section 1 of 4</div>
    <div id="formHeader1">PERSONAL DETAILS</div>
    
    <div id="formContent1">
        <?php
        if($isValid)
        {
            echo'    <p><strong><font color="#FF0000">Please Fill In All Fields Correctly</font></strong></p>';            
        }
        ?>
      <table width="584" border="0" align="center" cellpadding="5" cellspacing="5">
        <tr>
          <td width="161" align="right">Surname :</td>
          <td width="232" align="left"><label for="txtPschool"></label>              
           <input name="txtSurname" type="text" id="txtSurname" value="<?php echo $_POST['txtSurname']; ?>" size="30" placeholder="Surname"></td>
          <td width="232" align="left">
              <?php
              if($snV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Middle Name :</td>
          <td align="left"><input name="txtMiddleName" type="text" id="txtMiddleName" size="30" value="<?php echo $_POST['txtMiddleName']; ?>" placeholder="Other Name(s)"></td>
          <td align="left">
              <?php
              if($mnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">First Name :</td>
          <td align="left"><input name="txtFirstName" type="text" id="txtFirstName" size="30" value="<?php echo $_POST['txtFirstName']; ?>" placeholder="Firstname"></td>
          <td align="left">
              <?php
              if($fnV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Sex :</td>
          <td align="left"><label for="txtSex"></label>
            <select name="txtSex" id="txtSex">
              <option value="Male" <?php if($_POST['txtSex'] == "Male") { echo "selected=\"selected\""; } ?>>Male</option>
              <option value="Female" <?php if($_POST['txtSex'] == "Female") { echo "selected=\"selected\""; } ?>>Female</option>
          </select></td>
          <td align="left">
              <?php
              if($sexV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right" valign="top">Address :</td>
          <td align="left"><label for="txtAddress"></label>
          <textarea name="txtAddress" id="txtAddress" cols="30" rows="5" placeholder="Contact Address"><?php echo $_POST['txtAddress']; ?></textarea></td>
          <td align="left">
              <?php
              if($addyV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Phone Number :</td>
          <td align="left"><input name="txtPhone" type="text" id="txtPhone" size="30" Value="<?php echo $_POST['txtPhone']; ?>" placeholder="08000000000"></td>
          <td align="left">
              <?php
              if($foneV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Date Of Birth :</td>
          <td align="left">
            <select name="txtDate" id="txtDate">
            <option value="Date" <?php if($_POST['txtDate'] == "Date") { echo "selected=\"selected\""; } ?> >Date</option>
            <option value="1" <?php if($_POST['txtDate'] == "1") { echo "selected=\"selected\""; } ?> >1</option>
            <option value="2" <?php if($_POST['txtDate'] == "2") { echo "selected=\"selected\""; } ?> >2</option>
            <option value="3" <?php if($_POST['txtDate'] == "3") { echo "selected=\"selected\""; } ?> >3</option>
            <option value="4" <?php if($_POST['txtDate'] == "4") { echo "selected=\"selected\""; } ?> >4</option>
            <option value="5" <?php if($_POST['txtDate'] == "5") { echo "selected=\"selected\""; } ?> >5</option>
            <option value="6" <?php if($_POST['txtDate'] == "6") { echo "selected=\"selected\""; } ?> >6</option>
            <option value="7" <?php if($_POST['txtDate'] == "7") { echo "selected=\"selected\""; } ?> >7</option>
            <option value="8" <?php if($_POST['txtDate'] == "8") { echo "selected=\"selected\""; } ?> >8</option>
            <option value="9" <?php if($_POST['txtDate'] == "9") { echo "selected=\"selected\""; } ?> >9</option>
            <option value="10" <?php if($_POST['txtDate'] == "10") { echo "selected=\"selected\""; } ?> >10</option>
            <option value="11" <?php if($_POST['txtDate'] == "11") { echo "selected=\"selected\""; } ?> >11</option>
            <option value="12" <?php if($_POST['txtDate'] == "12") { echo "selected=\"selected\""; } ?>>12</option>
            <option value="13" <?php if($_POST['txtDate'] == "13") { echo "selected=\"selected\""; } ?>>13</option>
            <option value="14" <?php if($_POST['txtDate'] == "14") { echo "selected=\"selected\""; } ?>>14</option>
            <option value="15" <?php if($_POST['txtDate'] == "15") { echo "selected=\"selected\""; } ?>>15</option>
            <option value="16" <?php if($_POST['txtDate'] == "16") { echo "selected=\"selected\""; } ?>>16</option>
            <option value="17" <?php if($_POST['txtDate'] == "17") { echo "selected=\"selected\""; } ?>>17</option>
            <option value="18" <?php if($_POST['txtDate'] == "18") { echo "selected=\"selected\""; } ?>>18</option>
            <option value="19" <?php if($_POST['txtDate'] == "19") { echo "selected=\"selected\""; } ?>>19</option>
            <option value="20" <?php if($_POST['txtDate'] == "20") { echo "selected=\"selected\""; } ?>>20</option>
            <option value="21" <?php if($_POST['txtDate'] == "21") { echo "selected=\"selected\""; } ?>>21</option>
            <option value="22" <?php if($_POST['txtDate'] == "22") { echo "selected=\"selected\""; } ?>>22</option>
            <option value="23" <?php if($_POST['txtDate'] == "23") { echo "selected=\"selected\""; } ?>>23</option>
            <option value="24" <?php if($_POST['txtDate'] == "24") { echo "selected=\"selected\""; } ?>>24</option>
            <option value="25" <?php if($_POST['txtDate'] == "25") { echo "selected=\"selected\""; } ?>>25</option>
            <option value="26" <?php if($_POST['txtDate'] == "26") { echo "selected=\"selected\""; } ?>>26</option>
            <option value="27" <?php if($_POST['txtDate'] == "27") { echo "selected=\"selected\""; } ?>>27</option>
            <option value="28" <?php if($_POST['txtDate'] == "28") { echo "selected=\"selected\""; } ?>>28</option>
            <option value="29" <?php if($_POST['txtDate'] == "29") { echo "selected=\"selected\""; } ?>>29</option>
            <option value="30" <?php if($_POST['txtDate'] == "30") { echo "selected=\"selected\""; } ?>>30</option>
            <option value="31" <?php if($_POST['txtDate'] == "31") { echo "selected=\"selected\""; } ?>>31</option>
            </select>
            <select name="txtMonth" id="txtMonth">
              <option value="Month" <?php if($_POST['txtMonth'] == "Month") { echo "selected=\"selected\""; } ?>>Month</option>
              <option value="01" <?php if($_POST['txtMonth'] == "01") { echo "selected=\"selected\""; } ?>>Jan</option>
              <option value="02" <?php if($_POST['txtMonth'] == "02") { echo "selected=\"selected\""; } ?>>Feb</option>
              <option value="03" <?php if($_POST['txtMonth'] == "03") { echo "selected=\"selected\""; } ?>>Mar</option>
              <option value="04" <?php if($_POST['txtMonth'] == "04") { echo "selected=\"selected\""; } ?>>Apr</option>
              <option value="05" <?php if($_POST['txtMonth'] == "05") { echo "selected=\"selected\""; } ?>>May</option>
              <option value="06" <?php if($_POST['txtMonth'] == "06") { echo "selected=\"selected\""; } ?>>Jun</option>
              <option value="07" <?php if($_POST['txtMonth'] == "07") { echo "selected=\"selected\""; } ?>>Jul</option>
              <option value="08" <?php if($_POST['txtMonth'] == "08") { echo "selected=\"selected\""; } ?>>Aug</option>
              <option value="09" <?php if($_POST['txtMonth'] == "09") { echo "selected=\"selected\""; } ?>>Sep</option>
              <option value="10" <?php if($_POST['txtMonth'] == "10") { echo "selected=\"selected\""; } ?>>Oct</option>
              <option value="11" <?php if($_POST['txtMonth'] == "11") { echo "selected=\"selected\""; } ?>>Nov</option>
              <option value="12" <?php if($_POST['txtMonth'] == "12") { echo "selected=\"selected\""; } ?>>Dec</option>
            </select>
            <select name="txtYear" id="txtYear">
              <option value="Year">Year</option>
              <option value="1985">1985</option>
              <option value="1986">1986</option>
              <option value="1987">1987</option>
              <option value="1988">1988</option>
              <option value="1989">1989</option>
              <option value="1900" >1990</option>
              <option value="1991">1991</option>
              <option value="1992">1992</option>
              <option value="1993">1993</option>
              <option value="1994">1994</option>
              <option value="1995">1995</option>
              <option value="1996">1996</option>
              <option value="1997">1997</option>
              <option value="1998">1998</option>
              <option value="1999">1999</option>
              <option value="2000">2000</option>
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
              <option value="2007">2007</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
              <option value="2030">2030</option>
              <option value="2031">2031</option>
              <option value="2032">2032</option>
              <option value="2033">2033</option>
              <option value="2034">2034</option>
              <option value="2035">2035</option>
          </select></td>
          <td align="left">
              <?php
              if($dobV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Place Of Birth :</td>
          <td align="left"><input name="txtPOB" type="text" id="txtPOB" size="30" Value="<?php echo $_POST['txtPOB']?>" placeholder="Place of Birth"></td>
          <td align="left">
              <?php
              if($pobV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">State Of Origin :</td>
          <td align="left">
            <select name="txtSOO" id="txtSOO">
            <option value="Select" <?php if($_POST['txtSOO'] == "Select") { echo "selected=\"selected\""; } ?>>Select</option>
            <option value="Abia" <?php if($_POST['txtSOO'] == "Abia") { echo "selected=\"selected\""; } ?>>Abia</option>
            <option value="Adamawa" <?php if($_POST['txtSOO'] == "Adamawa") { echo "selected=\"selected\""; } ?>>Adamawa</option>
            <option value="Akwa Ibom" <?php if($_POST['txtSOO'] == "Akwa Ibom") { echo "selected=\"selected\""; } ?>>Akwa Ibom</option>
            <option value="Anambra" <?php if($_POST['txtSOO'] == "Anambra") { echo "selected=\"selected\""; } ?>>Anambra</option>
            <option value="Bauchi" <?php if($_POST['txtSOO'] == "Bauchi") { echo "selected=\"selected\""; } ?>>Bauchi</option>
            <option value="Baylesa" <?php if($_POST['txtSOO'] == "Baylesa") { echo "selected=\"selected\""; } ?>>Baylesa</option>
            <option value="Benue" <?php if($_POST['txtSOO'] == "Benue") { echo "selected=\"selected\""; } ?>>Benue</option>
            <option value="Borno" <?php if($_POST['txtSOO'] == "Borno") { echo "selected=\"selected\""; } ?>>Borno</option>
            <option value="Cross River" <?php if($_POST['txtSOO'] == "Cross River") { echo "selected=\"selected\""; } ?>>Cross River</option>
            <option value="Delta" <?php if($_POST['txtSOO'] == "Delta") { echo "selected=\"selected\""; } ?>>Delta</option>
            <option value="Ebonyi" <?php if($_POST['txtSOO'] == "Ebonyi") { echo "selected=\"selected\""; } ?>>Ebonyi</option>
            <option value="Edo" <?php if($_POST['txtSOO'] == "Edo") { echo "selected=\"selected\""; } ?>>Edo</option>
            <option value="Ekiti" <?php if($_POST['txtSOO'] == "Ekiti") { echo "selected=\"selected\""; } ?>>Ekiti</option>
            <option value="Enugu" <?php if($_POST['txtSOO'] == "Enugu") { echo "selected=\"selected\""; } ?>>Enugu</option>
            <option value="FCT" <?php if($_POST['txtSOO'] == "FCT") { echo "selected=\"selected\""; } ?>>FCT</option>
            <option value="Gombe" <?php if($_POST['txtSOO'] == "Gombe") { echo "selected=\"selected\""; } ?>>Gombe</option>
            <option value="Imo" <?php if($_POST['txtSOO'] == "Imo") { echo "selected=\"selected\""; } ?>>Imo</option>
            <option value="Jigawa" <?php if($_POST['txtSOO'] == "Jigawa") { echo "selected=\"selected\""; } ?>>Jigawa</option>
            <option value="Kaduna" <?php if($_POST['txtSOO'] == "Kaduna") { echo "selected=\"selected\""; } ?>>Kaduna</option>
            <option value="Kano" <?php if($_POST['txtSOO'] == "Kano") { echo "selected=\"selected\""; } ?>>Kano</option>
            <option value="Kastina" <?php if($_POST['txtSOO'] == "Kastina") { echo "selected=\"selected\""; } ?>>Kastina</option>
            <option value="Kebbi" <?php if($_POST['txtSOO'] == "Kebbi") { echo "selected=\"selected\""; } ?>>Kebbi</option>
            <option value="Kogi" <?php if($_POST['txtSOO'] == "Kogi") { echo "selected=\"selected\""; } ?>>Lokoja</option>
            <option value="Kwara" <?php if($_POST['txtSOO'] == "Kwara") { echo "selected=\"selected\""; } ?>>Kwara</option>
            <option value="Lagos" <?php if($_POST['txtSOO'] == "Lagos") { echo "selected=\"selected\""; } ?>>Lagos</option>
            <option value="Niger" <?php if($_POST['txtSOO'] == "Niger") { echo "selected=\"selected\""; } ?>>Niger</option>
            <option value="Ogun" <?php if($_POST['txtSOO'] == "Ogun") { echo "selected=\"selected\""; } ?>>Ogun</option>
            <option value="Ondo" <?php if($_POST['txtSOO'] == "Ondo") { echo "selected=\"selected\""; } ?>>Ondo</option>
            <option value="Osun" <?php if($_POST['txtSOO'] == "Osun") { echo "selected=\"selected\""; } ?>>Osun</option>
            <option value="Oyo" <?php if($_POST['txtSOO'] == "Oyo") { echo "selected=\"selected\""; } ?>>Oyo</option>
            <option value="Plateau" <?php if($_POST['txtSOO'] == "Plateau") { echo "selected=\"selected\""; } ?>>Plateau</option>
            <option value="Rivers" <?php if($_POST['txtSOO'] == "Rivers") { echo "selected=\"selected\""; } ?>>Rivers</option>
            <option value="Sokoto" <?php if($_POST['txtSOO'] == "Sokoto") { echo "selected=\"selected\""; } ?>>Sokoto</option>
            <option value="Taraba" <?php if($_POST['txtSOO'] == "Taraba") { echo "selected=\"selected\""; } ?>>Taraba</option>
            <option value="Yobe" <?php if($_POST['txtSOO'] == "Yobe") { echo "selected=\"selected\""; } ?>>Yobe</option>
            <option value="Zamfarawa" <?php if($_POST['txtSOO'] == "Zamfarawa") { echo "selected=\"selected\""; } ?>>Zamfarawa</option>
          </select></td>
          <td align="left">
              <?php
              if($sooV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Nationality :</td>
          <td align="left">
              <input name="txtNationality" type="text" id="txtNationality" size="30" Value="<?php echo $_POST['txtNationality'] ?>" placeholder="Birth Country"> </td>
          <td align="left">
              <?php
              if($natV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">Religion :</td>
          <td align="left">
            <select name="txtReligion" id="txtReligion">
                <option value="Select" <?php if($_POST['txtReligion'] == "Select") { echo "selected=\"selected\""; } ?>>Select</option>
            <option value="Buddhism" <?php if($_POST['txtReligion'] == "Buddhism") { echo "selected=\"selected\""; } ?>>Buddhism</option>
            <option value="Catholic" <?php if($_POST['txtReligion'] == "Catholic") { echo "selected=\"selected\""; } ?>>Catholic</option>
            <option value="Christainity" <?php if($_POST['txtReligion'] == "Christainity") { echo "selected=\"selected\""; } ?> >Christainity</option>
            <option value="Hunduism" <?php if($_POST['txtReligion'] == "Hunduism") { echo "selected=\"selected\""; } ?>>Hunduism</option>
            <option value="Islam" <?php if($_POST['txtReligion'] == "Islam") { echo "selected=\"selected\""; } ?>>Islam</option>
            <option value="Others" <?php if($_POST['txtReligion'] == "Others") { echo "selected=\"selected\""; } ?>>Others</option>
          </select></td>
          <td align="left">
              <?php
              if($relV)
                echo '<font color="#FF0000">*</font>';
              ?>
          </td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left"><input type="Submit" class="button" id="toAca" value="NEXT" /></td>
          <td align="left">&nbsp;</td>
        </tr>
      </table>
    </div> 
    </form>
    </div>
</body>
</html>
