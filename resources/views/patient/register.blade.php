<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Register</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="" rel="stylesheet">
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="flash-message">
      @if(Session::has('register_failed'))
      <p class="">{{ Session::get('register_failed') }} </p>
      @endif
</div>

Register as a  patient

{!! Form::open(["url"=>"/patient/register", "method"=>"post"] ) !!}
 {{ csrf_field() }}
ssn:<br>
  <input type="text" name="ssn" value="{{ old('ssn') }}">
  <br>

name:<br>
<input type="text" name="name" value="{{ old('name') }}">
<br>

password:<br>
  <input type="password" name="password" value="">
  <br><br>


<input type="submit" value="Submit">
{!! Form::close() !!}

</body>
</html>
