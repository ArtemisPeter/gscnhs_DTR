$(document).ready(()=>{
    $(() => {
        $("#tableteacher").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        });

        $('#tableteacher').on('click', '.editBtn',function() {
            $('#updateModal').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            var name = data[1];
            
            var nameArray = name.split(' ');
            var firstName = nameArray.slice(0, -1).join(' ');
            var surname = nameArray.slice(-1).join(' ');

            $('#namez').text(data[1]);
            $('#teacherid').val(data[0]);

            $('#TeacherFname').val(firstName);
            $('#TeacherLname').val(surname);
            $('#officeHours').val(data[2]);

        });

        $('#closeBtn').on('click', ()=>{
            $('#updateModal').modal('hide');
        })

        $('#updateInfo').submit((e)=>{
            e.preventDefault();
            var Fname = $('#TeacherFname').val();
            var Lname = $('#TeacherLname').val();
            var OfficeHr = $('#officeHours').val();
            var teacherId = $("#teacherid").val();
            

            if(Fname === '' || Fname === ' ' || Lname === '' || Lname === ' ' || OfficeHr === '' || OfficeHr === ' ' || OfficeHr === null){
                $('#alert').removeClass('d-none');
                $('#alert').text('Required Input should be filled!')
            }else{
                $.ajax({
                    url: '../util/teacher.php',
                    data: {Fname: Fname, Lname: Lname, OfficeHrs: OfficeHr, teacher_id:teacherId },
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