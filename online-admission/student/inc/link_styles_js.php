<?php
?>
    <link type="text/css" rel="stylesheet" href="../calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    <script type="text/javascript" src="../calendar/dhtmlgoodies_calendar.js?random=20060118">
    </script>
    <script type="text/javascript" src="../../jquery-ui-1.11.3/external/jquery/jquery.js">
    </script>
    <link rel="stylesheet" href="../../jquery-ui-1.11.3/jquery-ui.css">
    <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
    <link type="text/css" href="../../jquery-ui-1.11.3/jquery-ui.css" rel="stylesheet"/>
    <script src="../../jquery-ui-1.11.3/jquery-ui.js">
    </script>
    <script src="../../jquery-validation-1.13.1/dist/jquery.validate.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.core.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.widget.js">
    </script>
    <script src="../jquery-ui-1.10.4/ui/jquery.ui.tabs.js">
    </script>
    <style>
      .Submit_reset{
        width:65px;
        height:30px;
        cursor:pointer;
        background-color: #FF9933;
      }
      .sTD {
        background-color:#eee;
      }
      .mTD {
        padding-left:0px;
        text-align:center;
      }
      .style1 {
        color: #FF0000;
        font-weight: bold;
      }
      .style2 {
        color: #FF0000}
      .style8 {
        color: #000000;
        font-weight: bold;
      }
      .style3 {
        font-size: x-small}
      .style6 {
        color: #000000;
        font-weight: bold;
        font-size: 16px;
      }
      .style9 {
        color: #0000FF}
      .style10 {
        color: #000000}
      .style12 {
        font-size: large}
    </style>
    <script>
		$(document).ready(function() {		
		
		$('#dob-proof').change(function(){
			var ext = $('#dob-proof').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#dob-proof").val(null);
			}
		});
		$('#caste-proof').change(function(){
			var ext = $('#caste-proof').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#caste-proof").val(null);
			}	
		});
		$('#disability-cert').change(function(){
			var ext = $('#disability-cert').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#disability-cert").val(null);
			}	
		});
		$('#secondary-marksheet').change(function(){
			var ext = $('#secondary-marksheet').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#secondary-marksheet").val(null);
			}
		});
		$('#hs-marksheet'). change(function(){
			var ext = $('#hs-marksheet').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#hs-marksheet").val(null);
			}
		});
		$('#pp-photo'). change(function(){
			var ext = $('#pp-photo').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg','jpeg','pdf']) == -1) {
				alert('Invalid file extension!');
				$("#pp-photo").val(null);
			}
		});
	   });
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
        }
        else{
          document.getElementById("other_R").style.visibility="hidden";
          document.getElementById("R_other").value=" ";
        }
      }
      function displayO()
      {
        if(document.getElementById("occu").value=="others"){
          document.getElementById("other_O").style.visibility="visible";
          document.getElementById("othrOccu").value="";
        }
        else{
          document.getElementById("other_O").style.visibility="hidden";
          document.getElementById("othrOccu").value=" ";
        }
      }
      function displayRelign()
      {
        if(document.getElementById("religion").value=="others"){
          document.getElementById("other_relig").style.visibility="visible";
          document.getElementById("other_religion").value="";
        }
        else{
          document.getElementById("other_relig").style.visibility="hidden";
          document.getElementById("other_religion").value=" ";
        }
      }
      function otherNation()
      {
        if(document.getElementById("select7").value=="Other"){
          document.getElementById("other_Nation").style.visibility="visible";
          document.getElementById("nationother").value="";
        }
        else{
          document.getElementById("other_Nation").style.visibility="hidden";
          document.getElementById("nationother").value=" ";
        }
      }
      function countrychange()
      {
        if(document.getElementById("select4").value=="Other"){
          document.getElementById("other_C").style.visibility="visible";
          document.getElementById("Co_others").value="";
        }
        else{
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
        //calculate();
		calculate_kr();
      }
	  function calculate_kr(){
		marks =  new Array(6);
        for(j=1;j<=6;j++){
          if(!isNaN(parseInt(document.getElementById("m"+j).value)) &&document.getElementById("m"+j).disabled==false){
            //alert("ok");
              marks[j-1]=parseInt(document.getElementById("m"+j).value)*100/parseInt(document.getElementById("full"+j).value);
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
        var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4];
          document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five in Top (Total 500):";
        if(!isNaN(total))
          document.getElementById("m12").value=Math.round(total);
        else
          document.getElementById("m12").value="";
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
            }
            else{
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
        if(document.getElementById("select").value==4 || document.getElementById("select").value==13){
          //var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4]+marks[5];
          var total=marks[0]+marks[1]+marks[2]+marks[3]+marks[4]+(parseInt(document.getElementById("m1").value)*100/parseInt(document.getElementById("full1").value));
          document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five Subjects + Honors Subject: (Total 600)";
        }
        else{
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
        $("#s1").load('../ajax/allSubj.php');
        document.getElementById("m1").value="";
        document.getElementById("m1").disabled="true";
      }
      function CourseLevel() {
        course_level=document.getElementById("select").value;
        if (window.XMLHttpRequest){
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else{
          // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET",'../ajax/courseList.php?courseLevelId='+course_level,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            a=xmlhttp.responseText;
            y=Array();
            y=a.split("#");
            if(y[0]=='Success'){
              if(y[1]>0){
                document.getElementById("dOptPut").innerHTML=y[2];
                //document.getElementById("chkStatusText").innerHTML="Total Marks in Top Four Subjects + Honors Subject:";
              }
              else{
                document.getElementById("dOptPut").innerHTML="";
                document.getElementById("s1").innerHTML=y[3];
                //document.getElementById("chkStatusText").innerHTML="Total Marks in Top Five in Top:";
              }
            }
            else{
              document.getElementById("dOptPut").innerHTML="";
            }
          }
        }
      }
	  
      function subMand(){
		  var course_level = document.getElementById("select").value;
		  var courseId = document.getElementById("D1").value;
		  var user_id = document.getElementById("userid").value;
		  //alert("course_level:"+course_level+"courseId:"+courseId+"user_id:"+user_id);
		  if (course_level == null || course_level == ""||courseId == null || courseId == ""||user_id == null || user_id == "") {
         //txt = "Please enter your email";
		 //document.getElementById("demo").innerHTML = "Please enter your email";
       } else {
		 document.getElementById("checkmark").innerHTML = "Please wait...";  
		 $("#checkmark").load("../ajax/check_mansub_marks.php?user_id="+user_id+"&course_level="+course_level+"&courseId="+courseId);  
		 //document.getElementById("checkmark").innerHTML = "Back";  
	     //document.getElementById("demo").innerHTML = "Loading...";
	   }
		  
	  }
      /*function subMand() {
        courseId=document.getElementById("D1").value;
        if (window.XMLHttpRequest){
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }
        else{
          // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET",'../ajax/mandarorySubSelection.php?courseId=' +courseId,true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            a=xmlhttp.responseText;
            y=Array();
            y=a.split("#");
            //alert(y[1]);
            if(y[0]=='Success'){
              if(y[1]>0){
                //alert(y[0]);
                document.getElementById("s1").innerHTML=y[2];
              }
              else{
                //document.getElementById("s1").innerHTML="";
              }
            }
            else{
              document.getElementById("s1").innerHTML="";
            }
          }
        }
      }*/
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
		alert("JS Validation works");
        datevalid();
        return(true);
      }
    </script>
    <script>
      $(function () {
        $("#select10").change(function () {
          $("#D2").load('../ajax/dist.php?stateId=' + $(this).val());
        }
                             );
      }
       );
      $(function () {
        $("#select13").change(function () {
          $("#D3").load('ajax/dist.php?stateId=' + $(this).val());
        }
                             );
        $("#theDate").datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "1990:2016"
        }
                                );
        $("#Payment_date").datepicker({
          numberOfMonths: [2, 1]
        }
                                     );
      }
       );
    </script>