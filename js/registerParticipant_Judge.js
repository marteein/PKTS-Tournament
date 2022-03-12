// show all participants
$(document).ready(function() {
    var table = $('#participantsTable').DataTable( {
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

function openWindowWithPost(name, event, cate) {
    $.ajax({
        type: 'POST',
        url: 'scoring.php',
        data: {name: name, event:event, category:cate},
        success:function(data){
            console.log('All good');
            $("#judgingBody").html(data);
        },
        error: function(data){
            alert('there were errors while doing the operation');
        }
        
    });

  }

