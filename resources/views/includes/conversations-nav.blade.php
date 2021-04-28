<h1>Conversations</h1>

@foreach($conversations as $c)
	<p><a href="/conversations/{{$c->slug}}">conversation</a></p>
@endforeach