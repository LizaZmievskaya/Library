$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "output";
        var ident = "output_id";
        $.ajax({
            url:'../delete.php',
            method:'POST',
            data: 'id=' + id + '&table=' + table + '&ident=' + ident,
            type: 'Json',
            success: function(data){
                data = jQuery.parseJSON(data);
                if(data.status=='success'){
                    $("tr[data-id='" + id +"']").remove();
                } else {
                    $("#errorModal").modal("show");
                }
            }
        });
    });
    //ADD
    $('button[name=add]').on('click', function(){
        var odate = $('input#inputOdate').val();
        var rdate= $('input#inputRdate').val();
        var book = $('select[name=book]').val();
        var reader = $('select[name=reader]').val();
        /*var fname = $('input#inputFname').val();
        var sname = $('input#inputSname').val();*/
        $.ajax({
            url:'../add_out.php',
            method:'post',
            data:'odate=' + odate + '&rdate=' + rdate + '&book=' + book + '&reader=' + reader,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var odate = $(this).closest('tr').data('odate');
        var rdate = $(this).closest('tr').data('rdate');
        var bname = $(this).closest('tr').data('bname');
        var sname = $(this).closest('tr').data('sname');
        var fname = $(this).closest('tr').data('fname');
        $('#editModal').attr('data-id',id,'data-odate',odate,'data-rdate',rdate,'data-bname',odate,'data-sname',sname,'data-fname',fname);
        $('input[name="odate"]').val(odate);
        $('input[name="rdate"]').val(rdate);
        $("select[name='book'] :contains('" + bname + "')").attr("selected", "selected");
        $("select[name='reader'] :contains('" + sname + ' ' + fname + "')").attr("selected", "selected");
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var odate = $('#editModal input[name="odate"]').val();
        var rdate = $('#editModal input[name="rdate"]').val();
        var reader = $('#editModal select[name="reader"] :selected').val();
        var book = $('#editModal select[name="book"] :selected').val();
        $.ajax({
            url:'../update_out.php',
            method:'post',
            data:'id=' + id + '&odate=' + odate + '&rdate=' + rdate + '&book=' + book + '&reader=' + reader,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
})