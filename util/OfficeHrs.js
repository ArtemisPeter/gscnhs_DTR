$(document).ready(()=>{
    $(() => {
        $("#tableOfficeHrs").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
        
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
       
        $('#addOfficeHrs').on('click', ()=>{
            $('#insertNew').modal('show');
         })
         $('#closeBtn_insert').on('click', ()=>{
             $('#insertNew').modal('hide');
            
         })

         $('#insertNew').submit((e)=>{
            e.preventDefault();
            var AMIN_Insert = $('#AMIN_insert').val();
            var AMOUT_Insert = $('#AMOUT_insert').val();
            var PMIN_Insert = $('#AFIN_insert').val();
            var PMOUT_Insert = $('#AFOUT_insert').val();

            if(AMIN_Insert === '' || AMIN_Insert === ' ' || AMOUT_Insert === '' || AMOUT_Insert === ' ' || PMIN_Insert === '' || PMIN_Insert === ' ' || PMOUT_Insert === '' || PMOUT_Insert === ' '){
                $('#alert').removeClass('d-none');
                $('#alert').text('Required Input should be filled!')
            }else{
                $.ajax({
                    url: '../util/OfficeHrs.php',
                    data: {AMIN: AMIN_Insert, AMOUT: AMOUT_Insert, PMIN: PMIN_Insert, PMOUT:PMOUT_Insert, option: 2, OfficeHrID: 0 },
                    method: "POST",
                    success: ((response)=>{
                        if(response === 'success'){
                            Swal.fire({
                                title: "Insert Successful!",
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
                    data: {AMIN: AMIN, AMOUT: AMOUT, PMIN: PMIN, PMOUT:PMOUT, OfficeHrID: OfficeHrID, option: 1 },
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