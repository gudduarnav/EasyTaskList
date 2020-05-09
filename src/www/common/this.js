$(document).ready(function(){
	function showTodayTask(jQuery){
		var q = $.ajax("query.php?q=0")
			.done(function(htmlcode) {
				$("#tasklist").html(htmlcode);
			});
	}
	
	function showAllTask(jQuery) {
		var q = $.ajax("query.php?q=1")
			.done(function(htmlcode) {
				$("#tasklist").html(htmlcode);
			});
	}

	function showTodayTaskDone(jQuery){
		var q = $.ajax("query.php?q=2")
			.done(function(htmlcode) {
				$("#tasklist").html(htmlcode);
			});
	}

	function showAllTaskDone(jQuery){
		var q = $.ajax("query.php?q=3")
			.done(function(htmlcode) {
				$("#tasklist").html(htmlcode);
			});
	}

	function removeTaskDone(jQuery){
		var q = $.ajax("query.php?q=4")
			.done(function(htmlcode) {
				$("#tasklist").html(htmlcode);
			});
	}

	
	$(document).ready(showTodayTask);
	$("#todo").click(showTodayTask);
	$("#todoall").click(showAllTask);
	$("#done").click(showTodayTaskDone);
	$("#doneall").click(showAllTaskDone);
	$("#deletedone").click(removeTaskDone);
	$("#addtask").click(function() {
		document.location.href="newtask.php";
	});
});