@error($field)
  <div class="mt-1 text-xs text-red-600">{{ $errors->first($field) }}</div>
@enderror
