// showing/hiding kata and kumite categories
function showDiv(select){
    if(select.value=="Kata"){
     document.getElementById("categoriesKumite").hidden = true;
     document.getElementById("categoriesKata").hidden = false;
     document.getElementById("categoriesKumite").disabled = true;
     document.getElementById("categoriesKata").disabled = false;
    } else{
     document.getElementById("categoriesKumite").hidden = false;
     document.getElementById("categoriesKata").hidden = true;
     document.getElementById("categoriesKumite").disabled = false;
     document.getElementById("categoriesKata").disabled = true;
    }
}

function showDivAdmin(select){
    if(select.value=="Kata"){
     document.getElementById("categoriesKumite").hidden = true;
     document.getElementById("categoriesKata").hidden = false;
     document.getElementById("categoriesKumite").disabled = true;
     document.getElementById("categoriesKata").disabled = false;
    } else{
     document.getElementById("categoriesKumite").hidden = false;
     document.getElementById("categoriesKata").hidden = true;
     document.getElementById("categoriesKumite").disabled = false;
     document.getElementById("categoriesKata").disabled = true;
    }
}

// show scorecard
$(document).ready(function() {
    $('#ScoreTable').DataTable( {
        "searching": false,
        "columnDefs": [
            { "width": "40%", "targets": 0 },
            {"orderable":false, "targets":[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}
          ],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="custom-select"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

$(document).on("click", "#editModalButton", function () {
    console.log('hello');
    var id = $(this).data('id');
    var name = $(this).data('name');
    var email = $(this).data('email');
    var password = $(this).data('password');
    var club = $(this).data('club');
    $(".modal-body #nameCoachModal").val(name);
    $(".modal-body #emailCoachModal").val(email);
    $(".modal-body #clubCoachModal").val(club);
    $(".modal-body #passwordCoachModal").val(password);
    $(".modal-body #idCoachModal").val(id);
});

$(function(){
    $('#submitCoachEdit').click(function(e){
        var valid = this.form.checkValidity();
        
        if(valid){
            var name = $('#nameCoachModal').val();
            var email = $('#emailCoachModal').val();
            var club = $('#clubCoachModal').val();
            var password = $('#passwordCoachModal').val();
            var id = $('#idCoachModal').val();
            console.log(id);
        }
        e.preventDefault();

        Swal.fire({
            title: 'Edit Record',
            text: 'Are you sure you want to edit this record?',
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
                $.ajax({
                    type: 'POST',
                    url: 'modules/user/jsEditCoach.php',
                    data: {id:id, email:email, name:name, password:password, club:club},
                    success:function(data){
                        if(data=="Edited Successfully"){
                            Swal.fire({
                                icon: 'success',
                                title: data,
                                text: 'Record saved',
                                showConfirmButton: true
                            });
                            setTimeout(function(){location.reload();}, 850); 
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
            } 
            else if (result.isDenied) {
                Swal.fire('Ok', '', 'success');
            }
        })
    });
});


function getScores(){
    var event=$("#EventAdmin").val();
    var category1=$("#categoriesKata").val();
    var category2=$("#categoriesKumite").val();
    var gender=$("#genderAdmin").val();
    var age=$("#AgeBracket").val();
    
    console.log(event);

    if(event="Kata"){
        if(age<18 && age>5){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category1+" "+event+" ("+gender+" age "+age+"-"+(parseInt(age)+1)+")";
        }
        else if(age>=18){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category1+" "+event+" ("+gender+" age "+age+" and Above)";
        }
        else if(age<=5){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category1+" "+event+" ("+gender+" age "+age+" and Below)";
        }
        $.ajax({
            type: 'POST',
            url: 'scoreboard.php',
            data: {age: age, gender: gender, event: event, category: category1},
            success:function(data){
               
                $("#scoreBody").html(data);
            },
            error: function(data){
                alert('there were errors while doing the operation');
            }
            
        });
    }
    else{
        if(age<18 && age>5){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category2+" "+event+" ("+gender+" age "+age+"-"+(parseInt(age)+1)+")";
        }
        else if(age>=18){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category2+" "+event+" ("+gender+" age "+age+" and Above)";
        }
        else if(age<=5){
            document.getElementById("scoreCardLabel").innerHTML="Score Card: "+category2+" "+event+" ("+gender+" age "+age+" and Below)";
        }
        
        $.ajax({
            type: 'POST',
            url: 'scoreboard.php',
            data: {age: age, gender: gender, event: event, category: category2},
            success:function(data){
                $("#scoreBody").html(data);
            },
            error: function(data){
                alert('there were errors while doing the operation');
            }
            
        });
    }
}