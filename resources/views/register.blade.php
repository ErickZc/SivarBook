<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="/css/app.css" rel="stylesheet">
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
            padding: 1rem;
        }
        .form-floating {
            position: relative;
            margin-bottom: 0.5rem;
        }
        .form-floating input,
        .form-select {
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #000;
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
                                <h4 class="text-center mb-4">Registrarse</h4>
                                <!-- Formulario de registro -->
                                <form id="registerForm" method="POST" action="/register">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                            <label for="nombre">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required>
                                            <label for="apellido">Apellido</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" required>
                                            <label for="edad">Edad</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                                            <label for="correo">Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                            <label for="password">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" id="id_rol" name="id_rol" required>
                                            <option value="" selected disabled>Selecciona un rol</option>
                                            @foreach($roles as $rol)
                                            <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-lg">Registrarse</button>
                                    </div>
                                </form>
                                <!-- Fin del formulario de registro -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <div class="text-center">
                                            <a href="/login" class="link-secondary text-decoration-none">¿Ya tienes una cuenta?</a>
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

    $("#registerForm").submit(function (e) {
        e.preventDefault(); // Evitar envío automático del formulario

        // Obtener los datos del formulario
        var formData = $(this).serialize();

        // Realizar petición AJAX al servidor para verificar si el correo existe
        $.ajax({
            type: "POST",
            url: "/register",
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function () {
                        window.location.href = "/login";
                    }, 1000); 
                } else if (response.error) {
                    toastr.error(response.error);
                }
            },
            error: function (xhr, status, error) {
                // toastr.error("Se produjo un error al registrar.");
                toastr.error(xhr.responseJSON.error);
            }
        });
    });
</script>

</body>
</html>