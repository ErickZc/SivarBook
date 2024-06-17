<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" asp-append-version="true" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" asp-append-version="true" />
    
    <!-- Agrega el CSS de Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    
    <title>Dashboard</title>
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
<body class="body-image body-html">
<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom box-shadow mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('icon.svg') }}" height="50px" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" id="navbarDropdownMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMantenimiento">
                            <li><a class="dropdown-item" href="{{ route('lugares.index') }}">Lugares</a></li>
                            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a></li>
                            <li><a class="dropdown-item" href="{{ route('departamentos.index') }}">Departamentos</a></li>
                            <li><a class="dropdown-item" href="{{ route('municipio.index') }}">Municipios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" id="navbarDropdownReportes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownReportes">
                            <li><a class="dropdown-item" href="/admin/reporte/lugaresmejorpuntuados">Lugares Mejor Puntuados</a></li>
                            <li><a class="dropdown-item" href="/admin/reporte/lugaresporcategoria">Lugares Por Categoría</a></li>
                            <li><a class="dropdown-item" href="/admin/reporte/lugarespormunicipio">Lugares Por Municipio</a></li>
                            <li><a class="dropdown-item" href="/admin/reporte/lugaresgratuitos">Lugares Gratuitos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('usuarios.indexResetPassword') }}">Cambiar contraseña</a>
                    </li>
                </ul>
                <form id="logout-form" method="post" action="{{ route('logout') }}" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-dark" style="padding: 0;">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>
</header>

<div class="container contenedor">
    <main role="main" class="pb-3">
        <br />
        <br />
        <div class="text-center position-relative">
            <h1 class="display-4">Bienvenido, {{ Auth::user()->nombre }}!</h1>
            <p class="lead">¡Es un gusto tenerte de vuelta!</p>
            <div class="d-flex justify-content-center align-items-center mt-4 position-relative" style="height: 200px;">
                <img src="{{ asset('img/bot.png') }}" alt="Bot Image" class="img-fluid rounded" style="max-width: 200px;">
                <img src="{{ asset('img/hola.png') }}" alt="Hola Image" class="img-fluid rounded" style="max-width: 80px; position: absolute; top: 0; right: 520px;">
            </div>
            <p class="mt-4">Estamos aquí para ayudarte a alcanzar tus objetivos. Explora las últimas novedades y mantente actualizado con nuestras nuevas características.</p>
        </div>
        <br />
        <br />
    </main>
</div>

<!-- Modal para responder preguntas -->
<div class="modal fade" id="preguntasModal" tabindex="-1" aria-labelledby="preguntasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg p-3 mb-5 bg-white rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="preguntasModalLabel">Responder preguntas</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <form id="preguntasForm">
                @csrf <!-- Agrega el campo oculto para el token CSRF -->
                <div class="modal-body">
                @isset($preguntas)
                    @if ($preguntas->isNotEmpty())
                        @foreach($preguntas as $pregunta)
                            <div class="mb-3">
                                <label for="respuesta_texto_{{ $pregunta->id_pregunta }}" class="form-label" style="font-weight: bold">{{ $pregunta->pregunta }}</label>
                                <input type="text" class="form-control" id="respuesta_texto_{{ $pregunta->id_pregunta }}" name="respuestas_texto[{{ $pregunta->id_pregunta }}]" placeholder="Respuesta textual" required>
                            </div>
                        @endforeach
                    @else
                        <p>No hay preguntas disponibles en este momento.</p>
                    @endif
                @else
                    <p>No hay preguntas disponibles en este momento.</p>
                @endisset
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="footer-dark text-muted" id="footer">
    <br>
    <div class="container footer-2">
        <div class="row footer-3">
            <div class="col-md-6">
                <p class="text-start texto-footer">&copy; 2024 - Proyecto Final, Aplicacion de Framework Empresariales</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="text-end">&copy; SivarBook Inc</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

<!-- Agrega el JS de jQuery y Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>   
    toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

    $(document).ready(function() {
        // Mostrar el modal automáticamente si debe responder preguntas
        @isset($debeResponderPreguntas)
            @if ($debeResponderPreguntas)
                var modal = new bootstrap.Modal(document.getElementById('preguntasModal'), {
                    keyboard: false, // Deshabilitar el cierre con la tecla ESC
                    backdrop: 'static' // Evitar el cierre haciendo clic fuera del modal
                });
                modal.show();
            @endif
        @endisset

        $(document).keypress(function(e)    {
                console.log(e);
            if (e.keyCode == 27)
            {
                return false;
            }
        });

        $("#preguntasForm").submit(function (e) {
            e.preventDefault(); // Evitar envío automático del formulario

            // Obtener los datos del formulario
            var formData = $(this).serialize();

            // Realizar petición AJAX al servidor para guardar respuestas
            $.ajax({
                type: "POST",
                url: '{{ route('guardarRespuestasAdmin') }}',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 1500); 
                    } else {
                        toastr.error(response.error);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Se produjo un error al registrar las respuestas.");
                }
            });
        });
    });
</script>

</body>
</html>
