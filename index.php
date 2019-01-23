<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
	<title>Drag & Drop Multiple Files Upload</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<style>
	.dock {
		border: 4px dotted #cccccc;
		background-color: #ededed;
		width: 600px;
		height: 300px;
		color: #aaa;
		font-size: 18px;
		text-align: center;
		padding-top: 100px;
	}
	.dock_hover {
		border: 4px dotted #4d90fe;
		background-color: #e7f0ff;
		width: 600px;
		height: 300px;
		color: #4d90fe;
		font-size: 18px;
		text-align: center;
		padding-top: 100px;
	}
	</style>
</head>
 
<body>
 
<div class="container">
	<div class="row">
		<div class="col-md-9">
		
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
			</div>
 
			<div id="result"></div>
			
			<div align="center">
			<div id="dock" class="dock">Drag & Drop Photos Here</div>
			</div>
			
		</div>
	</div>
</div>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->

<script type="text/javascript" src="js/upload.js"></script>
 
</body>
</html>