<a href="{{ !empty($goto) ? url($goto) : action("$self@index") }}">
  @php (require base_path('resources/svg/chevron-left.html'))
</a>
