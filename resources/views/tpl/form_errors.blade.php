@if (sizeof($errors))
  <div class="alert alert-danger">
    <ul class="tw-mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
