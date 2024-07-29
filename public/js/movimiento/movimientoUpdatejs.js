$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data;
    $('#formEditaMovimiento').submit(function(e){
        e.preventDefault();
        data = $(this).serializeArray();


        $.ajax({
            url: '/movimiento/validar',
            type:'POST',
            dataType: 'JSON',
            data: data,
            success: function(data) {
                if(data.error){

                    $(".listaErrores").html('');
                    $('.alert-danger').show();
                    $.each(data.error, function(index, value) {
                        $(".listaErrores").append('<li>'+value+'</li>');
                    });
                }
                if(data.success){
                    $('.alert-danger').hide();
                    editaMovimiento();
                }
            }
        });

    });

    function editaMovimiento(){

        swal({
            title: "Confirmación de edición",
            text: "Esta seguro de editar el movimiento : "+$(".nombreMovimiento").text()+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Editar Movimiento'
            ],
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/movimiento/editar/'+$(".idMovimiento").text(),
                    type:'PUT',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            $('.alert-danger').hide();
                            swal({
                                title: "Movimiento editado",
                                text: "El movimiento fue editado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/movimiento";
                            }
                            );
                        }
                    }
                });
            }
          })
    }



});
