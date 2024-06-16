<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('css/style-404.css') }}" rel="stylesheet">

    <title>Document</title>
    <script>
        // Verificar si el usuario intenta navegar hacia atrás
        window.onload = function () {
            if (window.history && window.history.pushState) {
                window.history.pushState('forward', null, ''); // Agregar una entrada en el historial de navegación
                window.onpopstate = function () {
                    // Cuando el usuario intenta navegar hacia atrás
                    window.location.reload(true); // Forzar la recarga de la página sin caché
                };
            }
        }
    </script>
</head>
<body>
    
   <section class="page_404"> 
       <div class="container">      
           <div class="row">         
               <div class="col-sm-12">
                   <div class="col-sm-10 col-sm-offset-1 text-center">
                       <div class="four_zero_four_bg">
                       <span class="text">404</span>
                       </div>
                       <div class="content_box_404">
                           <h3 class="h2">Upps! parece que estás perdido</h3>
                           <p>Al parecer la página que estás buscando no está disponible</p>
                           <div class="containerF">
                            <a href="{{ url()->previous() }}" class="link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                                </svg>
                                Regresar
                            </a>
                        </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
</body>
</html>