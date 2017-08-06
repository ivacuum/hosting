@extends('acp.show')

@section('content')
<a href="{{ $model->downloadPath() }}"></a>
@parent
@endsection
