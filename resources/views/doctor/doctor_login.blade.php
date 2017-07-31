<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Site</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="" rel="stylesheet">
</head>
<body>
{!! Form::open(["url"=>"/doctor/login", "method"=>"post"] ) !!}
id number:<br>
  <input type="text" name="id_num" value="">
  <br>
password:<br>
  <input type="password" name="password" value="">
  <br><br>
  <input type="submit" value="Submit">
{!! Form::close() !!}
</body>
</html>
