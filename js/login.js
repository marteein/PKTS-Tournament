$(function(){
    $('#login').click(function(e){
        var valid = this.form.checkValidity();
        
        if(valid){
            var email = $('#emaillogin').val();
            var password = $('#passwordlogin').val();
        }
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'jslogin.php',
            data: {email: email, password: password},
            success:function(data){
                if(data=="Welcome to PKTS Tournament Hub"){
                    Swal.fire({
                        'title': 'Success!',
                        'text': data,
                        'type': 'success',
                        showConfirmButton: false
                    })
                        setTimeout('window.location.href="../../index.php"',2000);
                }
                else{
                    Swal.fire({
                        'title': 'Ooops!',
                        'text': data,
                        'type': 'error',
                        showConfirmButton: true
                    })
                }
                
                
            },
            error: function(data){
                alert('there were errors while doing the operation');
            }
            
        });
    });
});