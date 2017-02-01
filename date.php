<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link type="text/css" href="../demoengine/demoengine.css" rel="stylesheet">
	<script type="text/javascript" src="../demoengine/demoengine.js" async defer></script>
	<title>jQuery UI Datepicker: Set Date on Page Load</title>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
</head>
<body>
	<input id="datepicker" type="text">
	<script type="text/javascript">
		/*
		 * jQuery UI Datepicker: Set Date on Page Load
		 * http://salman-w.blogspot.com/2013/01/jquery-ui-datepicker-examples.html
		 */
		$(function() {
			$("#datepicker").datepicker();
			$("#datepicker").datepicker("setDate", new Date);
		});
	</script>
</body>
</html>