@extends('gallery.base')

@section('content')
<gallery-uploader action="{{ action('Gallery@uploadPost') }}" max="10"></gallery-uploader>
@endsection
