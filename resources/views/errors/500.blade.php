@extends('errors.base', ['metaTitle' => trans('errors.500')])

@section('content')
500<br>{!! trans('errors.500.text') !!}
@endsection
