<style>
    .select2-container--default .select2-results__option {
        color: black;
        /* Warna teks opsi */
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        color: black;
        /* Warna teks opsi yang disorot */
    }
</style>

<div>
    <select class="form-control select2" name="{{ $name }}" id="{{ $id }}">
        <option value="">-- Pilih --</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ $optionValue == $value ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
