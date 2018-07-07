<?php
include"top.php";
?>
<?php 
          $Appl_No = $_GET['application_num'];
          $query2 = "SELECT b.Subject_Name, a.Marks_Obtained, a.Full_Marks, a.Pass_Fail_Remarks, a.Board, a.Roll_Index_No, a.Year_of_Passing"
              . " FROM applicaion_marks a, subject_master b WHERE a.`Application_No`='$Appl_No' and a.subject = b.subject_Id";
          $conn = new mysqli("localhost", "root", "welcome1", "onlinead_kandra");
          $result = $conn->query($query2);
          $outp = array();
          $outp = $result->fetch_all(MYSQLI_ASSOC);
          //
          echo json_encode($outp);
?>

			