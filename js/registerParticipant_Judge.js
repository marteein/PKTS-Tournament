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

// show all participants
$(document).ready(function() {
    var table = $('#participantsTable').DataTable( {
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-success'>Judge</button>"
        } ],
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

    $('#participantsTable tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        openWindowWithPost(data[0], data[1], data[2])
    } );
} );

function openWindowWithPost(something, additional, misc) {
    var f = document.getElementById('TheForm');
    f.name.value = something;
    f.event.value = additional;
    f.category.value = misc;
    window.open('scoring.php', 'scoring.php', 'location=yes,height=1080,width=1080,scrollbars=yes,status=yes');
    f.submit();
  }

// submitting the participant form
$(function(){
    $('#SubmitParticipant').click(function(e){
        var valid = this.form.checkValidity();
        
        if(valid){
            var name = $('#nameParticipant').val();
            var age = $('#ageParticipant').val();
            var gender = $('#genderParticipant').val();
            var katakumite = $('#KataKumiteParticipant').val();
            var categoriesKata = $('#categoriesKata').val();
            var categoriesKumite = $('#categoriesKumite').val();
        }
        e.preventDefault();

        //for KATA participants
        $.ajax({
            type: 'POST',
            url: 'modules/user/jsregisterparticipants.php',
            data: {name: name, age: age, gender: gender, katakumite: katakumite, categoriesKata: categoriesKata, categoriesKumite: categoriesKumite},
            success:function(data){
                if(data=="Successfully Saved"){
                    Swal.fire({
                        title: data,
                        text: 'Do you want to add more Participants?',
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
                            document.getElementById("participant_form").reset();
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