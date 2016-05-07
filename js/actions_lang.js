$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        $.ajax({
            url:'delete_lang.php',
            method:'POST',
            data: 'id=' + id,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $(this).closest('tr').remove();
                } else {//NEVEDOMAYA HUJNYA
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var language = $('input#inputLanguage').val();
        $.ajax({
            url:'add_lang.php',
            method:'post',
            data:'language=' + language,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var language = $(this).closest('tr').data('language');
        $('#editModal').attr('data-id',id,'data-language',language);
        $('input[name="language"]').val(language);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var language = $('#editModal input[name="language"]').val();
        $.ajax({
            url:'update_lang.php',
            method:'post',
            data:'id=' + id + '&language=' + language,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
})