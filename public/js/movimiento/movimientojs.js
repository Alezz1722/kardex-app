$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data;
    $('#formMovimiento').submit(function(e){
        e.preventDefault();
        data = $(this).serializeArray();

        console.log(data);

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
                    registraMovimiento();
                }
            }
        });
    });

    function registraMovimiento(){

        swal({
            title: "Confirmación de registro",
            text: "Esta seguro de registrar el movimiento : "+$("#nombreMovimiento").val()+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Registrar Movimiento'
            ],
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/movimiento/crear',
                    type:'POST',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {

                        $('.loading').attr("hidden",true);

                        if(data.success){
                            $('.alert-danger').hide();
                            swal({
                                title: "Movimiento registrado",
                                text: "El movimiento fue registrado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/movimiento";
                            }
                            );
                        }
                        if(data.error){
                            swal({
                                title: "Error al registrar el movimiento",
                                text: data.error,
                                icon: "error",
                                type: "error"
                            }).then(function(){
                                //window.location.href = "/periodo";
                            }
                            );
                        }

                    }
                });
            }
          })
    }


});
