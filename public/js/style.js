
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#example').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    });

    $('#btn-mensagem').on('click', function () {
        $('#exampleModal').show();
    });

    $('#close').on('click', function () {
        $('#exampleModal').hide();
    });

    $('#closed').on('click', function () {
        $('#modal-alert').css('display', 'none');

        document.getElementById('modal-alert').style.display = "none";
    });


    CKEDITOR.replace( 'editor1',
    {
        toolbar :
        [
        { name: 'basicstyles', items : [ 'Bold','Italic' ] },
        { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
        { name: 'tools', items : [ 'Maximize','-','About' ] }
        ],
        enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P
    });


    $('#formAdd').on('submit', function(){

        var titulo      = $('#titulo').val();
        var inicio      = $('#inicio').val();
        var prazo       = $('#prazo').val();
        var descricao   = CKEDITOR.instances['descricao'].getData();


        $.ajax({
            type: "POST",
            url: '/validar',
            dataType: 'json',
            data: { titulo,inicio,prazo,descricao}, 
            success: function( response ) {

            }
        }).done(function( msg ) {
            alert( msg );
        });

        return false;
    });

});
