<div class="container-fluid">
    <x-text-input class="form-control" type="hidden" name="id" value="{{ @$data['id'] }}" required />

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Nama') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="text" name="name" value="{{ @$data['name'] }}" required />
        </div>
    </div>
</div>
