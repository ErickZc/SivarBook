<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de credenciales</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" asp-append-version="true" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" asp-append-version="true" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownReportes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reportes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownReportes">
                            <li><a class="dropdown-item" href="#">Lugares Mejor Puntuados</a></li>
                            <li><a class="dropdown-item" href="#">Lugares Por Categoría</a></li>
                            <li><a class="dropdown-item" href="#">Lugares Por Municipio</a></li>
                            <li><a class="dropdown-item" href="#">Emprendedores</a></li>
                            <li><a class="dropdown-item" href="#">Lugares Gratuitos</a></li>
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

    <div class="container contenedor create-post" id="cont" style="height: 534px;">

        <div class="row feed mt-5">   
            
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a>Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cambiar contraseña</li>
                </ol>
            </nav>

            <div class="">
                
                <br />
                <div class="col-md-8 offset-md-2 data-header" id="contenido">
                    <h1 class="text-left fw-bold text-center mb-4">Cambio de contraseñas</h1>
                    <div class="alert alert-danger mb-4" role="alert">
                        <strong>¡Importante!</strong> No olvides cambiar tus contraseñas regularmente para proteger tu seguridad en línea. Utiliza combinaciones únicas de letras, números y símbolos, y evita información personal obvia.
                    </div>

                    <form id="formulario">
                        <div class="row g-3 mb-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Correo Electronico</label>
                            </div>
                            <div class="col-4">
                                <input type="email" class="form-control" id="idEmail" aria-describedby="animacion" required>
                                <div id="animacion" class="invalid-feedback">
                                    El correo no existe!
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="button" id="validarCorreo">
                                    
                                    Check
                                </button>
                            </div>
                        </div>
                        <div id="cambiarPassword" hidden>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="inputPassword" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Requisitos" data-bs-content="Agrega mas de 4 caracteres y al menos un numero">
                                    <div id="feed-1" class="valid-feedback" hidden>
                                        Requisitos correctos!
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Confirmar contraseña</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" id="inputPassword2">
                                    <div id="feed-2" class="valid-feedback" hidden>
                                        Requisitos correctos!
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary" type="button" id="updatePassword">Cambiar contraseña</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
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

    <script>
        $(document).ready(function(){
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var inputPassword = document.getElementById("inputPassword");
            function validarPassword() {

                var valor = inputPassword.value.trim();
                if (valor.length > 4 && /\d/.test(valor)) {
                    inputPassword.classList.add("is-valid");
                    inputPassword.classList.remove("is-invalid");
                    document.getElementById("feed-1").removeAttribute("hidden");
                } else {
                    inputPassword.classList.add("is-invalid");
                    inputPassword.classList.remove("is-valid");
                    document.getElementById("feed-1").setAttribute("hidden", "");
                }
            }

            inputPassword.addEventListener("keypress", function () {
                validarPassword();
            });

            inputPassword.addEventListener("keydown", function () {
                setTimeout(validarPassword, 0);
            });

            var inputPassword2 = document.getElementById("inputPassword2");
            function validarPassword2() {

                var valor = inputPassword2.value.trim();
                if (valor.length > 4 && /\d/.test(valor)) {
                    inputPassword2.classList.add("is-valid");
                    inputPassword2.classList.remove("is-invalid");
                    document.getElementById("feed-2").removeAttribute("hidden");
                } else {
                    inputPassword2.classList.add("is-invalid");
                    inputPassword2.classList.remove("is-valid");
                    document.getElementById("feed-2").setAttribute("hidden", "");
                }
            }

            inputPassword2.addEventListener("keypress", function () {
                validarPassword2();
            });

            inputPassword2.addEventListener("keydown", function () {
                setTimeout(validarPassword2, 0);
            });

            function limpiarCajas() {
                document.getElementById("idEmail").value = "";
                document.getElementById("inputPassword").value = "";
                document.getElementById("inputPassword2").value = "";
            }

            function limpiarClases() {
                document.getElementById("idEmail").classList.remove("is-valid");
                document.getElementById("idEmail").classList.remove("is-invalid");

                document.getElementById("inputPassword").classList.remove("is-valid");
                document.getElementById("inputPassword").classList.remove("is-invalid");

                document.getElementById("inputPassword2").classList.remove("is-valid");
                document.getElementById("inputPassword2").classList.remove("is-invalid");

            }

            $("#validarCorreo").click(function () {
                if ($("#idEmail").val() != "") {

                    var corr = $("#idEmail").val();

                    var formulario = $("#formulario").serialize();
                        $.ajax({
                        url: '{{ route('usuarios.getCorreo') }}',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            data: { correo: corr },
                        beforeSend: function () {
                            $('#validarCorreo').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                        }
                        }).done(function (resp) {

                            console.log(resp);

                            if(resp.length > 0){
                                //Validaciones antes de
                                $('#validarCorreo').empty();
                                $('#validarCorreo').text('Comprobado');
                                $('#validarCorreo').prop('disabled', true);
                                $('#idEmail').prop('disabled', true);
                                $('#animacion').css('visibility', 'hidden');
                                $('#idEmail').removeClass('is-invalid');

                                //validaciones despues de
                                $('#cambiarPassword').removeAttr('hidden');
                                $('#cambiarPassword').css('transition', 'bottom 0.3s ease');
                                $('#cambiarPassword').css('visibility', 'visible');


                                var div = document.getElementById("cambiarPassword");
                                div.style.display = "";

                            }else{
                                $('#validarCorreo').empty();
                                $('#validarCorreo').text('Check');
                                $('#animacion').css('visibility', 'visible');
                                $('#idEmail').addClass('is-invalid');

                            }

                           
                        }).fail(function () {
                            
                        });

                } else {
                    Swal.fire({
                        title: 'Todos los campos son obligatorios',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                }
            });

            $("#updatePassword").click(function () {
                if ($("#inputPassword").val() != "" && $("#inputPassword2").val() != "") {

                    if ($("#inputPassword").val() === $("#inputPassword2").val()) {
                        var inp1 = $("#inputPassword").val();
                        var inp2 = $("#idEmail").val();
                        var inputsInvalidos = $("#formulario .is-invalid").length;

                        if(inputsInvalidos === 0){
                            var formulario = $("#formulario").serialize();
                            $.ajax({
                                url: '{{ route('usuarios.changePassword') }}',
                                type: 'post',
                                cache: false,
                                dataType: 'json',
                                data: { correo: inp2, valor: inp1 }
                            }).done(function (resp) {

                                if (resp) {
                                    Swal.fire({
                                        title: 'La contraseñas se ha modificado correctamente',
                                        icon: 'success',
                                        confirmButtonText: 'Continuar'
                                    })

                                    $('#validarCorreo').empty();
                                    $('#validarCorreo').text('Check');
                                    $('#validarCorreo').prop('disabled', false);
                                    $('#idEmail').prop('disabled', false);
                                    $('#animacion').css('visibility', 'hidden');
                                    $('#idEmail').removeClass('is-invalid');
                                    $('#cambiarPassword').css('visibility', 'hidden');
                                    $('#cont').css('transition', 'bottom 0.3s ease');
                                    limpiarCajas();
                                    limpiarClases();
                                    var div = document.getElementById("cambiarPassword");
                                    div.style.display = "none";

                                } else {
                                    Swal.fire({
                                        title: 'Hubo un error al momento de actualizar el dato',
                                        icon: 'error',
                                        confirmButtonText: 'Continuar'
                                    })
                                }
                            }).fail(function () {
                                Swal.fire({
                                    title: 'Hubo un error al momento de actualizar el dato',
                                    icon: 'error',
                                    confirmButtonText: 'Continuar'
                                })
                            });
                        }else{
                            Swal.fire({
                                title: 'Verifica los textos en rojo para continuar',
                                icon: 'error',
                                confirmButtonText: 'Continuar'
                            })
                        }

                    }else{
                        Swal.fire({
                            title: 'Las contraseñas no coinciden',
                            icon: 'error',
                            confirmButtonText: 'Continuar'
                        })
                    }

                } else {
                    Swal.fire({
                        title: 'Todos los campos son obligatorios',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                }
            });

        });
    </script>

</body>
</html>