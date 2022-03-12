function viewVideo(id){
    console.log(id);
    $.ajax({
        type: 'POST',
        url: 'viewVideoParticipant.php',
        data: {id:id},
        success:function(data){
            console.log('All good');
            $("#viewingBody").html(data);
        },
        error: function(data){
            alert('there were errors while doing the operation');
        }
        
    });
}

function addVideo(id){
    var link = $("#videoLink"+id).val();
    console.log(id);
    $.ajax({
        type: 'POST',
        url: 'addVideoParticipant.php',
        data: {id:id, link:link},
        success:function(data){
            if(data=="Video Registered"){
                Swal.fire({
                    icon: 'success',
                    title: data,
                    text: 'Successfully saved the video to be viewed by the judges',
                    showConfirmButton: true
                    })
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
