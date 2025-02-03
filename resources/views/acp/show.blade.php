@extends(view()->exists("$tpl.base") ? "$tpl.base" : 'acp.layout')

@section('content')
@if (Auth::user()->isRoot())
  <details class="mt-4">
    <summary class="outline-none">JSON</summary>
    <div class="bg-light dark:bg-slate-800 border border-gray-200 dark:border-slate-700 mt-1 py-1 px-2 text-xs dark:text-slate-300 rounded-sm">
      <pre class="inline-block break-words mb-0 whitespace-pre-wrap max-w-full">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    </div>
  </details>
@endif
@endsection
