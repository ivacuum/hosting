@extends('errors.base', ['meta_title' => trans('errors.503')])

@section('content')
503<br>{{ trans('errors.503.text') }}
@endsection
