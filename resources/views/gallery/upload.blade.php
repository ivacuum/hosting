@extends('gallery.base')

@section('content')
<gallery-uploader
  action="@lng/gallery/upload"
  max="10"
></gallery-uploader>
@endsection
