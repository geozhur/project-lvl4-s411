<div class="form-group row">
        <label for="{{ Arr::get($params, 'name') }}" class="col-md-4 col-form-label text-md-right">{{ Arr::get($params, 'label') }}</label>

        <div class="col-md-6">
            <input id="{{ Arr::get($params, 'name') }}" type="{{ Arr::get($params, 'type', 'text') }}" class="form-control @error(Arr::get($params, 'name')) is-invalid @enderror" name="{{ Arr::get($params, 'name') }}" value="{{ Arr::get($params, 'value') }}" {{ Arr::get($params, 'require', false) ? 'require': '' }} autocomplete="{{ Arr::get($params, 'name') }}">

            @error(Arr::get($params, 'name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>