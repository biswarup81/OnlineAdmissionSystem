<?php 

include "../classes/config.php";
include "../classes/conn.php";
include "../classes/admin_class.php";
$admin = new admin_class();

$cdata = $admin->getCollegeDetails();
$session = $admin->getSessionDetails();



?>
<html><head>

<link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<script type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type="text/javascript" src="../jquery-ui-1.11.3/external/jquery/jquery.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.11.3/jquery-ui.css">
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
<link type="text/css" href="jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet"/>
<script src="../jquery-ui-1.11.3/jquery-ui.js"></script>
<script src="../jquery-validation-1.13.1/dist/jquery.validate.js"></script>
<script src="../jquery-ui-1.10.4/ui/jquery.ui.core.js"></script>
<script src="../jquery-ui-1.10.4/ui/jquery.ui.widget.js"></script>
<script src="../jquery-ui-1.10.4/ui/jquery.ui.tabs.js"></script>

<title>Online Application : Apply Online</title>

<style>
.Submit_reset{
	width:65px;
	height:30px;
	cursor:pointer;
	background-color: #FF9933;
	}

td { padding-left:20px; }

.sTD { background-color:#eee; }

.mTD { padding-left:0px;text-align:center; }



.style1 {
	color: #FF0000;
	font-weight: bold;
}

.style2 {color: #FF0000}

.style8 {color: #000000;
	font-weight: bold;
}

.style3 {font-size: x-small}

.style6 {color: #000000; font-weight: bold; font-size: 16px; }

.style9 {color: #0000FF}

.style10 {color: #000000}

.style12 {font-size: large}



</style>


<script>
function show_submit()
	{
	 document.getElementById("showsubmit").style.visibility="visible";
	}
function hide_submit()
	{
	 //document.getElementById("showsubmit").style.visibility="hidden";
	}

function displayR()
	{
		if(document.getElementById("g_relation").value=="Other"){
	 		document.getElementById("other_R").style.visibility="visible";
			document.getElementById("R_other").value="";
		}else{
			document.getElementById("other_R").style.visibility="hidden";
			document.getElementById("R_other").value=" ";
		}
	}
function displayO()
	{
		if(document.getElementById("occu").value=="others"){
	 		document.getElementById("other_O").style.visibility="visible";
			document.getElementById("othrOccu").value="";
		}else{
			document.getElementById("other_O").style.visibility="hidden";
			document.getElementById("othrOccu").value=" ";
		}
	}
function displayRelign()
	{
		if(document.getElementById("religion").value=="others"){
	 		document.getElementById("other_relig").style.visibility="visible";
			document.getElementById("other_religion").value="";
		}else{
			document.getElementById("other_relig").style.visibility="hidden";
			document.getElementById("other_religion").value=" ";
		}
	}	
function otherNation()
	{
		if(document.getElementById("select7").value=="Other"){
	 		document.getElementById("other_Nation").style.visibility="visible";
			document.getElementById("nationother").value="";
		}else{
			document.getElementById("other_Nation").style.visibility="hidden";
			document.getElementById("nationother").value=" ";
		}
	}	
function countrychange()
	{
		if(document.getElementById("select4").value=="Other"){
	 		document.getElementById("other_C").style.visibility="visible";
			document.getElementById("Co_others").value="";
		}else{
			document.getElementById("other_C").style.visibility="hidden";
			document.getElementById("Co_others").value=" ";
		}
	}
	
var parspan='<textarea name="u_address" id="u_address" rows="5" cols="30" style="text-transform:uppercase;" required="required"></textarea><span class="style2"> *</span>Pincode<label for="label"></label><input type="text" name="pin2" id="pin2" pattern="[0-9]{6}" required="required"><br><font color="Gray"></font>';

function show_par_add(MODE)
{
 if(MODE=="yes")
   {
    document.getElementById("par_add").innerHTML="&nbsp;";
    document.getElementById("p1").style.display = 'none';
	document.getElementById("p2").style.display = 'none';
	document.getElementById("p3").style.display = 'none';
	document.getElementById("p4").style.display = 'none';
   }
 else
    {
     document.getElementById("par_add").innerHTML=parspan;
	 document.getElementById("p1").style.display = '';
	 document.getElementById("p2").style.display = '';
	 document.getElementById("p3").style.display = '';
	 document.getElementById("p4").style.display = '';
    }
}


function show_local(Mode)
{
 if(Mode=="yes")
    {
	 //document.getElementById("glocal").style.visibility="hidden";
	 document.getElementById("g1").style.display = 'none';
	 document.getElementById("g2").style.display = 'none';
	 document.getElementById("g3").style.display = 'none';
	 document.getElementById("g4").style.display = 'none';
	 document.getElementById("g5").style.display = 'none';
	
	}
 else
   {
    //document.getElementById("glocal").style.visibility="visible";
	document.getElementById("g1").style.display = '';
	 document.getElementById("g2").style.display = '';
	 document.getElementById("g3").style.display = '';
	 document.getElementById("g4").style.display = '';
	 document.getElementById("g5").style.display = '';
   }	
}


function otherBoard()
{
    if(document.getElementById("U_council").value!="WBCHSE")
	{
		 document.getElementById("other_roll").style.visibility="hidden";
		 document.getElementById("U_roll2").maxLength="30";
		 document.getElementById("U_roll2").value="";
		 document.getElementById("U_roll3").value=" ";
	}
	else
	{
		 document.getElementById("other_roll").style.visibility="visible";
		 document.getElementById("U_roll2").maxLength="6";
		 document.getElementById("U_roll2").value="";
		 document.getElementById("U_roll3").value="";
	}

	if(document.getElementById("U_council").value=="Other")
	{
		document.getElementById("other_B").style.visibility="visible";
		document.getElementById("full1").disabled=false;
		document.getElementById("full1").value="";
		document.getElementById("full2").disabled=false;
		document.getElementById("full2").value="";
		document.getElementById("full3").disabled=false;
		document.getElementById("full3").value="";
		document.getElementById("full4").disabled=false;
		document.getElementById("full4").value="";
		document.getElementById("full5").disabled=false;
		document.getElementById("full5").value="";
		document.getElementById("full6").disabled=false;
		document.getElementById("full6").value="";
	}
	else // Known Boards
	{
		document.getElementById("other_B").style.visibility="hidden";
		document.getElementById("Uv_others").value=" ";
		document.getElementById("full1").value="100";
		document.getElementById("full1").disabled=true;
		document.getElementById("full2").value="100";
		document.getElementById("full2").disabled=true;
		document.getElementById("full3").value="100";
		document.getElementById("full3").disabled=true;
		document.getElementById("full4").value="100";
		document.getElementById("full4").disabled=true;
		document.getElementById("full5").value="100";
		document.getElementById("full5").disabled=true;
		document.getElementById("full6").value="100";
		document.getElementById("full6").disabled=true;
	}

}

function phnChk(){
	var phone= /^[-]?[0-9]+[\.]?[0-9]+$/;
	var strfield11 =document.getElementById("U_phone22").value;
	var strfield12 =document.getElementById("U_gname222").value;
	if(strfield11 != "" || strfield11 != "")
		{
			if(strfield11 == "")
				{
					alert("Please enter STD Code");
					return false;
				}
			else if(!phone.test(strfield11))
				{
					alert("Please enter valid STD Code");
					return false;
				}
			if(strfield12 == "")
				{
					alert("Please enter Phone No");
					return false;
				}
			else if(strfield12 != "")
				{
					if(!phone.test(strfield12))
						{
							alert("Please enter Valid Phone No");
							return false;
						}
				}
		}
}

function checkSubjects(ID)
{
	//alert(ID);
	Count=0;
	var S=document.getElementById("s"+ID).value;
    if(S!="None" || S!=" ")
	{
	 document.getElementById("m"+ID).disabled=false;
	}
	
	if(S=="None" || S==" ")
	{
	 document.getElementById("m"+ID).disabled=true;
	 document.getElementById("m"+ID).value="";
	}
	S1=document.getElementById("s1").value;
	S2=document.getElementById("s2").value;
	S3=document.getElementById("s3").value;
	S4=document.getElementById("s4").value;
	S5=document.getElementById("s5").value;
	S6=document.getElementById("s6").value;
	if(S==S1) Count++;	
	if(S==S2) Count++;	
	if(S==S3) Count++;	
	if(S==S4) Count++;	
	if(S==S5) Count++;	
	if(S==S6) Count++;

	if(Count>1)
	{
		alert("Duplicate Subject Name");
		document.getElementById("s"+ID).selectedIndex=0;
		document.getElementById("m"+ID).disabled=true;
	 	document.getElementById("m"+ID).value="";
	}

 }

function checkMarks(ID)
{
	  var MM=document.getElementById("m"+ID).value;
	  if(isNaN(MM) || MM.charAt(0) == ' ')
	   {
		alert("Please Enter Proper Marks");
		document.getElementById("m"+ID).value="";
		document.getElementById("m"+ID).focus();
	   }
		var M=parseInt(document.getElementById("m"+ID).value);
		var F=parseInt(document.getElementById("full"+ID).value);
		/*if(M>F || M+''!=document.getElementById("m"+ID).value)*/
		  if(M>F)
		{
			alert("Invalid Marks");
			document.getElementById("m"+ID).value="";
			document.getElementById("m"+ID).focus();
		}
	/*---------------------Best Of 4----------------------------------------------------------*/
	calculate();
}


function calculate()
{
	//alert("ok");
	marks =  new Array(6);
	for(j=1;j<=6;j++){
		if(!isNaN(parseInt(document.getElementById("m"+j).value)) &&document.getElementById("m"+j).disabled==false){
			//alert("ok");
			if(document.getElementById("select").value==3 && j==1){
				marks[j-1]=0;
			}else{
				marks[j-1]=parseInt(document.getElementById("m"+j).value)*100/parseInt(document.getElementById("full"+j).value);
			}
		}
	}
	//alert("ok");
for(i=0;i<=5;i++)
{
 max=marks[i];
 index=i;
 for(j=i;j<=5;j++)
   {
    if(marks[j]>max)
	   {
	    max=marks[j];
		index=j;
	   }
   }
  t=marks[i];
  marks[i]=max;
  marks[index]=t;
}
	if(document.getElementById("select").value==4){
		
   		//var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4]+marks[5];
		var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4]+(parseInt(document.getElementById("m1").value)*100/parseInt(document.getElementById("full1").value));
		document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five Subjects + Honors Subject: (Total 600)";
	}else{
		var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4];
		document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five in Top (Total 500):";
	}
	
   if(!isNaN(total))
      document.getElementById("m12").value=Math.round(total);
   else
       document.getElementById("m12").value="";
}

/*function CourseLevel1()
{
	document.getElementById("D1").style.display="block";
    $("#D1").load('ajax/courseList.php?courseLevelId=' + $("#select").val());
	load_sub();
}*/
function load_sub(){
	$("#s1").load('ajax/allSubj.php');
	document.getElementById("m1").value="";
	document.getElementById("m1").disabled="true";
	}
	

function CourseLevel() {
	
	course_level=document.getElementById("select").value;
       
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	xmlhttp.open("GET",'ajax/courseList.php?courseLevelId='+course_level,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
				
				a=xmlhttp.responseText;y=Array();	
				y=a.split("#");
				
				if(y[0]=='Success'){
					if(y[1]>0){
						
			
					 	document.getElementById("dOptPut").innerHTML=y[2];
						
						//document.getElementById("chkStatusText").innerHTML="Total Marks in Top Four Subjects + Honors Subject:";
						
					}else{
						document.getElementById("dOptPut").innerHTML="";
						document.getElementById("s1").innerHTML=y[3];
						//document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five in Top:";
						
					}
				}else{
					document.getElementById("dOptPut").innerHTML="";
				}
			} 
		}
		 
 }
 
 function subMand() {
	courseId=document.getElementById("D1").value;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	xmlhttp.open("GET",'ajax/mandarorySubSelection.php?courseId=' +courseId,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
				a=xmlhttp.responseText;y=Array();	
				y=a.split("#");
				//alert(y[1]);
				if(y[0]=='Success'){
					if(y[1]>0){
						//alert(y[0]);
					 	document.getElementById("s1").innerHTML=y[2];
					}else{
						//document.getElementById("s1").innerHTML="";
					}
				}else{
					document.getElementById("s1").innerHTML="";
				}
			} 
		}
		 
 }
 
function datevalid()
{
	 var str1=document.getElementById("theDate").value;
	 var day=str1.substring(0,2);
	 var month=str1.substring(3,5);	 
	 var year=str1.substring(6);
	 year=parseInt(year);
 	if(year>1995 || isNaN(year) || isNaN(month) || isNaN(month) || month>12 || day>31)
 	{
		alert("Invalid Date of Birth");
		document.getElementById("theDate").value="";
		document.getElementById("theDate").focus();
 	}	 
}
function validateApply1()
{
	alert();
	datevalid();
	return(true);
}

function getOtherDetails(){
	//var lentgh = $("#gmobnum").len();
	alert("Inside");
	
	if($("#gmobnum").val().length == 10){
		var mobile_number = $("#gmobnum").val();
		
		alert("Changed -> "+mobile_number);
		//Get the details of the application from previous application.

		$.ajax( {url: "admin/ajax/GetApplicationDetails.php?mobile_number="+mobile_number, success: function(result){
			var obj = JSON.parse(result);
			
			$("#Your_name").val(obj.First_Name) ;
			$("#U_name").val(obj.Middle_Name) ;
			$("#U_lname").val(obj.Last_Name) ;
			$("#U_gname").val(obj.Gurdian_Name) ;
			$("#g_relation").val(obj.Gurdian_Relation) ;
			$("#other_R").val("") ;
			$("#occu").val(obj.occu) ;
			$("#income").val(obj.income) ;
			if(obj.Gender == "M"){
				$('#radio1').attr('checked', 'checked');
			} else if (obj.Gender == "F"){
				$('#radio2').attr('checked', 'checked');
			} else {
				$('#radio3').attr('checked', 'checked');
			}
			
			
			$("#theDate").val(obj.Date_Of_Birth) ;
	       
	    }});
		
	} else {
		alert("Less than lengh 10");
	}

	
}


</script>
<script>
$(function () {
  $("#select10").change(function () {
    $("#D2").load('ajax/dist.php?stateId=' + $(this).val());
  });
});

$(function () {
  $("#select13").change(function () {
    $("#D3").load('ajax/dist.php?stateId=' + $(this).val());
  });
  
    $("#theDate").datepicker({
             changeMonth: true,
             changeYear: true,
             yearRange: "1990:2016"
        });
	 $("#Payment_date").datepicker({
            numberOfMonths: [2, 1]
        });
  
});

</script>
</head>

<body style="font-family: sans-serif;margin: 0px;">
<?php 
if($session != NULL){

?>
<form id="applyform" action="registration_s.php" method="post" enctype="multipart/form-data" name="applyform" onSubmit="return validateApply();">



 <center>
  <table border="0" width="0%">

	<tbody><tr bgcolor="#FFFFCC">

	  <td height="73" colspan="2">
     
      <div align="center">
<table width="100%">
<TR>
<td width="25%"><img src="<?=$cdata->logo;?>" width="195" height="163"></td>
<td width="65%" align="center" style="font-family:Georgia, 'Times New Roman', Times, serif" >
<font size="+3">
<?php 

echo $cdata->name;
?>
</font>
<br>
<?=$cdata->address;?>
<br>
APPLICATION FOR ADMISSION <?php echo $session->Session_Name; ?>
<div style="width:475px; padding:10px;">
<div style="float:left;">
<b>Stream : </b>
</div>
<div style="float:left; padding-left:25px;" >
<select name="select" id="select" onChange="return CourseLevel()" required >
	<option value="">Select Course Level</option>
<?php 
$courseLevel_query=mysql_query("SELECT * FROM `course_level` where Course_Level_Id in ('4','7','11','12','13','14') ORDER BY `Course_Level_Id` ASC");
while($courseLevel=mysql_fetch_array($courseLevel_query)){
?>

	<option value="<?=$courseLevel['Course_Level_Id']?>"><?=$courseLevel['Course_Level_Name']?></option>
    
<?php }?>
 </select>
</div>
<div>
<span id="dOptPut"></span>
  </div>
</div>
<br>
<font color="red">* All Fields are Mandatory.</font>
</td>
<td width="10%"></td>
</TR>

</table>

</div>

</td>
	  </tr>

	<tr bgcolor="#FFFFCC">

		<td colspan="2" bgcolor="#FF9933">

			<br>

			<br>

		<font size="5">Personal Information:<br>

		<br></font>		</td>
	</tr><tr bgcolor="#FFFFFF">



		<td width="250" class="sTD"><label><span class="style1">*</span>First Name</label></td>

		<td width="576" class="sTD"><input name="Your_name" type="text" id="Your_name" size="40" maxlength="39" style="text-transform:uppercase;" required></td>

	</tr><tr>

		<td style="padding-left:26px;"><label>Middle Name</label></td>

		<td>



			<input name="U_name" type="text" id="U_name" size="40" maxlength="39" style="text-transform:uppercase;" >

		&nbsp;&nbsp;</td>

	</tr><tr>



		<td class="sTD"><span class="style1">*</span><label>Last Name</label></td>

		<td class="sTD"><input name="U_lname" type="text" id="U_lname" size="40" maxlength="39" style="text-transform:uppercase;" required></td>

	</tr><tr>
            <tr>



		<td class="sTD"><span class="style">*</span><label>Mobile Number</label></td>

		<td class="sTD"> <input type="text" name="gmobnum" id="gmobnum" required="required" pattern="[0-9]{10}"  ></td>

	</tr><tr>
		<td><label><span class="style2">*</span>Guardian's Name</label></td>
		<td><input name="U_gname" type="text" id="U_gname" size="40" maxlength="39" style="text-transform:uppercase;" required> 
	</tr><tr>
		<td class="sTD"><label><span class="style2">*</span>Relation</label></td>
		<td class="sTD">
			<select id="g_relation" name="g_relation" onChange="displayR();" required>
				<option value="">Choose Relation</option>
				<option value="Father" >Father</option>
				<option value="Mother">Mother</option>
				<option value="Uncle">Uncle</option>
				<option value="Aunt">Aunt</option>
				<option value="Husband">Husband</option>
				<option value="Other">Other</option>
			</select>	
            &nbsp;&nbsp;<span id="other_R" style="visibility:hidden"><span class="style2">*</span>Other Relation

	      <input name="R_other" type="text" id="R_other" size="20" maxlength="29" style="text-transform:uppercase;" required>

	      </span>	</td>

	</tr>

	<tr>

      <td><label><span class="style2">*</span>Occupation</label></td>

	  <td><label for="label"></label>

	    <label for="label"></label>
        <select name="occu" id="occu" required="required" onChange="displayO()" >
              <option value="">Choose Occupation</option>
              <option value="Service">Service</option>
              <option value="Self Employed">Self Employed</option>
              <option value="Professional">Professional</option>
              <option value="House Hold">House Hold</option>
              <option value="Retaired Person">Retired Person</option>
              <option value="others">Other</option>
        </select>
        <span id="other_O" style="visibility:hidden"><span class="style2">*</span>
        Other Occupation  <input type="text" name="othrOccu" id="othrOccu">
        </span>
          </td>
	</tr>

	<!--<tr>

      <td class="sTD" style="padding-left:26px;"><label>Designation</label></td>

	  <td class="sTD"><label for="label2"></label>

	    <input type="text" name="desi" id="desi" style="text-transform:uppercase;"></td>
	  </tr>-->
        <input type="hidden" name="desi" id="desi" >
	<tr>

	  <td style="padding-left:26px;">Monthly Income </td>

	  <td><label for="label3"></label>

	    <select name="income" id="income">

	      <option value="<5000">&lt;5000</option>

	      <option value="5000-10000">5000-10000</option>

	      <option value="10001-20000">10001-20000</option>

	      <option value=">20000">&gt;20000</option>
	      </select>	    </td>
	  </tr>

	<tr>

	  <td class="sTD"><span class="style2">*</span>Gender</td>

	  <td class="sTD"><input name="radio2" type="radio" id="radio2" value="M" required="required"> Male

		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <input name="radio2" type="radio" id="radio2" value="F">

        Female &nbsp;&nbsp;&nbsp;

        <input name="radio2" type="radio" id="radio3" value="T">

        Trans-Gender</td>
	  </tr>

	<tr>

	  <td><span class="style2">*</span>Date of Birth(MM/DD/YYYY)</td>

	  <td><span class="sTD"><br>

                  <input type="text" value="" required="required" name="theDate" id="theDate" />

	  </span></td>
	  </tr>

	<tr>

	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Category</td>

	  <td class="sTD">     <input name="radio3" type="radio" id="gen" value="GEN" checked="" required="required">General

	    &nbsp;&nbsp;&nbsp;&nbsp;

      
	    <input name="radio3" type="radio" id="sc" value="SC">SC     &nbsp;&nbsp;

  <input name="radio3" type="radio" id="st" value="ST">ST

	    &nbsp;&nbsp;&nbsp;&nbsp;
		<input name="radio3" type="radio" id="obca" value="OBC-A">OBC A &nbsp;&nbsp;

	  <input name="radio3" type="radio" id="obcb" value="OBC-B">OBC B &nbsp;&nbsp;
 </td></tr>

	<tr>
	  <td><span class="style2">*</span>Physically Challenged</td>
	  <td>
	  <input name="ph_radio3" type="radio" id="ph_radio3" value="YES" required="required">

	    YES     &nbsp;&nbsp;&nbsp;&nbsp;

     <input name="ph_radio3" type="radio" id="ph_radio3" value="NO" checked="checked">

	    NO	  </td>
	  </tr>
	<tr>
	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Religion</td>
	  <td class="sTD"><label>
      <select name="religion" id="religion" onChange="displayRelign()" required="">
      	<option value="">Select</option>
        <option value="Hindu">Hindu</option>
        <option value="Muslim">Muslim</option>
        <option value="Christian">Christian</option>
        <option value="others">Other</option>
      </select>
      <span id="other_relig" style="visibility:hidden"><span class="style2">*</span>Other Religion 
	    <input type="text" name="other_religion" value=" " id="other_religion" style="text-transform:uppercase" required="required">
        </span>
	  </label></td>
	  </tr>
	<tr>

      <td><span class="style2">*</span>Nationality</td>

	  <td><span class="sTD">

	    <select name="select7" id="select7" onChange="return otherNation();" required="required">
		  <option value="">Choose Nationality</option>
	      <option value="INDIAN" selected>INDIAN</option>
	      <?php /*?><option value="Nepali">Nepali</option>
	      <option value="Bhutiya">Bhutiya</option>
          <option value="Bangladeshi">Bangladeshi</option>
	      <option value="Pakistani">Pakistani</option>
	      <option value="Other">Others</option><?php */?>
        </select>

		<span id="other_Nation" style="visibility:hidden">

	    <span class="style2">*</span>Other Nationality

	  <label for="textfield"></label>

	  <input type="text" name="nationother" id="nationother" style="text-transform:uppercase;" >
</span> </span></td>
	  </tr>

	<tr>

      <td bgcolor="#FF0000" class="sTD"><label><span class="style2">*</span>Present Address </label></td>

	  <td class="sTD"><label for="textfield">

	    <textarea name="p_address" id="p_address" rows="5" cols="30" style="text-transform:uppercase;" required="required" maxlength="200"></textarea>

	    <span class="style2">*</span>Pincode

	  </label>

	    <input type="text"  pattern="[0-9]{6}" name="pin1" id="pin1" required="required">

	    <label for="textfield"><br>

	    <font color="Gray">&nbsp;&nbsp;&nbsp;&nbsp;Upto 200 characters only.</font>	    </label></td>
	</tr>

	<tr>

      <td><label><span class="style2">*</span>Country</label></td>

	  <td><label for="label"></label>

	    <select name="select4" id="select4" onChange="return countrychange();" >
              <option value="INDIA" selected>INDIA</option>
             
        </select>

	    &nbsp;&nbsp; <span id="other_C" style="visibility:hidden"><span class="style2">*</span>Country Name

	      <input name="Co_others" type="text" id="Co_others" size="20" maxlength="29" style="text-transform:uppercase;">

	      </span> </td>
	  </tr>

	<tr>

      <td class="sTD"><label><span class="style2">*</span>State</label></td>

	  <td class="sTD"><span class="sTD" id="india_state" style="width:400px;">

	  <select name="select10" id="select10"  required="required">
      	<option value="">Choose State</option>
		<?php 
		$State_query=mysql_query("select * from states");
		while($states=mysql_fetch_array($State_query)){
		?>
		<option value="<?=$states["id"]?>"><?=$states["name"]?></option>
		<?php }?>
	  </select>

	  </span></td>
	  </tr>

	<tr>

      <td><label><span class="style2">*</span>District</label></td>

	  <td><span class="sTD" id="districtList" style="width:400px;">

	    <select name="D2" id="D2" required="required">

          <option value="">Choose District</option>

        </select>

	  </span></td>
	  </tr>

	<!--<tr>

      <td height="52" bgcolor="#FF0000" class="sTD" style="padding-left:26px;"><label>Phone Number</label></td>

	  <td class="sTD"><label for="textfield"></label>

          <label for="label">

          <input name="U_phone22" type="text" id="U_phone22" size="6" placeholder="STD Code" onBlur="phnChk()">

            <input name="U_gname222" type="text" id="U_gname222" size="20" maxlength="39" placeholder="Phone No" pattern="[0-9]{10}" onBlur="phnChk()">
</label></td>
	  </tr>-->
          <input name="U_gname222" type="hidden" id="U_gname222" value="">
	<tr>

      <td><span class="style2">*</span>Email Address </td>

	  <td><label for="textfield"></label>

          <label for="textfield"></label>

          <input name="email" type="email" id="email" size="50" maxlength="50" required="required"></td>
	  </tr>

	<tr>

	  <td bgcolor="#FF0000" class="sTD"><span class="style2">*</span>Permanent Address</td>

	  <td class="sTD">Same as Present Address

	    <input name="radiopar" type="radio" value="yes" id="radiopar" checked="checked" onClick="show_par_add('yes');">

	    Yes

	      <input name="radiopar" type="radio" value="no" id="radiopar" onClick="show_par_add('no');">

	      <label for="radio">No<br>
	      </label>

	      <span id="par_add" style="width:10000px;">&nbsp;</span>

	     </td>
	  </tr>

	<!-- ************************************************** -->

	<tr id="p1" style="display:none">

      <td><label><span class="style2">*</span>Country</label></td>

	  <td><label for="label"></label>

	    <label for="label"></label>

	     <select name="select12" id="select12" onChange="return pcountrychange();">

	       <option value="INDIA" selected="">INDIA</option>
<?php /*?>
	       <option value="NEPAL">NEPAL</option>

	       <option value="BHUTAN">BHUTAN</option>

            <option value="BANGLADESH">BANGLADESH</option>

	       <option value="PAKISTAN">PAKISTAN</option>

	      <option value="OT">OTHERS</option><?php */?>
	      </select>

	     &nbsp;&nbsp;

		 <span id="pother_C" style="visibility:hidden"><span class="style2">*</span>Country Name

		<input name="Co_pothers" type="text" id="Co_pothers" size="20" maxlength="29" style="text-transform:uppercase;"></span>        </td>
	  </tr>

	<tr id="p2" style="display:none">

      <td class="sTD"><label><span class="style2">*</span>State</label></td>

	  <td class="sTD"><span class="sTD" id="pindia_state" style="width:400px;">

	  <select name="select13" id="select13">
     <option value="">Choose State</option>
		<?php 
		$State_query=mysql_query("select * from states");
		while($states=mysql_fetch_array($State_query)){
		?>
		<option value="<?=$states["id"]?>"><?=$states["name"]?></option>
		<?php }?>
	  </select>

	  </span>

	    <label for="label"></label></td>
	</tr>

	<tr id="p3" style="display:none">

      <td><label><span class="style2">*</span>District</label></td>

	  <td><span class="sTD" id="pdistrictList" style="width:400px;">

	  	<select name="D3" id="D3">
      		<option value="">Choose District</option>
        </select>

      </span>

	    <label for="label2"></label></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="p4" style="display:none">

      <td class="sTD" style="padding-left:26px;"><label>Phone Numbers </label></td>

	  <td class="sTD"><label for="label4"></label>

	    <input type="text" name="pphone" id="pphone"></td>
	</tr>

	<tr>

      <td><label><span class="style2">*</span>Local Guardian</label></td>

	  <td><!--<span class="sTD" id="districtList" style="width:400px;">

      </span>-->

          <label for="textfield"></label>

          Same as Guardian

          <input name="radiolocal" type="radio" value="yes" id="radiolocal" checked="checked" onClick="show_local('yes');">

          Yes

          <input name="radiolocal" type="radio" value="no" id="radiolocal" onClick="show_local('no');">

          <label for="radio5"></label>

          <label for="radio4"></label>

          No

        <label for="label2"></label></td>
	  </tr>

	<tr bgcolor="#FFFFFF" id="g1" style="display:none">

	  <td class="sTD"><span class="style2">*</span>Local Guardian's Name </td>

	  <td class="sTD"><label for="label3"></label>

	    <input type="text" name="lgname" id="lgname"  style="text-transform:uppercase;"></td>
	  </tr>

	<tr id="g2" style="display:none">

      <td><span class="style2">*<span class="style10">Relation with the Candidate</span></span></td>

	  <td><label for="label2"></label>

	    <select name="select14" id="select14" onChange="show_R();" >

          <option value="Father" selected="selected">Father</option>

          <option value="Mother">Mother</option>

          <option value="Uncle">Uncle</option>

          <option value="Aunt">Aunt</option>

          <option value="Husband">Husband</option>

          <option value="Other">Other</option>
          </select>

	    <span class="style2">

	      <label for="textfield"> <span class="style10"></span></label>
	      </span>

	      <label for="textfield"><span class="sTD"><span id="grelation" style="visibility:hidden">

          <span class="style2">*</span>Other Relation

		  <input type="text" name="lgother" id="lgother"  style="text-transform:uppercase;">

	              </span></span></label></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="g3" style="display:none">

	  <td class="sTD"><span class="style2">*</span>Local Guardian's Address</td>

	  <td class="sTD"><textarea name="localA" cols="30" rows="5" id="localA" style="text-transform:uppercase;" ></textarea>

	    <span class="style2"> *</span>Pincode

	      <label for="label"></label>

	      <input type="text" name="textfield6" id="textfield6" pattern="[0-9]{6}"></td>
	  </tr>

	<tr id="g4" style="display:none">

	  <td style="padding-left:26px;">Phone Numbers</td>

	  <td><span class="sTD">

	    <input type="text" name="lgphone" id="lgphone">

	  </span>Mobile Number 

	  <label for="label2"></label>

	  <input type="text" name="textfield5" id="textfield5" ></td>
	</tr>

	<tr bgcolor="#FFFFFF" id="g5" style="display:none">

      <td class="sTD" style="padding-left:26px;"><label>Email Address </label></td>

	  <td class="sTD"><label for="label4"></label>

          <label for="label">

          <input name="textfield3" type="email" id="textfield3" size="30" maxlength="30">
        </label></td>
	  </tr>

	<tr bgcolor="#FFFFCC">

		<td colspan="2" bgcolor="#FF9933">

			<br>

			<br>

		<font size="5">Academic Information:<br>

		<br></font>		</td>
	</tr><tr>

		<td class="sTD"><label><span class="style2">*</span>Board/Council (10+2)</label></td>

		<td class="sTD">

			<select id="U_council" name="U_council" style="width:110px;">

				<option value="WBCHSE" selected="">WBCHSE</option>

				<option value="CBSE">CBSE</option>

				<option value="ISC">ISC</option>
                                <option value="VISVA BHARATI">VISVA BHARATI</option>

				<option value="WB Vocational Board of Education">WB Vocational Board of Education</option>

				<option value="Rabindra Mukto Vidyalaya">Rabindra Mukto Vidyalaya</option>
                                <option value="WB Board of Madrasha Education">WB Board of Madrasha Education</option>
				
			</select>

		&nbsp;&nbsp;&nbsp;

		<span id="other_B" style="visibility:hidden"><span class="style2">*</span>Board Name

		<input name="Uv_others" type="text" id="Uv_others" size="30" maxlength="30" style="text-transform:uppercase;" required="required" value=" ">
		</span>		</td>

	</tr>

	<tr>

	  <td><span class="style2">*</span>Roll No/Index Number </td>

	  <td><span class="sTD">

	    <input name="U_roll2" type="text" id="U_roll2" size="30" maxlength="6" style="text-transform:uppercase;" required="required">&nbsp;<span id="other_roll" style="visibility:visible"><span class="style2">*</span>Number

		<input name="U_roll3" type="text" id="U_roll3" size="30" maxlength="5" style="text-transform:uppercase;" required="required">

		</span><span class="style9">

	    </span></span></td>
	  </tr>

	<tr>
        <!-- YEAR OF PASSING -->
        <?php include "../fragments/year_of_passing.php"; ?>
        <!-- END -->
	  </tr>

	<tr>

	<td height="22" colspan="2" align="left"><h3><span class="style2">*</span>Marks obtained in H.S. or equivalent (10+2) Exams :</h3>

	  <p class="style8"><strong> Do not enter marks of Compulsory Environment Studies/Education/Science in the marks obtained field </strong></p></td>
    </tr><tr>
    
<?php 
	$sub_query=mysql_query("SELECT * FROM `subject_master` WHERE 1");
	while($sub_f=mysql_fetch_array($sub_query)){
		$subid[]=$sub_f["Subject_Id"];
		$subname[]=$sub_f["Subject_Name"];
	}
?>
                   
      <td align="center" colspan="2">

          <table border="0" width="90%" style="border:1px solid #aaa;">

            <tbody><tr>

              <td width="50%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Subjects</b> (as mentioned in your Mark-Sheet)</span></td>

              <!--?php

              	$query=mysql_query("select title from subjects order by title");

              	$Subjects= Array();

              	while($result = mysql_fetch_array($query,MYSQL_ASSOC)) $Subjects[] = strtoupper($result['title']);

              ?-->

              <td class="mTD" width="26%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Marks Obtained</b></span></td>

              <td class="mTD" width="24%" height="39" bgcolor="#C0C0C0"><span class="style3"><b>Full Marks</b></span></td>

              <td class="mTD" width="24%" bgcolor="#C0C0C0"><span class="style3"><b>Remarks</b></span></td>
            </tr>

            <tr>

              <td width="50%" height="23" bgcolor="#E0E0E0">

              		<b>1&nbsp;&nbsp;&nbsp;</b>
                    <span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>
                    
<select name="s1" id="s1" style="width:200px;" onChange="checkSubjects(1);" required>
					<option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select>             </td>

              <td class="mTD" width="26%" height="23" bgcolor="#E0E0E0"><input type="text" name="m1" id="m1" size="6" maxlength="3" onBlur="checkMarks(1);" disabled="" required></td>

              <td class="mTD" width="24%" height="23" bgcolor="#E0E0E0"><input type="text" name="full1" id="full1" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade1" id="grade1" value="PASS"/>

                <!--<option value="" selected="selected">Select</option>

                <option value="PASS">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>

                            </select>-->PASS</td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>2&nbsp;&nbsp;&nbsp;</b>
					<span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>
					<select name="s2" id="s2" style="width:200px;" onChange="checkSubjects(2);" required>
                    <option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select>

       		  <!--input type="text" name="s2" id="s2" size="42" style="text-transform:uppercase;"-->              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m2" id="m2" size="6" maxlength="3" onBlur="checkMarks(2);" disabled="" required></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full2" id="full2" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade2" id="grade2" value="PASS"/><!--<select name="grade2" id="grade2" required>

			  <option value="" >Select</option>

                          <option value="PASS" selected="">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>
              </select>      -->PASS        </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>3&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject3" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject31" style="width:400px;"></span>

					<select name="s3" id="s3" style="width:200px;" onChange="checkSubjects(3);" required>
                    <option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select>

              		<!--input type="text" name="s3" id="s3" size="42" style="text-transform:uppercase;"-->              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m3" id="m3" size="6" maxlength="3" onBlur="checkMarks(3);" disabled="" required></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full3" id="full3" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade3" id="grade3" value="PASS"/><!--<select name="grade3" id="grade3" required>

			  <option value="" selected="selected">Select</option>

                <option value="PASS">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>

              </select>     -->PASS         </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>4&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject4" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject41" style="width:400px;"></span>

					<select name="s4" id="s4" style="width:200px;" onChange="checkSubjects(4);" required>
                    <option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select>              </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m4" id="m4" size="6" maxlength="3" onBlur="checkMarks(4);" disabled="" required></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full4" id="full4" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade4" id="grade4" value="PASS"/><!--<select name="grade4" id="grade4" required>

			  <option value="" selected="selected">Select</option>

                <option value="PASS">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>

              </select>       -->PASS       </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>5&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject5" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject51" style="width:400px;"></span>
					<select name="s5" id="s5" style="width:200px;" onChange="checkSubjects(5);" required>
                    <option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
               		</select> </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m5" id="m5" size="6" maxlength="3" onBlur="checkMarks(5);" disabled="" required></td>

              <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full5" id="full5" size="6" maxlength="3" value="100" disabled="" required></td>

              <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade5" id="grade5" value="PASS"/><!--<select name="grade5" id="grade5" required>

			  <option value="" selected="selected">Select</option>

                <option value="PASS">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>

              </select>      -->PASS        </td>
            </tr>

            <tr>

              <td width="50%" height="19" bgcolor="#E0E0E0">

              		<b>6&nbsp;&nbsp;&nbsp;</b>

					<span class="sTD" id="subject6" style="width:400px;">&nbsp;</span>

                    <span class="sTD" id="subject61" style="width:400px;"></span>

					<select name="s6" id="s6" style="width:200px;" onChange="checkSubjects(6);" required>
                    <option value="">Select Subject</option>
					<?php for($i=0;$i<sizeof($subid);$i++)echo '<option value="'.$subid[$i].'">'.$subname[$i].'</option>';?>
                    </select> </td>

              <td class="mTD" width="26%" height="19" bgcolor="#E0E0E0"><input type="text" name="m6" id="m6" size="6" maxlength="3" onBlur="checkMarks(6);" disabled="" required></td>

             <td class="mTD" width="24%" height="19" bgcolor="#E0E0E0"><input type="text" name="full6" id="full6" size="6" maxlength="3" value="100" disabled="" required></td>

             <td class="mTD" width="24%" bgcolor="#E0E0E0"><input type="hidden" name="grade6" id="grade6" value="PASS"/><!--<select name="grade6" id="grade6" required>

			  <option value="" selected="selected">Select</option>

               <option value="PASS">PASS</option>
				<option value="FAIL">FAIL</option>
                <option value="NA">NA</option>
              </select>        -->PASS      </td>
            </tr>
          </tbody></table>      </td>

   </tr>
   
   
   

    <tr>

      <td colspan="2"><span class="style8"><span class="style6"><span id="chkStatusText">Top Five Subjects + Honors Subject (For Honors) and Top Five Subjects (for General) </span>

          <input type="text" name="m12" id="m12" size="6" maxlength="3" readonly="" onBlur="checkMarks(1);">
           
	&nbsp;<span id="best4"><b></b></span>
    &nbsp;&nbsp;<span id="best4" style="visibility: hidden;"></span></span></td>
    </tr>
    
    
    
    
    
</tbody>



</table>
<?php 

$HOME_PAGE_PAYMENT_OPTION = $admin->getAdmissionConstant("HOME_PAGE_PAYMENT_OPTION")->DESCRIPTION; 


if($HOME_PAGE_PAYMENT_OPTION == "YES"){
	
	$amount_deposited = $admin->getAdmissionConstant("APPLICATION_FEE")->DESCRIPTION;
	$bank_name = $admin->getAdmissionConstant("BANK_NAME")->DESCRIPTION; 
?>

  <table width="870" border="0">

    <!-- ************************************************** -->



    <tbody><tr id="p1" style="display:none">



      <td width="139">&nbsp;</td>



      <td width="653">&nbsp;</td>



    </tr>

<tr bgcolor="#FFFFCC">

		<td colspan="2" bgcolor="#FF9933">

			<br>

			<br>

		<font size="5">Payment Information:<br>

		<br></font>		</td>
	</tr>
<tr>

<td width="250" class="sTD"><label><span class="style1">*</span>Amount Deposite</label></td>

		<td width="576" class="sTD"><input name="tst1" type="text" id="" size="40" maxlength="39" style="text-transform:uppercase;" required value="<?php echo $amount_deposited;?>" readonly class="sTD"></td>
</tr>
<tr>
<td width="250" class="sTD"><label><span class="style1">*</span>Payment Date(MM/DD/YYYY)</label></td>

		<td width="576" class="sTD"><input type="text" value="" required name="Payment_date" id="Payment_date" /></td>
</tr>
<tr>
<td width="250" class="sTD"><label><span class="style1">*</span>Bank Name</label></td>

		<td width="576" class="sTD"><input name="tst3" type="text" id="" size="40" maxlength="39" style="text-transform:uppercase;" required value="<?php echo $bank_name; ?>" class="sTD" readonly></td>
</tr>
<tr>
<td width="250" class="sTD"><label><span class="style1">*</span>Branch</label></td>

		<td width="576" class="sTD"><input name="branch_name" type="text" id="branch_name" size="40" maxlength="39" style="text-transform:uppercase;" required value=""></td>
</tr>
  </tbody></table>
<?php } ?>
  <br>

<br>

<br><hr><br><center>

<input type="checkbox" id="iV" name="iV" value="1" onChange="show_submit();" required><label for="iV"><font size="4"> I confirm that all the values entered are correct</font></label>

<br><br>
<span id="showsubmit" style="visibility:visible">

<input type="submit" value="Submit" name="submit" id="submit" class="Submit_reset" >

<input name="reset" type="reset" value="Reset" id="reset" class="Submit_reset" onClick="hide_submit()"></span>



</center>

</center>

</form><?php } else {
?>

<div><h1>Admission for the session 2018-2019 will open on 11-Jun-2018</h1></div>
<?php }?>
<div id="div1"></div>
</body></html>