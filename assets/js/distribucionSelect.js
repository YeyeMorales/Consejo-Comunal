$(function(){

     $("select[name=estado]").change(function(){

    	 estado = $(this).val();

         if ( estado == '')
             return false;

        resetaCombo('municipio');
        resetaCombo('parroquia');
        resetaCombo('sector');
        $("select[name='municipio']").prop("disabled", false);
        $.getJSON('/distribucionGeopolitica/getmunicipios/' + estado, function (data){

            var option = new Array();

            $.each(data, function(i, obj){
                 option[i] = document.createElement('option');
                 $( option[i] ).attr( {value : obj.id} );
                 $( option[i] ).append( obj.nombre_municipio );

                 $("select[name='municipio']").append( option[i] );

            });

        });

     });


   $("select[name=municipio]").change(function(){

        municipio = $(this).val();

        if ( municipio == '')
            return false;

        resetaCombo('parroquia');
        resetaCombo('sector');
        $.getJSON('/distribucionGeopolitica/getparroquias/' + municipio, function (data){
        $("select[name='parroquia']").prop("disabled", false);
            var option = new Array();

            $.each(data, function(i, obj){
                option[i] = document.createElement('option');
                $( option[i] ).attr( {value : obj.id} );
                $( option[i] ).append( obj.nombre_parroquia );

                $("select[name='parroquia']").append( option[i] );

            });

        });

    });


    $("select[name=parroquia]").change(function(){

    	parroquia = $(this).val();

        if ( parroquia == '')
            return false;

        resetaCombo('sector');

        $.getJSON('/distribucionGeopolitica/getsectores/' + parroquia, function (data){
        $("select[name='sector']").prop("disabled", false);
            var option = new Array();

            $.each(data, function(i, obj){
                option[i] = document.createElement('option');
                $( option[i] ).attr( {value : obj.id} );
                $( option[i] ).append( obj.nombre_sector );

                $("select[name='sector']").append( option[i] );

            });

        });

    });

});

function resetaCombo( el ) {
   $("select[name='"+el+"']").empty();
   var option = document.createElement('option');
   $( option ).attr( {value : ''} );
   $( option ).append( 'Seleccione' );
   $("select[name='"+el+"']").prop("disabled",true);
   $("select[name='"+el+"']").append( option );
   
}