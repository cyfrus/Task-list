@extends('master')

@section('content')
<div class="row">
   <div class="col-md-12">
   	<h1>{{$jezik['task_list']}}</h1>
   	<div class="summary">
	   	<div>
	   		{{$jezik['total_tasks']}}: {{$count}}
	   	</div>
	   	<div>
	   		<span class="glyphicon glyphicon-ok green"></span> {{$jezik['solved_tasks']}}: {{$solved}}
	   	</div>
	   	<div>
	   		<span class="glyphicon glyphicon-minus red"></span> {{$jezik['unsolved']}}: {{$unsolved}}
	   	</div>
	   	<div>
	   		
	   	</div>
   	</div>
   
   </div>
	
</div>
<div class="row">
	<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-hover table-bordered ">
				<thead>
					<tr>
						<th class="text-center">{{$jezik['open']}}</td>
						<th class="vert_align">{{$jezik['title']}}</th>
						<!-- <th class="vert_align">Opis</th> -->
						<th class="text-center vert_align">{{$jezik['status']}}</th>
						<th class="vert_align">{{$jezik['opendate']}}</th>
						<th class="vert_align">{{$jezik['exec_time']}}</th>
						<th class="text-center">{{$jezik['del']}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($zadaci as $zadatak)
					
					<tr>
						<td class="text-center"><a href="zadatak/{{$zadatak->id}}" class="btn btn-default"><span class="glyphicon glyphicon-edit
"></span></a></td>
						<td>{{$zadatak->naslov}}</td>
						<!-- <td>{{$zadatak->opis_zadatka}}</td> -->
						@if($zadatak->status)
						<td class="text-center"><span class="glyphicon glyphicon-ok zavrsen_ikona"></span></td>
						@else
						<td class="text-center"><span class="glyphicon glyphicon-minus nezavrsen_ikona"></span></td>
						@endif
						@if($zadatak->vrijeme_otvaranja != '0000-00-00 00:00:00')
						<td>{{date("H:i:s d-m-Y",strtotime($zadatak->vrijeme_otvaranja))}}</td>
						@else
						<td>{{$jezik['not_opened']}}</td>
						@endif
						@if($zadatak->datum_zavrsetka != '0000-00-00')
						<td>{{date("d-m-Y",strtotime($zadatak->datum_zavrsetka))}}</td>
						@else
						<td>{{$jezik['not_finished']}}</td>
						@endif
						<td class="text-center">
						<form action="{{route('deleteTask')}}" method="POST">
						<button type="submit" class="btn btn-default" name="id" value="{{$zadatak->id}}"><span class="glyphicon glyphicon-remove"></span></button></form></td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
			</div>

	</div>
</div>
	
@endsection