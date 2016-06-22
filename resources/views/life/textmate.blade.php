@extends('life.base', [
  'meta_title' => 'Textmate',
])

@section('content')
<h2>Textmate</h2>
<h2>Горячие клавиши</h2>
<ul class="list-unstyled">
  <li><kbd>⇧⌘ F</kbd> — <span class="text-muted">Find in Project...</span></li>
  <li><kbd>⌃⌘ G</kbd> — <span class="text-muted">Replace All</span></li>
  <li>&nbsp;</li>
  <li><kbd>⌃⇧ W</kbd> — <span class="text-muted">Wrap Selection in Open/Close Tag</span></li>
  <li><kbd>⌃⇧⌘ W</kbd> — <span class="text-muted">Wrap Each Selected Line in Open/Close Tag</span></li>
  <li>&nbsp;</li>
  <li><kbd>⌃⌘ R</kbd> — <span class="text-muted">Current Document</span></li>
  <li><kbd>⌃⌘ T</kbd> — <span class="text-muted">Select bundle item...</span></li>
</ul>
@endsection
