/**
 * 
 */
window.onload = function(){

/////////////// SLIDER DE IMAGENES DE LOS PRODUCTOS DE LA HOME /////////
	var slider = document.getElementsByClassName("slider")[0];
    var imagenes = document.getElementsByClassName("imagen");

    //proporcion de la imagen traida de la web (1980x500)
    var proporcion = imagenes[0].naturalHeight/imagenes[0].naturalWidth;
    //console.log(proporcion);
    slider.style.height = window.innerWidth * proporcion + "px";

    var activa = 0;
    imagenes[activa].className = "imagen activa";
    imagenes[(activa == 0) ? imagenes.length-1 : activa-1].className = "imagen left";
    imagenes[(activa == length-1) ? 0 : activa+1].className = "imagen rigth";
    

    var flechas = document.getElementsByClassName("nav");

    for(var i = 0;i<flechas.length;i++)
    {
        (function(indice){
            flechas[indice].onclick = function(evento){
                evento.preventDefault();
                avanzar(indice);
            }
        })(i);
    }

    var dots = document.getElementsByClassName("dot");

    for(var i=0;i<dots.length;i++)
    {
        (function(indice){
            dots[indice].onclick = function(evento){
                console.log(indice);
                evento.preventDefault();
                for(var j=0;j<dots.length;j++)
                {
                    dots[j].className = "dot";
                    imagenes[j].className = "imagen";
                }

                dots[indice].className = "dot activo";
                activa = indice;
                imagenes[activa].className = "imagen activa";
                imagenes[(activa == 0) ? imagenes.length-1 : activa-1].className = "imagen left";
                imagenes[(activa == imagenes.length-1) ? 0 : activa+1].className = "imagen rigth";
            }
        })(i);
    }
    //para la direccion del cambio de las imagenes
    //en base a la direccion vamos a determinar que imagen es la activa
    function avanzar(direccion)
    {
        if(direccion == 1)
        {
            if(activa == 0)
            {
                activa = activa + 1;   
            }
            else if ( activa == imagenes.length-1)
            {
                activa = 0;
            }
            else
            {
                activa = activa+1;
            }
            console.log(activa);
            
        }
        else if( direccion == 0)
        {
            if(activa == 0)
            {
                activa = imagenes.length-1;
            }
            else if ( activa == imagenes.length-1)
            {
                activa = activa-1;
            }
            else
            {
                activa = activa-1;
            }
            console.log(activa);
            
        }
        imagenes[activa].className = "imagen activa";
        imagenes[(activa == 0) ? imagenes.length-1 : activa-1].className = "imagen left";
        imagenes[(activa == imagenes.length-1) ? 0 : activa+1].className = "imagen rigth";
        
    }

   //para recalcular el alto de ña iimagen
    window.onresize = function(){
    	 proporcion = imagenes[0].naturalHeight/imagenes[0].naturalWidth;
    
         slider.style.height = window.innerWidth * proporcion + "px";
    }
}