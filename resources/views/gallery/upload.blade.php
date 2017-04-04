@extends('gallery.base')

@section('content')
<gallery-uploader action="{{ path('Gallery@uploadPost') }}" max="10"></gallery-uploader>
@endsection
