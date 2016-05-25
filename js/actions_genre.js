$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "genres";
        var ident = "id";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-id='" + id +"']").remove();
                } else {//NEVEDOMAYA HUJNYA
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var genre = $('input#inputGenre').val();
        $.ajax({
            url:'../add_genre.php',
            method:'post',
            data:'genre=' + genre,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var genre = $(this).closest('tr').data('genre');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-genre',genre);
        $('input[name="genre"]').val(genre);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var genre = $('#editModal input[name="genre"]').val();
        $.ajax({
            url:'../update_genre.php',
            method:'POST',
            data:'id=' + id + '&genre=' + genre,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})