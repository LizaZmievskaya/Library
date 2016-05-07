$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        $.ajax({
            url:'delete_country.php',
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
        var country = $('input#inputCountry').val();
        $.ajax({
            url:'add_country.php',
            method:'post',
            data:'country=' + country,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var country = $(this).closest('tr').data('country');
        $('#editModal').attr('data-id',id,'data-country',country);
        $('input[name="country"]').val(country);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var country = $('#editModal input[name="country"]').val();
        $.ajax({
            url:'update_country.php',
            method:'post',
            data:'id=' + id + '&country=' + country,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
})