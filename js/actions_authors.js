$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "authors";
        var ident = "author_id";
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
        var author = $('input#inputAuthor').val();
        $.ajax({
            url:'../add_auth.php',
            method:'post',
            data:'author=' + author,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var author = $(this).closest('tr').data('auth');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-auth',author);
        $('input[name="author"]').val(author);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var author = $('#editModal input[name="author"]').val();
        $.ajax({
            url:'../update_auth.php',
            method:'POST',
            data:'id=' + id + '&author=' + author,
            type:'json',
            success:function(data){
                $("#editModal").modal("hide");
            }
        });
    });
})