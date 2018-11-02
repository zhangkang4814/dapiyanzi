@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	@if (session() -> has($msg))
		<div class="flash-message">
			<p class="alert alert-{{ $msg }}">
				{{ session() -> get($msg) }}
			</p>
	    </div>
	    <script>
		    setTimeout(function(){
		    	$('.flash-message').hide();
		    },2000)
	    </script>
	@endif
@endforeach
