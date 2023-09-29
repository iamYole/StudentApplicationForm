<?php 
require_once("Include/db.php");
$db=new DataManager();
session_start();
 
    if (array_key_exists("Category", $_SESSION))
    {
        if (array_key_exists("RegNo_Img", $_SESSION))
        {            
            $isValid=false;
            $msg="";

            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $Img=$_FILES['userImg']['name']; 
                //$Dir="C:/xampp/htdocs/StudentApplicationForm/Include/ImgDB/";
                $Dir=$_SERVER['DOCUMENT_ROOT'].'/StudentApplicationForm/Include/ImgDB/';
                $RegNo=$_SESSION["RegNo_Img"];                

                if($Img=="")               
                {
                    $isValid=true;
                    $msg="Select An Image File";
                }                
                else
                {                 
                    $Img_Name=$Dir.$Img;

                      $ext=pathinfo($Img_Name);
                      $ext=$ext[extension];
                    if($ext=="jpg" || £ext=="gif" || $ext=="png" || $ext=="Jpg" || £ext=="Gif" || $ext=="Png")
                    {
                        if($_FILES['userImg']['size'] < 70000)
                        {
                            if(move_uploaded_file($_FILES['userImg']['tmp_name'], $Img_Name))
                            {
                                $newFile=$Dir.$RegNo.'.'.$ext;
                                rename($Img_Name,$newFile);

                                $db->saveImage($RegNo, $RegNo.'.'.$ext);
                                $today = date("Y-m-j");
                                $db->formCompleted($RegNo,$today);
                                $_SESSION["Summary"]=$RegNo;
                                header('Location: Summary.php' );
                            }                            
                        }
                        else
                        {
                            $isValid=true;
                            $msg="Image File, Too Large !!!";
                        }
                    }
                    else
                    {
                        $isValid=true;
                        $msg="Invalid Image Format";
                    }
                    
                        
                }                      
            }
        }
        else
        {
            header('Location: Section_3.php' );
        }
     }
    else
    {
        header('Location: index.php' );
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Application Form</title>
<link rel="stylesheet" href="Scripts/Site.css" type="text/css">
<style type="text/css">

#apDiv1 {
	position:absolute;
	left:284px;
	top:152px;
	width:470px;
	height:106px;
	z-index:3;
}
</style>
</head>

<body>
<div id="img">
    <img src="Scripts/Images/logo.png" width="1060" height="191" alt="Logo">
    </div>
<div id="Schoolheader"><?php echo $_SESSION["Category"] ?> School Form</div>
<div id="form1">
    <form action="Section_4.php" method="post" enctype="multipart/form-data" id="appForm">
    <div id="section1">Section 4 of 4</div>
    <div id="formHeader1">APPLICANT'S IMAGE</div>
    <div id="formContent1">
        <?php
        if($isValid)
        {            
            echo'    <p><strong><font color="#FF0000">'.$msg.'</font></strong></p>';
        }
        ?>
        <div id="msg">Please Upload a picture file in GIF , JPG/JPEG  or PNG format only. The File Size MUST be less than 60kilobytes</div>
  <div id="apDiv1">
  <table width="380" border="0" cellspacing="5" cellpadding="5">
    <tr align="center">
      <td><input name="userImg" type="file" id="userImg" size="45" /></td>
    </tr>
    <tr>
      <td align="center"><input name="btnUplaod" type="submit" class="button" id="btnUplaod" value="UpLoad" /></td>
    </tr>
  </table>
  </div>
      </div>
  </form>
        </div>


</body>
</html>