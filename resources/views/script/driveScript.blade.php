@php $curr_route = request()->route()->getName(); @endphp
<script>
    function confirmDelete(id) {
        var url = "{{ route('delete-folder', ['id' => ':id']) }}";
        url = url.replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#187744',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        $("#folder-" + id).fadeOut(2000, function () {
                            $(this).remove(); 
                        });
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your folder has been deleted.',
                            type: 'success',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    },
                    error: function (error) {
                        console.error("Error deleting folder:", error.responseText);
                    }
                });
            }
        })
    }

</script>

<script>
    function deleteFile(id) {
        var url = "{{ route('delete-file', ['id' => ':id']) }}";
        url = url.replace(':id', id);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#187744',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        $("#tr-file-" + id).fadeOut(2000, function () {
                            $(this).remove(); 
                        });
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            type: 'success',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    },
                    error: function (error) {
                        console.error("Error deleting folder:", error.responseText);
                    }
                });
            }
        })
    }

</script>

@if($curr_route == "sub-folder")
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropArea = document.getElementById('dropArea');

        // Prevent default behavior on drag and drop events
        dropArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropArea.classList.remove('dragover');

            var files = e.dataTransfer.files;

            if (files.length > 0) {
                uploadFiles(files);
            }
        });

        // Trigger file upload when files are selected from the input field
        $('#fileInput').change(function () {
            var files = this.files;
            if (files.length > 0) {
                uploadFiles(files);
            }
        });

        // Handle responses from the server
        function handleResponse(data, isSuccessful) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                'positionClass': 'toast-bottom-right'
            };

            if (isSuccessful) {
                toastr.success(data.success);
                setTimeout(() => location.reload(), 1000);
            } else {
                console.error(data.responseText);
                toastr.error(data.responseJSON?.error || 'An error occurred. Please try again.');
            }
        }

        // Upload multiple files using AJAX
        function uploadFiles(files) {
            Array.from(files).forEach(function (file) {
                // Validate file type (PDF, Word, Excel)
                console.log('File type:', file.type);

                var allowedTypes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/octet-stream'
                ];

                if (!allowedTypes.includes(file.type)) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        'positionClass': 'toast-bottom-right'
                    };
                    toastr.error(`Invalid file type: ${file.name}`);
                    return;
                }

                // Prepare form data for each file
                var formData = new FormData();
                formData.append('file', file);

                // Send AJAX request for each file
                $.ajax({
                    type: 'POST',
                    url: '{{ route("document-store", $id) }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        handleResponse(data, true);
                    },
                    error: function (data) {
                        handleResponse(data, false);
                    }
                });
            });
        }
    });
</script>




<script>
    function validateAndSubmit() {
    var fileInput = document.getElementById('file');
    var file = fileInput.files[0];

    if (file) {
        // Check allowed file types (PDF, Word, Excel)
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!allowedTypes.includes(file.type)) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                'positionClass': 'toast-bottom-right'
            };
            toastr.error("Only PDF, Word, and Excel files are allowed.");
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                'positionClass': 'toast-bottom-right'
            };
            toastr.error("File size must be less than or equal to 5 MB.");
            return;
        }

        document.getElementById('uploadForm').submit();
    }
}
</script>
@endif 


<script>
    function editFolder(id, folder){
        $('#fid').val(id);
        $('#folder-naame').val(folder);
    }

    function editFile(id, file){
        $('#file-id').val(id);
        $('#file-name').val(file);
    }
</script>


