<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
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
            height: 80%;
            width: 100%;
        }
        .card-body {
            padding: 3rem;
        }
        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-floating input {
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #000;
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
<section class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-custom">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <img class="card-img-top h-100 w-100" src="{{ asset('Sunset-en-el-Tunco-El-Salvador.jpeg') }}" alt="¡Bienvenido, te hemos echado de menos!">
                        </div>                        
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ asset('icon.svg') }}" height="120px" alt="BootstrapBrain Logo" width="300">
                                </div>
                                <h4 class="text-center mb-5">¡Bienvenido, te hemos echado de menos!</h4>
                                <form id="loginForm" method="POST" action="/login">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="correo" id="correo" placeholder="name@example.com" required>
                                            <label for="correo">Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            <label for="password">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                                        <label class="form-check-label text-secondary" for="remember_me">
                                            Mantenerme logueado
                                        </label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-dark btn-lg" type="submit">Iniciar sesión</button>
                                    </div>
                                </form>

                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="text-center">
                                            <a href="{{ route('register') }}" class="link-secondary text-decoration-none">Crear una cuenta</a>
                                            <span class="mx-2 text-muted">|</span>
                                            <a href="{{ route('forgot-password') }}" class="link-secondary text-decoration-none">Olvidé mis credenciales</a>
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

<!-- Scripts -->
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
    
    $("#loginForm").submit(function (e) {
        e.preventDefault(); // Evitar envío automático del formulario

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Realizar petición AJAX al servidor para iniciar sesión
        $.ajax({
            type: "POST",
            url: "{{ route('login') }}",
            data: formData,
            success: function (response) {

            console.log(response.ver);
            console.log(response.redirect);

                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.href = response.redirect; // Redirigir a la página según el tipo de rol
                    }, 1000); // Redirigir después de 1 segundo
                } else if (response.error) {
                    toastr.error(response.error);
                }
            },
            error: function (xhr, status, error) {
                toastr.error(xhr.responseJSON.error);
            }
        });
    });
</script>

</body>
</html>
