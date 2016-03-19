@extends('master')




@section('content')
<div class="row ">
	<div class="col-md-7">

			<form action="" method="POST" role="form">
				{{ csrf_field() }}
				<h3 class="text-center">{{$jezik['add']}}</h3>
			
				<div class="form-group">
					<label for="naslov">{{$jezik['title']}}</label>
					<input type="text" class="form-control naslov_input" id="naslov" name="naslov" placeholder="{{$jezik['title']}}">
				</div>
				<div class="form-group">
					<label for="opis">{{$jezik['desc']}}</label>
					<textarea name="opis" id="opis" placeholder="{{$jezik['desc']}}" class="form-control opis_textarea" rows="10" required="required"></textarea>
				</div>
				
			
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
	</div>
	



			@if(isset($error))
			<div class="col-md-5">
		<div class="alert alert-danger alert-dismissible upozorenje" role="alert">
  		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p class="text-center"><span class="glyphicon glyphicon-exclamation-sign"></span> Greška</p>
				<p>Vec postoji zadatak s naslovom "{{$naslov}}". Molim vas unesite drugi naslov.</p>
					</div>
			</div>
			@endif
	
</div>
@endsection