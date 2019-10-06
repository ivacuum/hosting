@extends('errors.base', ['metaTitle' => trans('errors.503')])

@section('content')
503<br>{{ trans('errors.503.text') }}
@endsection
