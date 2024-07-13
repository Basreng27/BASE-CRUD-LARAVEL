$(document).ready(function() {
    $('.modal-form-open').on('click', function() {
        let url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#modalForm .modal-body').html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error loading data: " + error);
            }
        });
    });

    $('#formStore').on('submit', function(event) {
        event.preventDefault();

        let form = $(this);
        let url = $(this).data('action');
        let formData = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status) {
                    $('#toasr-show').append(toasr(response.statusText, response.message))
                    $('#liveToast').show()
                    $('#btn-save').prop('disabled', true);

                    setTimeout(function() {
                        $('#modalForm').modal('hide');
                        location.reload();
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                $('#toasr-show').append(toasr("Gagal", xhr.responseJSON.error))
                $('#liveToast').show()

                setTimeout(function() {
                    $('#liveToast').hide()
                }, 2000);
            }
        });
    });

    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        var url = $(this).data('url');

        if (confirm('Anda yakin Akan Mengahpus Data?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Item deleted successfully');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting item');
                }
            });
        }
    });
});

function toasr(status, message){
    return `<div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">${status}</strong>
                        <small>now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            </div>`;
}
