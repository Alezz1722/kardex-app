$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    new DataTable('#tblKardex', {
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

    

    $('.borrarKardex').click(function(e){
        e.preventDefault();

        var idKardex = $(this).find(".idKardex").text();
        var detalleKardex = $(this).find(".detalleKardex").text();
        var fechaKardex = $(this).find(".fechaKardex").text();
        var montoKardex = $(this).find(".montoKardex").text();
        var tipoKardex = $(this).find(".tipoKardex").text();


        swal({
            title: "Confirmación de eliminación",
            text: "Esta seguro de eliminar el "+tipoKardex+": "+detalleKardex+", con fecha : "+fechaKardex+", y valor : $"+montoKardex+" ?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Eliminar Ingreso/Egreso'
            ],
            dangerMode: true,
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/kardex/eliminar/'+idKardex,
                    type:'DELETE',
                    dataType: 'JSON',
                    //data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            swal({
                                title: tipoKardex+" eliminado",
                                text: "El "+tipoKardex+" con valor $"+montoKardex+" fue eliminado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/kardex";
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
