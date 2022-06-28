@if (count($errors))
  <x-alert-danger>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </x-alert-danger>
@endif
