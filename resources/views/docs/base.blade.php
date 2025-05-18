@extends('base')

@section('content_header')
<div class="flex w-full flex-auto justify-center">
  <div class="hidden lg:block lg:mr-16">
    <div class="sticky w-48 space-y-8 top-3 max-h-[calc(100vh-5rem)] overflow-x-hidden overflow-y-scroll">
      <div>
        <x-docs-sidemenu-title>@lang('Справка')</x-docs-sidemenu-title>
        <x-docs-sidemenu>
          <x-docs-sidemenu-item href="{{ to('docs/trips') }}">@lang('Поездки')</x-docs-sidemenu-item>
        </x-docs-sidemenu>
      </div>
      <div>
        <x-docs-sidemenu-title>@lang('Хостинг')</x-docs-sidemenu-title>
        <x-docs-sidemenu>
          <x-docs-sidemenu-item href="{{ to('docs/amazon-s3') }}">@lang('Amazon S3')</x-docs-sidemenu-item>
          <x-docs-sidemenu-item href="{{ to('docs/freebsd') }}">@lang('FreeBSD')</x-docs-sidemenu-item>
          <x-docs-sidemenu-item href="{{ to('docs/nginx') }}">@lang('Nginx')</x-docs-sidemenu-item>
        </x-docs-sidemenu>
      </div>
    </div>
  </div>
  <div class="max-w-3xl min-w-0 flex-auto lg:max-w-none xl:pxs-16 hanging-punctuation-first">
@endsection

@section('content_footer')
  </div>
  @hasSection('table_of_contents')
    <div class="hidden xl:sticky xl:top-3 xl:block xl:max-h-[calc(100vh-5rem)] xl:ml-16 xl:flex-none xl:overflow-y-auto">
      <nav class="w-56">
        <h2 class="text-sm font-medium text-slate-900 dark:text-white">@lang('На этой странице')</h2>
        <ul class="list-none pl-0 mt-3 flex flex-col gap-3 text-sm text-gray-700 dark:border-white/10 dark:text-gray-400">
          @yield('table_of_contents')
        </ul>
      </nav>
    </div>
  @endif
</div>
@endsection
