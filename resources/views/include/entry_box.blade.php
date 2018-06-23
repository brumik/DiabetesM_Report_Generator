@php
	$bg_color = "bg-success";
	if ( $entry->glucose > 10.0 ) $bg_color = "bg-danger";
	elseif ( $entry->glucose < 3.5 ) $bg_color = "bg-primary";
@endphp

@php($empty_row = '<p class="col-6 m-0 p-1">&nbsp;</p>')

<div class="border w-100 m-0 p-0">
	<div class="border-bottom row m-0">
		@if ( $entry->carb_bolus )
			<p class="col-6 m-0 p-1"><strong>A</strong>: {{ number_format($entry->carb_bolus, 1, '.', ' ') }}</p>
		@else
			{!! $empty_row !!}
		@endif
		@if ( $entry->glucose )
			<p class="col-6 m-0 p-1 text-white {{ $bg_color }}"><i class="diabetes icon-tint"></i> {{ number_format($entry->glucose, 1, '.', ' ') }}</p>
		@else
			{!! $empty_row !!}
		@endif
	</div>
	<div class="row m-0">
		@if ( $entry->basal )
			<p class="col-6 m-0 p-1"><strong>L</strong>: {{ number_format($entry->basal, 1, '.', ' ') }}</p>
		@else
			@if ( $entry->category == 8 )
				@php( $time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $entry->datetimeformatted)->format('H:i'))
				<p class="col-6 m-0 p-1"><i class="diabetes icon-clock"></i> {{ $time }}</p>
			@else
				{!! $empty_row !!}
			@endif
		@endif
		@if ( $entry->carbs )
			<p class="col-6 m-0 p-1"><i class="diabetes icon-food"></i> {{ number_format($entry->carbs/10, 1, '.', ' ') }}</p>
		@else
			{!! $empty_row !!}
		@endif
	</div>
</div>