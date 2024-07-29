$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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


    var data;
    $('#formKardex').submit(function(e){
        e.preventDefault();
        data = $(this).serializeArray();

        console.log(data);

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
                    registraKardex();
                }
            }
        });
    });

    function registraKardex(){

      swal({
          title: "Confirmación de registro",
          text: "Esta seguro de registrar el ingreso/egreso : "+$("#detalleKardex").val()+" por el monto de $"+$("#montoKardex").val()+"?",
          icon: "warning",
          buttons: [
            'Cancelar',
            'Registrar Ingreso/Egreso'
          ],
        }).then(function(isConfirm) {
          if (isConfirm) {
              $('.loading').attr("hidden",false);
              $.ajax({
                  url: '/kardex/crear',
                  type:'POST',
                  dataType: 'JSON',
                  data: data,
                  success: function(data) {

                      $('.loading').attr("hidden",true);

                      if(data.success){
                          $('.alert-danger').hide();
                          swal({
                              title: "Ingreso/Egreso registrado",
                              text: "El ingreso/egreso fue registrado exitosamente!",
                              icon: "success",
                              type: "success"
                          }).then(function(){
                              window.location.href = "/kardex";
                          }
                          );
                      }
                      if(data.error){
                          swal({
                              title: "Error al registrar el ingreso/egreso",
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


