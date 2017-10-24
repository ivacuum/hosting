@extends('gallery.base')

@section('content')
<gallery-uploader action="{{ path('Gallery@store') }}" max="10"></gallery-uploader>
@endsection
