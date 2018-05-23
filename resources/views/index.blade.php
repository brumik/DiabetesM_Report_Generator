@extends('layouts.public')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>{{ __('upload.title') }}</h1>
    {{ Form::open(['route' => 'upload.store', 'method' => 'post', 'files' => true ]) }}
        <div class="form-group">
            {{ Form::label('csv_file', __('upload.form.csv_file')) }}
            {{ Form::file('csv_file', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('max_days', __('upload.form.max_days')) }}
            {{ Form::number('max_days', 90, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit(__('upload.form.upload')) }}
    {{ Form::close() }}
@endsection