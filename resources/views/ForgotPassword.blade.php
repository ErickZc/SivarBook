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
                                <form id="forgotPasswordForm" method="POST" action="{{ route('changePassword') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                                            <label for="correo">Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Contraseña Actual" required>
                                            <label for="current_password">Contraseña Actual</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Nueva Contraseña" required>
                                            <label for="new_password">Nueva Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmar Nueva Contraseña" required>
                                            <label for="confirm_password">Confirmar Nueva Contraseña</label>
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

    // Capturar el envío del formulario
    $(document).ready(function () {
        $("#forgotPasswordForm").submit(function (e) {
            e.preventDefault(); // Evitar envío automático del formulario

            var formData = $(this).serialize();

            // Enviar la solicitud AJAX
            $.ajax({
                type: "POST",
                url: "{{ route('changePassword') }}",
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.href = "{{ route('login') }}"; // Redireccionar al inicio de sesión después del éxito
                    }, 3000); // Esperar 3 segundos antes de redireccionar
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