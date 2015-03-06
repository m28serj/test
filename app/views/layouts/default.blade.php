<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	{{HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',['rel' => 'stylesheet'])}}
	{{HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css',['rel' => 'stylesheet'])}}

	{{HTML::style(asset('css/style.css'),['rel' => 'stylesheet'])}}
</head>
<body>
<div class="container" id="main-container">
	@yield('content')
</div>

{{HTML::script('//code.jquery.com/jquery-1.11.2.min.js')}}
{{HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js')}}
{{HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js')}}
{{HTML::script('//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js')}}

@yield('scripts')
</body>
</html>