@if (count($errors) > 0 || Session::has('error_message'))
	<div class="alert alert-danger">
		<strong>Whoops! Something went wrong!</strong>

		<br><br>

		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach

		<!-- Extra form errors -->
		@if(Session::has('error_message'))
			<li>{{ Session::get('error_message') }}</li>
		@endif
		</ul>
	</div>
@endif