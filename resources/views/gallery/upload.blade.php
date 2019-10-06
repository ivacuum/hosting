@extends('gallery.base')

@section('content')
<gallery-uploader
  action="{{ path([App\Http\Controllers\Gallery::class, 'store']) }}"
  max="10"
></gallery-uploader>
@endsection
