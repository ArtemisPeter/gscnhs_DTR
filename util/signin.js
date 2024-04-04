
$(document).ready(()=>{
    
    $('#signin').submit((event)=>{
        event.preventDefault();
        
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'util/signin.php',
            data: {username: username, password: password},
            method: 'POST',
            success: ((response) => {
                console.log(response);
                if(response === '1'){
                    $('#alert').removeClass('d-none');
                }
                else if (response === 'success'){
                    window.location = 'pages/main.php';
                }
            })
        })

    });


})