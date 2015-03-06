@foreach($posts->sortBy('created_at') as $postData)
<div class="post">
	<p>{{{$postData->user->username}}} | {{$postData->created_at->diffForHumans()}}</p>
	<div class="message">
		{{{$postData->message}}}
	</div>
</div>
@endforeach