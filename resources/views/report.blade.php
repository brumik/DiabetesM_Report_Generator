<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Latest compiled and minified CSS -->
	{{--	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}
	<link rel="stylesheet" href="{{ asset('css/diabetes.css') }}">
	<link rel="stylesheet" href="{{ asset('css/mini.min.css') }}">

	<title>{{ env('APP_NAME') }}</title>
</head>
<body>
	<div class="container-fluid">

		<table id="table" class="table table-striped text-center" style="table-layout: fixed">
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
	</div>
</body>
</html>
