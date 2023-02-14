$(function(){
    var fila=$("tr");
    console.log(fila);
    
    fila.click(function(ev) {
        console.log(this.lastChild.lastChild.id.split("_")[1])
        var id=this.lastChild.lastChild.id.split("_")[1];
        $.ajax( "http://localhost:8000/api/mensaje/"+id,  
        {
            method:"GET",
            dataType:"json",
            crossDomain: true,
        }
        ).done(function(data){
            console.log(data)
            var modo=data[0].modo;
            var banda=data[0].banda;
            var distancia=data[0].distancia;
            var validado=data[0].validado;
            if(validado){
                var imagen='<img src="/img/true.png" class="icono"></img>'
            }
            else{
                imagen='<img src="/img/false.png" class="icono"></img>'
            }
            // console.log(data)
            var plantilla=`
                <div>
                    <h4> Modo: `+modo+`</h4>
                    <h4> Banda: `+banda+`</h4>
                    <h4> Distancia: `+distancia+`</h4>
                    `+imagen+`
                </div>`;

            jqPlantilla=$(plantilla);

            jqPlantilla.dialog({
                title: "¿Está seguro que desea eliminarlo?",
                height: 350,
                width: 400,
                modal: true,
                buttons: {
                    Cancel: function() {
                    jqPlantilla.dialog( "close" );
                    },
                },
                close: function() {
                    jqPlantilla.dialog( "close" );
                },
            })

        });






    })
})