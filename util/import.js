$(document).ready(() => {
  $('#dtr_import').submit((event) => {
    event.preventDefault();

    var alert = $("#alert");

    var fileInput = $('#dtr_')[0]; // Get the DOM element

    if (fileInput && fileInput.files && fileInput.files.length > 0) {
        var formData = new FormData(); // Create a FormData object
        formData.append('dtr_', fileInput.files[0]); // Append the file to FormData

        $.ajax({
            url: '../util/import.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                console.log(response);

                if (response === 'success') {
                    alert.removeClass('d-none').addClass('alert-success').html('Successfully Uploaded, Please refresh the page');
                    
                } else if (response === 'error') {
                    alert.removeClass('d-none').addClass('alert-danger').html('There is an error!');
                }
            },
            error: (xhr, status, error) => {
                console.error(status, error);
            }
        });
    } else {
        console.error('File input not found or no file selected.');
    }
});

    $(() => {
        $("#tableDTR").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
       
        
        
      });



})