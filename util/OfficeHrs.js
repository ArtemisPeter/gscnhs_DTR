$(document).ready(()=>{
    $(() => {
        $("#tableOfficeHrs").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        });

        $('#tableOfficeHrs').on('click', '.editBtn',function() {
            $('#updateModal').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            
           
            $('#OfficeHrsID').val(data[0]);

            $('#AMIN').val(data[1]);
            $('#AMOUT').val(data[2]);
            $('#AFIN').val(data[3]);
            $('#AFOUT').val(data[4]);

        });

        $('#closeBtn').on('click', ()=>{
            $('#updateModal').modal('hide');
        })

        $('#updateInfo').submit((e)=>{
            e.preventDefault();
            var AMIN = $('#AMIN').val();
            var AMOUT = $('#AMOUT').val();
            var PMIN = $('#AFIN').val();
            var PMOUT = $("#AFOUT").val();
            var OfficeHrID = $('#OfficeHrsID').val();
            

            if(AMIN === '' || AMIN === ' ' || AMOUT === '' || AMOUT === ' ' || PMIN === '' || PMIN === ' ' || PMOUT === '' || PMOUT === ' '){
                $('#alert').removeClass('d-none');
                $('#alert').text('Required Input should be filled!')
            }else{
                $.ajax({
                    url: '../util/OfficeHrs.php',
                    data: {AMIN: AMIN, AMOUT: AMOUT, PMIN: PMIN, PMOUT:PMOUT, OfficeHrID: OfficeHrID },
                    method: "POST",
                    success: ((response) => {
                        console.log(response);
    
                        if(response === 'success'){
                            Swal.fire({
                                title: "Update Successful!",
                                icon: "success"
                              }).then(()=>{
                                location.reload()
                              });
                        }else{
                            Swal.fire({
                                title: "There is an error!",
                                icon: "error"
                              }).then(()=>{
                                location.reload()
                              });
                        }
                       
                    })
                })
            }

            
        })
})