<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .bg-light {
            background-color: #f8f9fa;
            height: 100%;
        }
        .card-img-top {
            border-radius: 0.5rem 0 0 0.5rem;
            object-fit: cover;
            height: 100%;
            width: 100%;
        }
        .card-body {
            padding: 1rem;
        }
        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-floating input,
        .form-select {
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
        }
        .form-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: white;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23111111" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
            background-repeat: no-repeat;
            background-position-x: calc(100% - 10px);
            background-position-y: center;
            padding-right: 2.5rem;
        }
        .btn-dark:hover {
            background-color: #23272b;
            border-color: #1d2124;
        }
        .shadow-custom {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, 
            rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, 
            rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
    </style>
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

<section class="bg-light py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-custom">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <img class="card-img-top h-100 w-100" src="/Sunset-en-el-Tunco-El-Salvador.jpeg" alt="¡Bienvenido, te hemos echado de menos!">
                        </div>                        
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <img src="/icon.svg" height="120px" alt="BootstrapBrain Logo" width="300">
                                </div>
                                <h4 class="text-center mb-4">Olvidé Credenciales</h4>
                                <!-- Formulario de olvidé credenciales -->
                                <form id="forgotPasswordForm" method="POST" action="{{ route('sendPasswordResetEmail') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                                            <label for="correo">Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-lg">Enviar Correo</button>
                                    </div>
                                </form>
                                <!-- Fin del formulario de olvidé credenciales -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="text-center">
                                            <a href="{{ route('login') }}" class="link-secondary text-decoration-none">¿Recuerdas tu contraseña? Inicia sesión aquí.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
<!-- Modal para cambiar contraseña -->
<div class="modal fade" id="cambiarContrasenaModal" tabindex="-1" aria-labelledby="cambiarContrasenaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarContrasenaModalLabel">Cambiar Contraseña</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <form id="cambiarContrasenaForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> -->
                    <button type="submit" class="btn btn-primary">Guardar Contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Agrega el JS de jQuery y Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(document).ready(function () {
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

        $("#forgotPasswordForm").submit(function (e) {
            e.preventDefault(); // Evitar envío automático del formulario

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('sendPasswordResetEmail') }}",
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    var modal = new bootstrap.Modal(document.getElementById('preguntasModal'), {
                        keyboard: false, // Deshabilitar el cierre con la tecla ESC
                        backdrop: 'static' // Evitar el cierre haciendo clic fuera del modal
                    });
                    modal.show();
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseJSON.error);
                }
            });
        });

        $("#preguntasForm").submit(function (e) {
            e.preventDefault(); // Evitar envío automático del formulario

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('changePassword') }}",
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    $('#preguntasModal').modal('hide');
                    var modal = new bootstrap.Modal(document.getElementById('cambiarContrasenaModal'), {
                        keyboard: false, // Deshabilitar el cierre con la tecla ESC
                        backdrop: 'static' // Evitar el cierre haciendo clic fuera del modal
                    });
                    modal.show();
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseJSON.error);
                }
            });
        });

        $("#cambiarContrasenaForm").submit(function (e) {
            e.preventDefault(); // Evitar envío automático del formulario

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('guardarNuevaContrasena') }}", // Ajusta la ruta según sea necesario
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    $('#cambiarContrasenaModal').modal('hide');
                    setTimeout(function () {
                        window.location.href = "{{ route('login') }}";
                    }, 1000);
                },
                error: function (xhr, status, error) {
                    toastr.error(xhr.responseJSON.error);
                }
            });
        });
    });
</script>



</body>
</html>