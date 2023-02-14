$(function(){
    var boton=$('.btn');

    boton.click(function(ev) {
        var boton2=this;
        ev.preventDefault();
        const id=this.id.split("_")[1];
        // console.log(id)
        console.log(this.id.split("_")[0]==="valido")
        if(this.id.split("_")[0]==="valido"){
            var validado= false;
        }
        else{
            validado= true;
        }
        $.ajax( "http://localhost:8000/api/mensaje/"+id,  
        
        {
            method:"PUT",
            dataType:"json",
            crossDomain: true,
            data: {"validado":validado},
        }
        ).done(function(data){
            console.log(boton2)
            if(boton2.innerHTML=="Invalidar"){
               boton2.innerHTML ="Validar"; 
               boton2.className="invalido"
            }
            else{
                boton2.innerHTML ="Invalidar"; 
                boton2.className="valido"
            }
        });
    })
})