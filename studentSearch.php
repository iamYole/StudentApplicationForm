<?php
require_once("Include/db.php");
$db=new DataManager();
session_start();
    if (array_key_exists("User", $_SESSION))
    {        
        if(array_key_exists("criterion", $_SESSION) && array_key_exists("Value", $_SESSION))
        {
            $criterion=$_SESSION['criterion'];
            $val=$_SESSION['Value'];
            
            $show="";
            if($criterion =="SURNAME")
            {
                $show="SURNAME";
            }
            else if($criterion=="CATEGORY")
            {
                $show="CATEGORY";
            }
            else if($criterion=="CLASS")
            {
                $show="CLASS";
            }
            else
            {
                $show="";
            }
                
            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                //if(empty())
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
<title>Student Search</title>
<link rel="stylesheet" href="Scripts/Site.css" type="text/css">
<script src="Scripts/jquery-1.4.1.min.js"></script>
<style type="text/css">
body {
	background-color: #E47000;
}
#apDiv1 {
	position:absolute;
	left:15px;
	top:179px;
	width:265px;
	height:28px;
	z-index:4;
	font-size: medium;
}
#appContent #stds {
	font-size: medium;
}
#apDiv2 {
	position:absolute;
	left:64px;
	top:740px;
	width:320px;
	height:42px;
	z-index:5;
	color: #E47000;
}
#apDiv3 {
	position:absolute;
	left:57px;
	top:265px;
	width:207px;
	height:24px;
	z-index:6;
	background-color: #FFF;
	font-size: medium;
	color: #E47000;
}
</style>
</head>

<body>
<div id="consoleLogo">
<img src="Scripts/Images/crest.png" width="180" height="120" align="left" />
<h2>ADMIN CONSOLE</h2>
</div>
<div id="searchContent">
  <table width="1012" border="0"  align="center" cellspacing="5" cellpadding="5" id="stds">
    <caption class="cap">
      <strong>Search Result</strong>
    </caption>
    <tr bgcolor="#E47000">
      <th width="91">Reg No.</th>
      <th width="213">full Name</th>
      <th width="70">Gender</th>
      <th width="156">School</th>
      <th width="168">Previous Class</th>
      <th width="165">Class Applying To</th>
    </tr>
      
<?php
        if($show=="SURNAME")
        {
            $page_result=$db->getApplicantsBySurname($_SESSION['Value']);
            $total_pages=mysql_num_rows($page_result);
            
            $page_rows=4;
            $last_page = ceil($total_pages/$page_rows);

                if (!(isset($_GET['pagenum']))) 
                {
                        $pagenum = 1; 
                    if ($pagenum < 1) 
                        $pagenum = 1; 
                    else if ($pagenum > $last_page) 
                        $pagenum = $last_page; 
                }
                else
                {
                    $pagenum=(int)$_GET['pagenum'];         
                }
            
          //$result=$db->getApplicantsBySurname($_SESSION['Value']);
            $max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
            $val=($_SESSION['Value']);
            $result=mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND p.Surname = '$val'  $max ");

            if(mysql_num_rows($result) != 0)
            {
                while($row= mysql_fetch_array($result))
                {
                   $fullname=$row[1].' '.$row[2].' '.$row[3];
                   $RegNo=$row[0];
                   $sex=$row[4];
                   $school=$row[5];
                   $pc=$row[6];
                   $cp=$row[7];
                echo
                '<tr>
                  <td>'.$RegNo.'</td>
                  <td><a href="applicantInfo.php?Reg_No='.$RegNo.'">'.$fullname.'</a></td>
                  <td>'.$sex.'</td>
                  <td>'.$school.'</td>
                  <td>'.$pc.'</td>
                  <td>'.$cp.'</td>
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
        }        
        else if($show=="CATEGORY")
        {
            $page_result=$db->getApplicantsByCategory($_SESSION['Value']);
            $total_pages=mysql_num_rows($page_result);
            $page_rows=10;

            $last_page = ceil($total_pages/$page_rows);

                if (!(isset($_GET['pagenum']))) 
                {
                        $pagenum = 1; 
                    if ($pagenum < 1) 
                        $pagenum = 1; 
                    else if ($pagenum > $last_page) 
                        $pagenum = $last_page; 
                }
                else
                {
                    $pagenum=(int)$_GET['pagenum'];         
                }
            
          $val=($_SESSION['Value']);
            $max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
            $result=mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND e.Category = '$val'  $max ");
            
 
            if(mysql_num_rows($result) != 0)
            {
               while($row= mysql_fetch_array($result))
               {
                   $fullname=$row[1].' '.$row[2].' '.$row[3];
                   $RegNo=$row[0];
                   $sex=$row[4];
                   $school=$row[5];
                   $pc=$row[6];
                   $cp=$row[7];
                echo
                '<tr>
                  <td>'.$RegNo.'</td>
                  <td><a href="applicantInfo.php?Reg_No='.$RegNo.'">'.$fullname.'</a></td>
                  <td>'.$sex.'</td>
                  <td>'.$school.'</td>
                  <td>'.$pc.'</td>
                  <td>'.$cp.'</td>
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
        }
        else if($show=="CLASS")
        {
            $page_result=$db->getApplicantsByClass($_SESSION['Value']);
            $total_pages=mysql_num_rows($page_result);
            $page_rows=10;

            $last_page = ceil($total_pages/$page_rows);

                if (!(isset($_GET['pagenum']))) 
                {
                        $pagenum = 1; 
                    if ($pagenum < 1) 
                        $pagenum = 1; 
                    else if ($pagenum > $last_page) 
                        $pagenum = $last_page; 
                }
                else
                {
                    $pagenum=(int)$_GET['pagenum'];         
                }
            
              $val=($_SESSION['Value']);
            $max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;

            $result=mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND e.presentclass = '$val'  $max");
           
            if(mysql_num_rows($result) != 0)
            {
                while($row= mysql_fetch_array($result))
               {
                   $fullname=$row[1].' '.$row[2].' '.$row[3];
                   $RegNo=$row[0];
                   $sex=$row[4];
                   $school=$row[5];
                   $pc=$row[6];
                   $cp=$row[7];
                echo
                '<tr>
                  <td>'.$RegNo.'</td>
                  <td><a href="applicantInfo.php?Reg_No='.$RegNo.'">'.$fullname.'</a></td>
                  <td>'.$sex.'</td>
                  <td>'.$school.'</td>
                  <td>'.$pc.'</td>
                  <td>'.$cp.'</td>
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
        }
     ?>
  </table>
</div>
<div id="apDiv1">CLICK <a href="AdminHome.php">HERE</a> TO GO BACK</div>
<div id="apDiv2">
   <?php    
    if($pagenum !=1)
    {
         $prev=$pagenum-1;
         echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=$prev'> <<< BACK  |   </a>";
    }
    if($pagenum !=$last_page)
    {
        $next=$pagenum+1;
        echo "<a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>NEXT >>>  </a>";
    }
?>
</div>

<div id="apDiv3"><?php echo 'Displaying Page'.$pagenum.' of '.$last_page.''; ?></div>
<script>
$(document).ready(function()
	 	{
			$('#stds tr:even').addClass('odd');
			$('#stds tr:odd').addClass('even');		
			
			
			$('#stds tr').mouseover(function()
			{
				$(this).addClass('mHover');
			});
			$('#stds tr').mouseout(function()
			{
				$(this).removeClass('mHover');
			});		 
			
		});
</script>
</body>
</html>