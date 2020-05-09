$(document).ready(function(){
	
	
	
	function checkEmpty(jQuery) {
		try
		{
			var txt_taskname = $("#taskname").val().trim();
			var txt_year = $("#taskyyyy").val().trim();
			var txt_month= $("#taskmm").val().trim();
			var txt_day  = $("#taskdd").val().trim();
			var int_year = parseInt(txt_year);
			var int_month= parseInt(txt_month);
			var int_day  = parseInt(txt_day);
			var d;
			
			if(txt_taskname.length < 3)
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}
			
			if(isNaN(int_year))
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}

			if(isNaN(int_month))
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}

			if(isNaN(int_day))
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}
				
			d = new Date(int_year, int_month-1, int_day);
			if((d.getYear() != (int_year-1900)) &&
			   (d.getYear() != int_year))
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}
				
			if(d.getMonth() != (int_month-1))
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}
			
			if(d.getDate()!=int_day)
			{
				$("#save").prop("disabled", true);
				$("#save").attr("class", "buttondisabled");
				return;
			}
			
			
			
			$("#save").prop("disabled", false);
			$("#save").attr("class","button");
		}
		catch(e)
		{
		}
	}
	


	$(document).ready(function(){
		var d= new Date();
		$("#taskyyyy").val(d.getYear()+1900);
		$("#taskmm").val(d.getMonth()+1);
		$("#taskdd").val(d.getDate());
		
		checkEmpty(this);
	});

	$("#cancel").click(function(){
		document.location.href="index.php";
	});
	
	
	$("#taskname").keyup(checkEmpty);
	$("#taskyyyy").keyup(checkEmpty);
	$("#taskmm").keyup(checkEmpty);
	$("#taskdd").keyup(checkEmpty);
	
});