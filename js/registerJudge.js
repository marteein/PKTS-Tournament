$(function(){
    $('#submitCoach').click(function(e){
        var valid = this.form.checkValidity();
        
        if(valid){
            var name = $('#nameCoach').val();
            var email = $('#emailCoach').val();
            var password = $('#passwordCoach').val();
            var club = $('#clubCoach').val();
        }
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'modules/user/jsregisterJudge.php',
            data: {name: name, email: email, password: password, club: club},
            success:function(data){
                if(data=="Successfully Saved"){
                    Swal.fire({
                        title: data,
                        text: 'Do you want to add more Coaches?',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: 'No',
                        customClass: {
                            actions: 'my-actions',
                            confirmButton: 'order-1',
                            denyButton: 'order-2',
                        }
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('Please add more!', '', 'success');
                            document.getElementById("addJudgeForm").reset();
                        } 
                        else if (result.isDenied) {
                            Swal.fire('Ok!', '', 'success');
                        }
                        })
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data,
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
