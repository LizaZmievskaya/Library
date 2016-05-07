$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        $.ajax({
            url:'delete_out.php',
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
        var odate = $('input#inputOdate').val();
        var rdate= $('input#inputRdate').val();
        var book = $('input#inputBook').val();
        //var author = $('input#inputAuthor').val();
        var fname = $('input#inputFname').val();
        var sname = $('input#inputSname').val();
        $.ajax({
            url:'add_out.php',
            method:'post',
            data:'odate=' + odate + '&rdate=' + rdate + '&book=' + book + '&fname=' + fname + '&sname=' + sname,
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
            url:'update_out.php',
            method:'post',
            data:'id=' + id + '&country=' + country,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
})