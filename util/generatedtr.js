$(document).ready(() => {
    $('#month').on('change', () => {
        var month = $('#month').val().trim();
        var year = $('#year').val().trim();

        if (month !== '' && year !== '') {
            $("#generateDtr").prop("disabled", false);
        }
    });

    $('#year').on('change', () => {
        var month = $('#month').val().trim();
        var year = $('#year').val().trim();

        if (month !== '' && year !== '') {
            $("#generateDtr").prop("disabled", false);
        }
    });

   
});
