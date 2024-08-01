$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var data;
    $('#formEditaPendiente').submit(function(e){
        e.preventDefault();
        data = $(this).serializeArray();


        $.ajax({
            url: '/pendiente/validar',
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
            text: "Esta seguro de editar el pendiente : "+$(".nombrePendiente").text()+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Editar Pendiente'
            ],
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/pendiente/editar/'+$(".idPendiente").text(),
                    type:'PUT',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            $('.alert-danger').hide();
                            swal({
                                title: "Pendiente editado",
                                text: "El pendiente fue editado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/pendiente";
                            }
                            );
                        }
                    }
                });
            }
          })
    }



});
