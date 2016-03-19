@extends('master')

@section('content')

<div class="row show_zadatak_row vertical-align">
@if($zadatak->status)
	<div class="col-md-3 text-center div_zad_done">
		<span class="glyphicon glyphicon-ok zad_done"></span>
	</div>
	@else
	<div class="col-md-3 text-center div_zad_not_done">
		<span class="glyphicon glyphicon-minus zad_not_done"></span>
	</div>
	@endif
	<div class="col-md-9 vcenter">
		<div class="opis_zadatka">	
			 	<h3>{{$zadatak->naslov}}</h3>
			 	<div class=""><p>{{$zadatak->opis_zadatka}}</p></div>
			 	<!-- <div class="status">
			 		<button class="btn btn-default btn-lg">
			 			<span class="glyphicon glyphicon-ok"></span>
			 		</button>
			 	</div> -->

			 	@if($zadatak->datum_zavrsetka != "0000-00-00")
			 	<div class="datum_zav">{{$jezik['exec_time']}} {{$zadatak->datum_zavrsetka}}</div>
			 	@else
			 	<div class="datum_zav">{{$jezik['not_finished']}}</div>
			 	@endif

			 	@if($zadatak->vrijeme_otvaranja != '0000-00-00 00:00:00')
			 	<div class="pull-right datum_otvaranja">
			 		{{$jezik['opendate']}} -	 {{$zadatak->vrijeme_otvaranja}}
			 	</div>
			 	@else
			 	<div class="pull-right datum_otvaranja">
			 		{{$jezik['not_openedb']}}
			 	</div>
			 	@endif
		</div>
			 
	</div>
	
</div>
<div class="row">
	@if($zadatak->status)
		<form action="{{route('openTask',$zadatak->id)}}" method="POST">
			{{csrf_field()}}
			<button class="btn bnt-lg btn-default close_zad">{{$jezik['mark_as_unfinished']}}</button>
			
		</form>
	@else
		<form action="{{route('finishTask',$zadatak->id)}}" method="POST">
			<button class="btn bnt-lg btn-default close_zad">{{$jezik['mark_as_finished']}}</button>
		</form>
	@endif
</div>
@endsection