@extends('layouts.public')

@section('content')
	<table class="table table-striped text-center" style="table-layout: fixed">
		<thead>
			<tr>
				<th scope="col">{{ __('report.table.days') }}</th>
				<th scope="col">{{ __('report.table.breakfast') }}</th>
				<th scope="col">{{ __('report.table.middle') }}</th>
				<th scope="col">{{ __('report.table.lunch') }}</th>
				<th scope="col">{{ __('report.table.middle') }}</th>
				<th scope="col">{{ __('report.table.dinner') }}</th>
				<th scope="col">{{ __('report.table.middle') }}</th>
				<th scope="col">{{ __('report.table.before_bed') }}</th>
				<th scope="col">{{ __('report.table.night') }}</th>
				<th scope="col">{{ __('report.table.other') }}</th>
			</tr>
		</thead>
		<tbody>
		@foreach($days as $date => $day)
		<tr>
			<th scope="row" class="align-middle">{{ $date }}</th>
			@for($i = 0; $i <= 8; $i++)
				@if( empty($day[$i]) )
					<td> </td>
				@else
					<td>
						@foreach($day[$i] as $entry)
							@include('include.entry_box', $entry)
						@endforeach
					</td>
				@endif
			@endfor
		</tr>
		@endforeach
		</tbody>
	</table>
@endsection