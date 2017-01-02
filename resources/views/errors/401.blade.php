@extends('errors.base', ['meta_title' => trans('errors.401')])

@section('content')
401<br>{{ trans('errors.401.text') }}
@endsection
