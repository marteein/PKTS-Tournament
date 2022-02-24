$(function(){
    $('#register').click(function(e){
        
        var valid = this.form.checkValidity();
        if(valid){
            
            var fname 		= $('#fname').val();
            var lname		= $('#lname').val();
            var email 		= $('#email').val();
            var address 	= $('#address').val();
            var password 	= $('#password').val();
            var userid	    = $('#userid').val();
            var contact     = $('#contact').val();
            var confirmP    = $('#passwordConfirm').val();
            
            
            e.preventDefault();
            if(confirmP==password){
                $.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data:{fname:fname, lname:lname, email:email, userid:userid,
                    address:address, password:password, contact:contact},
                    success:function(data){
                        if(data=="Successfully Saved"){
                            Swal.fire({
                                'title': 'Success!',
                                'text': data,
                                'type': 'success'
                            })
                            setTimeout('window.location.href="login.php"',2000);
                        }
                        else{
                            Swal.fire({
                                'title': 'Sorry',
                                'text': data,
                                'type': 'error'
                            })
                        }
                        
                    },
                    erros:function(data){
                        Swal.fire({
                            'title': 'Error',
                            'text': 'There were errors while saving the data',
                            'type': 'error'
                        })
                    }
                });
            }
            else{
                Swal.fire({
                    'title': 'Sorry',
                    'text': "Password and Confirm Password doesn't match",
                    'type': 'error'
                })
            }
            
            
            
        }
        else{
            
        }
        
    })
});