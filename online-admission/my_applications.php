<?php
include "top.php";
include "header.php";

$uname = $_SESSION['user_id'];

$result = mysql_query("select a.id,a.Application_No,a.password,a.Application_Fee,a.Demand_Draft_No,a.First_Name,a.Middle_Name,a.Last_Name,a.Gurdian_Name,a.Gurdian_Mobile_No,a.Gurdian_Relation,
        a.Other_Relation,a.occu,a.other_occu,a.desi,a.income,a.Gender,a.Date_Of_Birth,a.Category,a.Physically_Challenged,a.Religion,a.other_religion,a.Nationality,
        a.Address,a.ZIP_PIN,a.Address_1,a.pin2,a.Address_2,a.Country,a.Mobile,a.Land_Phone_No,a.email,a.Total_Marks,a.Bank_Payment_Verified,a.admit,a.course_id,
        a.course_level_id,a.session_id,a.submit_date,a.flag,a.state,a.district, b.Course_Level_Name, c.Course_Name , d.FLAG_NAME
	from application_table a, course_level b, course_table c, admission_flag d
	where a.course_level_id = b.Course_Level_Id and a.course_id = c.courseId 
        and (a.email = '$uname' or a.Gurdian_Mobile_No = '$uname') and d.FLAG_ID=a.flag") or die(mysql_error());

//$result = mysql_query($query) or die(mysql_error());
?>

<br />

<table cellpadding="5" cellspacing="5" align="center" width="98%" border="1" style="border-collapse:collapse;" bordercolor="#cacaca" >



    <tr align="center" class="colhead">
        <td width="5%">Sl.</td>
        <td width="10%">Application ID</td>
        <td width="10%">Course Level</td>
        <td width="10%">Course Name</td>
        <td width="15%">ACTION</td>
        <td width="10%">STATUS</td>
		<td width="15%">Application Challan Scan Copy</td>
		<td width="15%">Admisson Challan Scan Copy</td>
    </tr>

    <?php
    $slno = 0;
    while ($f_arr = mysql_fetch_array($result)) {
        $slno++;
        ?>
        <tr align="center" id="<?php echo $f_arr['Application_No']; ?>" bgcolor="<?php echo $bg; ?>" onMouseOver=bgColor = "#EFF7FF" onMouseOut=bgColor = "<?php echo $bg; ?>">
            <td><?php echo $slno; ?></td>
            <td><?php
    //$cl=$f_arr['Course_Level_Id'];
    //$fcl=mysql_fetch_array(mysql_query("select * from course_level where Course_Level_Id='$cl'"));
    echo $f_arr['Application_No'];
    ?></td>
            <td>
                <?php
                //$cl=$f_arr['Course_Id'];
                //$fcl=mysql_fetch_array(mysql_query("select * from course_table where CourseId='$cl'"));
                echo $f_arr['Course_Level_Name'];
                ?></td>
            <td><?php echo $f_arr['Course_Name'];?></td>
            <td style="padding-left:5px;" align="center">
                        <?php if($f_arr['admit']==0){?>
							<a href="view.php?action=view&id=<?php echo $f_arr['id'];?>">View</a>
                            ||
                            <a href="../print_application.php?application_num=<?php echo $f_arr['Application_No']?>" target="_blank">Print Application Form</a>
                            
                                                        
                         <?php }else{
								echo "Admitted";
		}?>
            </td>
            <td style="padding-left:5px;" align="center"><?php echo $f_arr[FLAG_NAME] ?></td>
			<td style="padding-left:5px;" align="center"><input type="file" name="secondary-marksheet" id="app-challan"/><input type="button" value="Upload"></td>
			<td style="padding-left:5px;" align="center"><input type="file" name="secondary-marksheet" id="adm-challan"/><input type="button" value="Upload"></td>
        </tr>

    <?php } ?>



</table>

<script>
$(document).ready(function(e){
	alert("hii");
    $("#fupForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'submit.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
});
</script>
<?php include "footer.php";?>
