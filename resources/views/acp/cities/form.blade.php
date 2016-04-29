@include('tpl.form_errors')

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$city->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">URL:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="slug" value="{{ old('slug', @$city->slug) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Страна:</label>
  <div class="col-md-6">
    <div class="form-select">
      <select class="form-control" name="country_id">
        <option value="0">—</option>
        @foreach (App\Country::orderBy('title')->get(['id', 'title']) as $row)
          <option value="{{ $row->id }}" {{ $row->id == old('country_id', @$city->country_id) ? 'selected' : '' }}>
            {{ $row->title }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-3 control-label">Код IATA:</label>
  <div class="col-md-6">
    <input type="text" class="form-control" name="iata" maxlength="3" value="{{ old('iata', @$city->iata) }}">
  </div>
</div>
