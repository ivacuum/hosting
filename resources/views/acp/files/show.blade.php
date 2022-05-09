@extends('acp.show')

@section('content')
<a href="{{ $model->downloadPath() }}">@lang('Скачать')</a>
@parent
@endsection
