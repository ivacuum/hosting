@extends('base')

@push('head')
<meta content="article" property="og:type">
<meta content="{{ $metaTitle ?? '' }}" property="og:title">
<meta content="{{ canonical() }}" property="og:url">
<meta content="{{ $metaImage ?? '' }}" property="og:image">
<meta content="{{ $metaDescription ?? '' }}" property="og:description">
@endpush

@section('content_header')
<div class="antialiased hanging-puntuation-first lg:text-lg">
@endsection

@section('content_footer')
</div>
@endsection
