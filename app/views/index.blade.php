@extends('layouts/default')
@section('content')

	<div class="panel panel-default">
		<div class="panel-body" id="posts-container">

		</div>
	</div>

	@if(Session::has('error'))
		<div class="alert alert-danger" style="display: none">{{{Session::get('error')}}}</div>
	@endif
	@if(Session::has('success'))
		<div class="alert alert-success" style="display: none">{{{Session::get('success')}}}</div>
	@endif
	<div class="panel panel-default">
		@if(!Auth::check())
			<div class="panel-heading">Login or Register</div>
			<div class="panel-body">
				<div class="form-body" id="form-container">
					{{Form::open(['id' => 'login', 'url' => 'login','method' => 'POST'])}}
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									{{Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Your Name', 'minlength' => 3, 'required'])}}
									@if($errors->has('username'))
										<label for="username">{{{$errors->first('username')}}}</label>
									@endif
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									{{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your password', 'minlength' => 6, 'required'])}}
									@if($errors->has('password'))
										<label for="password">{{{$errors->first('password')}}}</label>
									@endif
								</div>
							</div>
							<div class="col-md-2">
								{{Form::submit('Login',['class' => 'btn btn-default btn-block'])}}
							</div>
						</div>
					{{Form::close()}}
				</div>
			</div>
		@else
			<div class="panel-heading">Hi, {{Auth::user()->username}}, {{link_to('logout','Logout')}}</div>
			<div class="panel-body">
				<div class="form-body" id="form-container">
					{{Form::open(['id' => 'post', 'url' => 'post','method' => 'POST'])}}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{{Form::textarea('message', null, ['id' => 'message', 'class' => 'form-control', 'placeholder' => 'Your message', 'rows' => 3, 'minlength' => 2, 'required'])}}
							</div>
						</div>
						<div class="col-xs-12 visible-xs">
							{{Form::submit('Send',['id' => 'post-submit', 'class' => 'btn btn-default btn-block'])}}
						</div>
					</div>
					{{Form::close()}}
				</div>
			</div>
		@endif
	</div>
@stop
@section('scripts')
<script>
var lastId = null;
$(function(){
	$("form#login").validate();
	$("form#post").validate();
	$('.alert').fadeIn().delay(2000).fadeOut();

	checkNewPosts();
	setInterval(checkNewPosts, 1000);

	$('#post-submit').on('click',function(e){
		e.preventDefault();
		if($('form#post').valid()){
			sendData();
		}
	});
});

$('form#post textarea#message').keypress(function(e){
	if (e.ctrlKey && (e.keyCode == 13 || e.keyCode == 10) && $(this).valid()) {
		sendData();
	}
});


function sendData(){
	var formPost = $('form#post');
	var messageInput = $('form#post textarea#message');
	messageInput.prop( "disabled", true );
	$.ajax({
		url: "/add-reply",
		type: "POST",
		dataType: "json",
		data: {message: messageInput.val()},
		success: function(response){
			if (response['status'] == 'error') {
				alert(response['message']);
				messageInput.prop( "disabled", false );
			} else {
				checkNewPosts();
				formPost[0].reset();
				messageInput.prop( "disabled", false );
			}
		}
	});
}

function checkNewPosts(){
	$.ajax({
		url: "posts",
		type: "post",
		data: {lastId: lastId},
		success: checkNewPostsCallback
	})
}

function checkNewPostsCallback(e){
	$("#posts-container").html(e);
}
</script>
@stop