<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button type="button" class="btn btn-primary mb-3 float-end modal-form-open"
                        data-url="{{ $url_form }}" data-action="{{ $url_action }}" data-bs-toggle="modal"
                        data-bs-target="#modalForm"><i class="fa-solid fa-plus"></i>
                        Tambah</button>

                    <table class="table table-hover text-white"
                        style="--bs-table-bg: transparent; --bs-table-color: white">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>NAMA</th>
                                <th width="20%">ACTION</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value['name'] }}</td>
                                    <td><button type="button" class="btn btn-info mr-3 modal-form-open"
                                            data-url="{{ route('role.show', ['id' => $value['id']]) }}"
                                            data-action="{{ $url_action }}" data-bs-toggle="modal"
                                            data-bs-target="#modalForm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Ubah</button>

                                        <a href="#" class="btn btn-danger delete-btn"
                                            data-url="{{ route('role.destroy', ['id' => $value['id']]) }}"><i
                                                class="fa-solid fa-trash"></i>Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
