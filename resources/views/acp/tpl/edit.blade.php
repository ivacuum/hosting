<a class="btn btn-default" href="{{ action("$self@edit", [$id, 'goto' => Request::fullUrl()]) }}">
  @php (require base_path('resources/svg/pencil.html'))
</a>
