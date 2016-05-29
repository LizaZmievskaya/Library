$(document).ready(function() {
    //DELETE
    $('input[name="delete"]').on('click',function (){
        var id = $(this).closest('tr').data('id');
        var table = "books";
        var ident = "book_id";
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
        var year = $('input#inputYear').val();
        var pages = $('input#inputPages').val();
        var price = $('input#inputPrice').val();
        var publish = $('select[name="publish"]').val();
        var lang = $('select[name="lang"]').val();
        var auth = $('select[name="auth"]').val();
        var genre = $('select[name="genre"]').val();
        $.ajax({
            url:'../add_book.php',
            method:'post',
            data:'name=' + name + '&year=' + year + '&pages=' + pages + '&price=' + price + '&publish=' + publish
            + '&lang=' + lang + '&auth=' + auth + '&genre=' + genre,
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
        var year = $(this).closest('tr').data('year');
        var pages = $(this).closest('tr').data('pages');
        var price = $(this).closest('tr').data('price');
        var publish = $(this).closest('tr').data('publish');
        var lang = $(this).closest('tr').data('lang');
        var auth = $(this).closest('tr').data('auth');
        var genre = $(this).closest('tr').data('genre');
        $('#editModal').attr('data-id',id);
        $('#editModal').attr('data-name',name);
        $('#editModal').attr('data-year',year);
        $('#editModal').attr('data-pages',pages);
        $('#editModal').attr('data-price',price);
        $('#editModal').attr('data-publish',publish);
        $('#editModal').attr('data-lang',lang);
        $('#editModal').attr('data-auth',auth);
        $('#editModal').attr('data-genre',genre);
        $('input#inputID').val(id);
        $('input#inputName').val(name);
        $('input#inputYear').val(year);
        $('input#inputPages').val(pages);
        $('input#inputPrice').val(price);
        $("select[name='publish'] :contains('" + publish + "')").attr("selected", "selected");
        $("select[name='auth'] :contains('" + auth + "')").attr("selected", "selected");
        $("select[name='lang'] :contains('" + lang + "')").attr("selected", "selected");
        $("select[name='genre'] :contains('" + genre + "')").attr("selected", "selected");
    });
    $('button[name="save"]').on('click', function(){
        var id = $('#editModal input[name="id"]').val();
        var name = $('#editModal input[name="name"]').val();
        var year = $('#editModal input[name="year"]').val();
        var pages = $('#editModal input[name="pages"]').val();
        var price = $('#editModal input[name="price"]').val();
        var publish = $('select[name="publish"]').text();
        var lang = $('select[name="lang"]').text();
        var auth = $('select[name="auth"]').text();
        var genre = $('select[name="genre"]').text();
        $.ajax({
            url:'../update_book.php',
            method:'post',
            data: 'id=' + id + '&name=' + name + '&year=' + year + '&pages=' + pages + '&price=' + price + '&publish=' + publish
            + '&lang=' + lang + '&auth=' + auth + '&genre=' + genre,
            type:'json',
            success:function(data){
                $("#addModal").modal("hide");
            }
        });
    });
    //FILTER
    /*$('input[name="ok"]').on('click',function (){
        var id =$('select[name="fgenre"]').val();
        $.ajax({
            url:'../books.php',
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
    });*/
})