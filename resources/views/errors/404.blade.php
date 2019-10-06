@extends('errors.base', ['metaTitle' => trans('errors.404')])

@section('content')
404<br>{{ trans('errors.404.text') }}
@endsection
