<?php /** @var $model */ ?>

@extends('acp.base')

@section('content_header')
<div class="grid lg:grid-cols-4 gap-8">
  <div>
    <div class="flex flex-col w-full">
      @can('view', $model)
        <a
          class="border-l-2 px-3 py-2 {{ $view === "$tpl.show" ? 'border-amber-600 text-black dark:text-slate-200 hover:text-black dark:hover:text-slate-200' : 'border-transparent' }}"
          href="{{ Acp::show($model) }}"
        >
          @lang("$tpl.show")
        </a>
      @endcan
      @can('update', $model)
        <a
          class="border-l-2 px-3 py-2 {{ $view === "$tpl.edit" ? 'border-amber-600 text-black dark:text-slate-200 hover:text-black dark:hover:text-slate-200' : 'border-transparent' }}"
          href="{{ Acp::edit($model) }}"
        >
          @lang("$tpl.edit")
        </a>
      @endcan
      @yield('model_menu')
      @if (isset($modelRelations) && count($modelRelations))
        <?php /** @var \App\Domain\ModelAccessibleRelation $relation */ ?>
        @foreach ($modelRelations as $relation)
          <a class="border-l-2 border-transparent px-3 py-2" href="{{ $relation->path }}">
            @lang("acp.{$relation->i18nIndex}.index")
            <span class="text-gray-500 text-xs whitespace-nowrap">{{ ViewHelper::number($relation->count) }}</span>
          </a>
        @endforeach
      @endif
      @if (method_exists($model, 'www'))
        <a class="border-l-2 border-transparent px-3 py-2" href="{{ $model->www() }}">
          @lang('acp.www')
          @svg (external-link)
        </a>
      @endif
      @include('acp.tpl.delete')
    </div>
    @yield('model_menu_after')
  </div>
  <div class="lg:col-span-3">
    <h2 class="font-medium text-3xl tracking-tight mb-2 break-words">
      @include('acp.tpl.back')
      @section('model_title')
        {{ $model->breadcrumb() }}
      @show
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
