$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.borrarMovimiento').click(function(e){
        e.preventDefault();

        var idMovimiento = $(this).find(".idMovimiento").text();
        var nombreMovimiento = $(this).find(".nombreMovimiento").text();
        swal({
            title: "Confirmación de eliminación",
            text: "Esta seguro de eliminar el movimiento : "+nombreMovimiento+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Eliminar Movimiento'
            ],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/movimiento/eliminar/'+idMovimiento,
                    type:'DELETE',
                    dataType: 'JSON',
                    //data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            swal({
                                title: "Movimiento eliminado",
                                text: "El movimiento "+$(this).find(".nombreMovimiento").text()+"fue registrado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/movimiento";
                            }
                            );
                        }
                        if(data.error){
                            swal({
                                title: "Error al eliminar el movimiento",
                                text: "El movimiento ya pertenece a alguna actividad.",
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
    });
});
