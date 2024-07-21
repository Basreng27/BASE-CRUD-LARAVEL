<div class="container-fluid">
    <x-text-input class="form-control" type="hidden" name="id" value="{{ @$data['id'] }}" required />

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Nama') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="text" name="name" value="{{ @$data['name'] }}" required />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Role') }}</div>
        <div class="col-md-9">
            <x-select-option name="role_id" :value="@$data['role']['id']" :options="$opt_role" id="role_id" />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">{{ __('Email') }}</div>
        <div class="col-md-9">
            <x-text-input class="form-control" type="email" name="email" value="{{ @$data['email'] }}" required />
        </div>
    </div>

    @if (!@$data['id'])
        <div class="row mb-3">
            <div class="col-md-3">{{ __('Password') }}</div>
            <div class="col-md-9">
                <x-text-input class="form-control" type="text" name="password" required />
            </div>
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#modalForm')
        });
    })
</script>
