$(function(){


    var tabla=$('#myTable');
    var tbody=$('tbody');
    var mensajes=[];
    $.ajax("http://localhost:8000/api/mensaje",
        {
            method: "GET",
            dataType: "json",
            crossDomain: true,
            async: false,

        }).done(function (data) {
            $.each(data, function (key, val) {
                if(val.validado){
                    // val.validado='<img src="img/true.png" class="icono" data-valido="true" id="mensaje_"'+val.id+'>'
                    val.validado='<button class=" btn valido"id="valido_'+val.id+'">Invalidar</button>';
                }else{
                    // val.validado='<img src="img/false.png" class="icono" data-valido="false" id="mensaje_"'+val.id+'>'
                    val.validado='<button class=" btn invalido" id="invalido_'+val.id+'">Validar</button>';
                }
                
                mensajes.push(val);
            })

        });
    
        

    $('#myTable').DataTable({
        data : (mensajes),
        columns: [
            { data: 'banda' },
            { data: 'modo' },
            { data: 'distancia' },
            { data: 'participante' },
            { data: 'validado' },
        ]

    });

})