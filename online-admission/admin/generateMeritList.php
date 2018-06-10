<?php
include"top.php";
include"header.php";
include "../../classes/config.php";
include "../../classes/conn.php";
include "../../classes/admin_class.php";

$admin = new admin_class();
?>
<script src="../../jquery-ui-1.11.3/external/jquery/jquery.js"></script>
<script>

	function generateMeritList(){
		alert("generate button cicked");
		document.getElementById("GENERATE_BUTTON").style = "display:none";
		document.getElementById("loader").style = "display:block";
		var iteration = $("#hidden_iteration").val();
	    $.ajax({url: "ajax/generate_merit_list.php?MODE=ALL&iteration="+iteration, success: function(result){
	        $("#div1").html(result);
	        document.getElementById("loader").style = "display:none";
	    }});
	}

	function generateMeritList(course_id, course_level_id){
		alert("generate by course button cicked");
		document.getElementById("GENERATE_BUTTON_"+course_id+"_"+course_level_id).style = "display:none";
		document.getElementById("loader").style = "display:block";
		var iteration = $("#hidden_iteration").val();
		alert("ajax/generate_merit_list.php?MODE=SINGLE&iteration="+iteration+"&course_id="+course_id+"&course_level_id="+course_level_id);
	    $.ajax({url: "ajax/generate_merit_list.php?MODE=SINGLE&iteration="+iteration+"&course_id="+course_id+"&course_level_id="+course_level_id, success: function(result){
	        $("#div1").html(result);
	        document.getElementById("loader").style = "display:none";
	    }});
	}

	function publishMeritList(course_id, course_level_id){
		alert("Publish button cicked");
		document.getElementById("PUBLISH_BUTTON_"+course_id+"_"+course_level_id).style = "display:none";
		document.getElementById("loader").style = "display:block";
		var iteration = $("#hidden_iteration").val();
		alert("ajax/generate_merit_list.php?MODE=PUBLISH&iteration="+iteration+"&course_id="+course_id+"&course_level_id="+course_level_id);
	    $.ajax({url: "ajax/generate_merit_list.php?MODE=PUBLISH&iteration="+iteration+"&course_id="+course_id+"&course_level_id="+course_level_id, success: function(result){
			$("#div1").html(result);
	        document.getElementById("loader").style = "display:none";
	    }});
	}

	function updateMeritListFlag(){
		alert("update button cicked");
		document.getElementById("GENERATE_BUTTON").style = "display:none";
		document.getElementById("loader").style = "display:block";
		var iteration = $("#hidden_iteration").val();
	    $.ajax({url: "ajax/generate_merit_list.php?MODE=UPDATE_FLAG&iteration="+iteration, success: function(result){
	        $("#div1").html(result);
	        document.getElementById("loader").style = "display:none";
	    }});
	}

	
		
</script>

    
<?php 
	$result = $admin->getRankPublishDetails();
	$active = $result->Active;
	if($active == 1) {
		
?>
    <input type="BUTTON" id="GENERATE_BUTTON" value="GENERATE MERIT LIST"  onclick="generateMeritList()"/>
    <input type="HIDDEN" id="hidden_iteration" value="<?php echo $result->iteration ; ?>" name="ITERATION"/>
    
    <?php $query = "select
		a.courseid, a.course_name, b.course_level_name, b.course_level_id
		from course_table a, course_level b, course_seat_structure c
		where a.courseid = c.course_id and b.course_level_id = c.course_level_id";
		
		$result = mysql_query($query) or die(mysql_error());
		
		while($rows2 = mysql_fetch_array($result)){ ?>
    <div id="div2">
    <table border="1px;">
    <tr><td width="50"> <?php echo $rows2['course_level_name']; ?></td><td width="200"><?php echo $rows2['course_name']; ?></td>
    <td width="150"><input type="BUTTON" id="GENERATE_BUTTON_<?php echo $rows2['courseid']; ?>_<?php echo $rows2['course_level_id']; ?>" 
    		value="GENERATE MERIT LIST"  onclick="generateMeritList('<?php echo $rows2['courseid']; ?>','<?php echo $rows2['course_level_id']; ?>')"/></td>
    </tr>
	<?php } ?>
	</table>
	</div>
<input type="BUTTON" id="UPDATE_FLAG" value="UPDATE MERIT LIST FLAG"  onclick="updateMeritListFlag()"/>
<?php } else {?>
	<p>Merit List has been already generated for Merit List - <?php echo $result->iteration ; ?>
	<input type="HIDDEN" id="hidden_iteration" value="<?php echo $result->iteration ; ?>" name="ITERATION"/>
	<?php $query = "select
		a.courseid, a.course_name, b.course_level_name, b.course_level_id
		from course_table a, course_level b, course_seat_structure c
		where a.courseid = c.course_id and b.course_level_id = c.course_level_id";
		
		$result = mysql_query($query) or die(mysql_error());
		
		while($rows2 = mysql_fetch_array($result)){ ?>
    <div id="div2">
    <table border="1px;">
    <tr><td width="50"> <?php echo $rows2['course_level_name']; ?></td><td width="200"><?php echo $rows2['course_name']; ?></td>
    
    <td width="150"><input type="BUTTON" id="PUBLISH_BUTTON_<?php echo $rows2['courseid']; ?>_<?php echo $rows2['course_level_id']; ?>" 
    		value="PUBLISH MERIT LIST"  onclick="publishMeritList('<?php echo $rows2['courseid']; ?>','<?php echo $rows2['course_level_id']; ?>')"/></td></tr>
	<?php } ?>
	</table>
	</div>
<?php } ?>
<div id="loader" style="display:none;"><img alt="" src="./images/loading.gif"></div>

<div id="div1">
</div>


<?php include "footer.php";?>	