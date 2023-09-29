<?php
    class DataManager 
    {    
        var $user = "Administrator";
        var $pass = "!password";
        var $dbName = "StudentInfo";
        var $dbHost = "localhost";
        var $con;

        function DataManager()
        {
            $this->con = mysql_connect($this->dbHost, $this->user, $this->pass)
            or die ("Could not connect to db: " . mysql_error());
            mysql_select_db($this->dbName, $this->con)
            or die ("Could not select db: " . mysql_error());
	}
        
        function savePersonal_Info ($sname, $mname,$fname,$gender,$phone,$addy,$dob,$pob,$stateOrigin,$nationality,$religion,$dap)
        {
            mysql_query("INSERT INTO personal_info (Surname, MiddleName,FirstName, Gender,
                Telephone, Address, DOB, PlaceOfBirth, StateOfOrigin, Nationality, Religion,Status,DateApplied)
                VALUES ('" . $sname . "', '" . $mname . "',
                '" . $fname . "','" . $gender . "','" . $phone . "','" . $addy . "','" . $dob . "','" . $pob . "',
              
                          '" . $stateOrigin . "','" . $nationality . "','" . $religion . "', 'INCOMPLETE' ,'" .$dap."')")or
                         // die(mysql_error());
            die("Error in Saving Form: Please Fill all Fields Correctly ");
        }
        function saveEducational_Info($regNo,$p_School,$l_School,$p_Class,$l_Class,$Cat)
        {            
            mysql_query("INSERT INTO educational_info (RegNo,PrimarySchool,LastSchool,LastClass,PresentClass,Category)
                VALUES ('" . $regNo . "','" . $p_School . "','" . $l_School . "',
                '" . $l_Class . "','" . $p_Class . "','" . $Cat. "')")or
            die("Error in Saving Form: Please Fill all Fields Correctly. Please Try Try Again ");
        }
        function saveFamily_Info($regNo,$Fname,$Fphone,$Fjob,$Mname,$Mphone,$Mjob,$Sname
                ,$Sphone,$Doctor,$phone,$Illness)                
        {
             mysql_query("INSERT INTO familiy_info (RegNo,FattherName,FPhone,FJob,Mothername,MPhone,MJob,SponsorName,
                 SPhone,Doctor,Phone,Illness) 
                 VALUES('" . $regNo . "','" . $Fname . "','" . $Fphone . "',
                 '" . $Fjob . "','" . $Mname . "','" . $Mphone . "','" . $Mjob . "',
                     '" . $Sname . "','" . $Sphone . "','" . $Doctor . "',
                         '" . $phone . "','" . $Illness . "')")or 
            die("Error in Saving Form: Please Fill all Fields Correctly. Please Try Again   ");         
        }
        function saveImage($regNo,$Image)
        {
            mysql_query("INSERT INTO student_image (RegNo, IMG_NAME) VALUES('".$regNo."','".$Image."')")or
            die("Error In Uploading Image File; Pls Try Again". mysql_error());
        }
        function formCompleted($RegNo,$date)
        {
            mysql_query("UPDATE personal_info SET Status='COMPLETED',DateApplied='$date'  WHERE RegNo='$RegNo'")or
            die(mysql_error());
        }
        function getCategories()
        {
            return mysql_query("select distinct category from optionlists where category <> 'Nursery' ");
        }
        function getClasses($Category)
        {
            return mysql_query("select Classes from optionlists where category='$Category'");
        }
        function getAllClasses()
        {
            return mysql_query("select Classes from optionlists");
        }
        function getEnrolledStudents()
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category,e.presentclass,f.sponsorname,f.sphone
                                from personal_info p, educational_info e, familiy_info f
                                where p.RegNo=e.regno AND p.RegNo=f.RegNo AND p.admissionstatus ='ADMITTED' Order By p.`DateAdmitted`,p.regno DESC LIMIT 0,10");
        }        
        function ultimateSearch($RegNo)
        {
            return mysql_query("select *  from personal_info p, educational_info e,familiy_info f, student_image s
                                where p.RegNo=e.regno AND p.RegNo=f.RegNo AND p.RegNo=s.RegNo AND p.RegNo='$RegNo'");
        }
        function getApplicants()
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass,f.SponsorName,f.SPhone
                                from personal_info p, educational_info e, familiy_info f
                                where p.RegNo=e.regno AND p.`RegNo`=f.`RegNo` AND p.admissionstatus = 'PENDING' Order By p.`RegNo` DESC LIMIT 0,10");
        }         
        function getApplicantsByRegNo($RegNo)
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND p.RegNo = '$RegNo'");
        } 
        function getApplicantsBySurname($Surname)
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND p.Surname = '$Surname' ");
        } 
        function getApplicantsByClass($Classes)
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND e.presentclass = '$Classes' ");
        } 
        function getApplicantsByCategory($Category)
        {
            return mysql_query("select p.regno,p.Surname,p.MiddleName, p.FirstName,p.gender, e.Category, e.lastclass,e.presentclass
                                from personal_info p, educational_info e
                                where p.RegNo=e.regno AND e.Category = '$Category' ");
        } 
        function p_info($RegNo)
        {
            return mysql_query("Select * FROM personal_info Where regno='$RegNo'");
        }
        function e_info($RegNo)
        {
            return mysql_query("Select * FROM educational_info Where regno='$RegNo'");
        }
        function getImage($RegNo)
        {
            return mysql_query("SELECT * FROM student_image WHERE regno='$RegNo'");
        }
        function authenticate($username,$password)
        {
            return mysql_query("select * from stafflogin where userid='$username' and password='$password' ");
        }
        function deleteIncomeplete()
        {
            mysql_query("DELETE * FROM personal_info WHERE status='INCOMPLETE'");
        }
        function resetPw($User,$oldPassword,$newPassword)
        {
            mysql_query("UPDATE stafflogin SET Password='$newPassword' where UserId='$User' And Password='$oldPassword'");
        }
        function grantAdmission($RegNo,$today)
        {
            mysql_query("update personal_info set AdmissionStatus='ADMITTED', DateAdmitted='$today' where RegNo='$RegNo'");
        }
        function revokeAdmission($regNo)
        {
            mysql_query("update personal_info set AdmissionStatus='PENDING',DateAdmitted=null  where RegNo='$regNo'");
        }
    }
?>
