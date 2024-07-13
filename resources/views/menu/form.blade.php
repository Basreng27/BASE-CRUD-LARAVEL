<div class="container-fluid">
    <x-text-input class="form-control" type="hidden" name="id" value="{{ @$data['id'] }}" required />

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Nama') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="text" name="name" value="{{ @$data['name'] }}" required />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">{{ __('URL') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="text" name="url" value="{{ @$data['url'] }}" required />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Urutan') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="number" name="sequence" value="{{ @$data['sequence'] }}"
                required />
        </div>
    </div>
</div>
