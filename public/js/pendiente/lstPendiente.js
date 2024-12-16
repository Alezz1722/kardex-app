$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
    new DataTable('#tblPendiente', {
        scrollX: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados"
        },
    });

     */

    $('.borrarPendiente').click(function(e){
        e.preventDefault();

        var idPendiente = $(this).find(".idPendiente").text();
        var nombrePendiente = $(this).find(".nombrePendiente").text();
        swal({
            title: "Confirmación de eliminación",
            text: "Esta seguro de eliminar el pendiente : "+nombrePendiente+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Eliminar Pendiente'
            ],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/pendiente/eliminar/'+idPendiente,
                    type:'DELETE',
                    dataType: 'JSON',
                    //data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            swal({
                                title: "Pendiente eliminado",
                                text: "El pendiente "+nombrePendiente+" fue eliminado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/pendiente";
                            }
                            );
                        }
                        if(data.error){
                            swal({
                                title: "Error al eliminar el pendiente",
                                text: "El pendiente ya pertenece a alguna actividad.",
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
