$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "publishers";
        var ident = "publisher_id";
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
        var name = $('input#inputName').val();
        var city = $('input#inputCity').val();
        var email = $('input#inputEmail').val();
        var site = $('input#inputSite').val();
        var phone = $('input#inputPhone').val();
        $.ajax({
            url:'../add_publisher.php',
            method:'post',
            data:'name=' + name + '&city=' + city + '&email=' + email + '&site=' + site + '&phone=' + phone,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //EDIT
    $('button[name=edit]').on('click', function(){
        var id = $(this).closest('tr').data('id');
        var name = $(this).closest('tr').data('name');
        var city = $(this).closest('tr').data('city');
        var email = $(this).closest('tr').data('email');
        var site = $(this).closest('tr').data('site');
        var phone = $(this).closest('tr').data('phone');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-name',name);
        $('#editModal').attr('data-city',city);
        $('#editModal').attr('data-email',email);
        $('#editModal').attr('data-site',site);
        $('#editModal').attr('data-phone',phone);
        $('input#inputName').val(name);
        $('input#inputCity').val(city);
        $('input#inputEmail').val(email);
        $('input#inputSite').val(site);
        $('input#inputPhone').val(phone);
    });
    $('button[name=save]').on('click', function(){
        var id = $('#editModal').data('id');
        var name = $('#editModal input[name="name"]').val();
        var city = $('#editModal input[name="city"]').val();
        var email = $('#editModal input[name="email"]').val();
        var site = $('#editModal input[name="site"]').val();
        var phone = $('#editModal input[name="phone"]').val();
        $.ajax({
            url:'../update_publisher.php',
            method:'post',
            data:'id=' + id + '&name=' + name + '&city=' + city + '&email=' + email + '&site=' + site + '&phone=' + phone,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
})