<link rel="icon" type="image/png" sizes="16x16" href="../situ.png">
<script type="text/javascript">
     var cont = 0;
        var sumar = document.getElementById('sumar');
        var restar = document.getElementById('restar');
        var contadorCaja = document.getElementById('contador');

        function cargarSumar() {
            cont++;
            contadorCaja.innerHTML = "Contador: "+cont;
            $('#contador').val(cont);
       
        }
        function cargarRestar() {
            cont--;
            contadorCaja.innerHTML = "Contador: "+cont;
            $('#contador').val(cont);
        }

        sumar.addEventListener('click', function(event){
            event.preventDefault();
            cargarSumar();
        });
        restar.addEventListener('click', function(event){
            event.preventDefault();
            cargarRestar();
        });

        $('#sumar').on('click',function(){
            
            var valor=$("#contador").val();
            var url="listarTurnosEspeciales.php";

             $.ajax({

               url:url,
               type:"POST",
               data:{valor:valor}

             }).done(function(data){

                   $("#respuesta").html(data);
             })    
         });

        $('#restar').on('click',function(){
            
            var valor=$("#contador").val();
            var url="listarTurnosEspeciales.php";

             $.ajax({

               url:url,
               type:"POST",
               data:{valor:valor}

             }).done(function(data){

                   $("#respuesta").html(data);
             })    
         });


</script>
