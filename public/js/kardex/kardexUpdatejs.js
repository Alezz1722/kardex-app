$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.fn.currencyInput = function() {
        this.each(function() {
          var wrapper = $("<div class='currency-input' />");
          $(this).wrap(wrapper);
          //$(this).before("<span class='currency-symbol'>$</span>");
          $(this).change(function() {
            var min = parseFloat($(this).attr("min"));
            var max = parseFloat($(this).attr("max"));
            var value = this.valueAsNumber;
            if(value < min)
              value = min;
            else if(value > max)
              value = max;
            $(this).val(value.toFixed(2)); 
          });
        });
      };

    $('input.currency').currencyInput();

    $('#fechaKardex').datetimepicker({
        "format": 'YYYY-MM-DD HH:mm:ss',
        "locale":  moment.locale('es', {
            week: { dow: 1 }
        }),
        "allowInputToggle": true,
        "showClose": true,
        "showClear": true,
        "showTodayButton": true,
        "tooltips": {
            today: 'Ir al dia de hoy',
            clear: 'Eliminar seleccion',
            close: 'Cerrar el calendario',
            selectMonth: 'Seleccione el mes',
            prevMonth: 'Anterior mes',
            nextMonth: 'Siguiente mes',
            selectYear: 'Seleccione el año',
            prevYear: 'Anterior año',
            nextYear: 'Siguiente año',
            selectDecade: 'Seleccione la década',
            prevDecade: 'Anterior década',
            nextDecade: 'Siguiente década',
            prevCentury: 'Anterior siglo',
            nextCentury: 'Siguiente siglo'
        }
    });

    var data;
    $('#formEditaKardex').submit(function(e){
        e.preventDefault();
        data = $(this).serializeArray();


        $.ajax({
            url: '/kardex/validar',
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
                    editaKardex();
                }
            }
        });

    });

    function editaKardex(){

        swal({
            title: "Confirmación de edición",
            text: "Esta seguro de editar el ingreso/egreso : "+$("#detalleKardex").val()+" por el monto de $"+$("#montoKardex").val()+"?",
            icon: "warning",
            buttons: [
              'Cancelar',
              'Editar Ingreso/Egreso'
            ],
          }).then(function(isConfirm) {
            if (isConfirm) {
                $('.loading').attr("hidden",false);
                $.ajax({
                    url: '/kardex/editar/'+$(".idKardex").text(),
                    type:'PUT',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {
                        $('.loading').attr("hidden",true);
                        if(data.success){
                            $('.alert-danger').hide();
                            swal({
                                title: "Ingreso/egreso editado",
                                text: "El Ingreso/Egreso fue editado exitosamente!",
                                icon: "success",
                                type: "success"
                            }).then(function(){
                                window.location.href = "/kardex";
                            }
                            );
                        }
                    }
                });
                
            }
          })
      }

});
