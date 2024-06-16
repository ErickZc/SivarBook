<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
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
                        <a class="nav-link text-dark" href="/admin">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMantenimiento">
                            <li><a class="dropdown-item" href="{{ route('lugares.index') }}">Lugares</a></li>
                            <li><a class="dropdown-item active" href="{{ route('usuarios.index') }}">Usuarios</a></li>
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



    <div class="container contenedor create-post">

        <div class="row feed mt-5">

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item "><a>Inicio</a></li>
                    <li class="breadcrumb-item"><a >Mantenimiento</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuario</li>
                </ol>
            </nav>

            <h1 class="text-center fw-bold">Mantenimiento de Usuarios</h1>

            <div class="data-body">
                <div class="d-grid gap-2 d-flex justify-content-start mb-3">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal" id="agregar">  
                        Nuevo registro
                        &nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                        </svg>
                    </button>
                    </div>
                    <br />
                    <div class="table-responsive mb-5" id="contenido">  
                        <div class="text-center">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Cargando ...</span>
                            </div>
                            <p class="fs-5 mt-2 fw-bold">Cargando ...</p>
                        </div>
                    </div>
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

<!-- Modal agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregando Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form1" name="Form1" enctype="multipart/form-data" method="post">
                <div class="modal-body">              
                        <div class="form-group mb-1">
                            <label  class="control-label">Nombre</label>
                            <input id="Nombre" name="Nombre" class="form-control" required/>
                            <label  class="control-label">Apellido</label>
                            <input id="Apellido" name="Apellido" class="form-control" required />
                            <label  class="control-label">Edad</label>
                            <input id="Edad" name="Edad" class="form-control" required min="14" max="99" />
                            <label  class="control-label">Correo</label>
                            <input id="Correo" name="Correo" class="form-control" type="email" required />
                            <label  class="control-label">Password</label>
                            <input id="Password" name="Password" class="form-control" type="password" required data-bs-toggle="popover" data-bs-title="Requisitos" data-bs-content="Agrega mas de 4 caracteres y al menos un numero" />
                            <div id="feed-1" class="valid-feedback" hidden>
                                Requisitos correctos!
                            </div>
                            <!-- <label class="control-label">Confirmar Password</label> -->
                            <label for="Imagen" class="control-label">Imagen:</label>
                            <input type="file" name="Imagen" id="Imagen" class="form-control" accept="image/jpeg, image/png, image/gif" required />
                            <span class="text-danger"></span>
                        </div>
                        <div class="form-group mb-1">
                            <label  class="control-label">Rol</label>
                            <select id="IdRol" name="IdRol" class="form-control">
                                <option value=""> - Elije uno -</option>
                                @foreach ($rol as $roles)
                                    <option value="{{ $roles->id_rol }}">{{ $roles->nombre_rol }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"></span>
                        </div>
                

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal actualizar -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificando Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form id="Form2" name="Form2">
                    <div class="form-group mb-1">
                        <input id="IdUsuario2" name="IdUsuario2" class="form-control" hidden required/>
                        <label class="control-label">Nombre</label>
                        <input id="Nombre2" name="Nombre2" class="form-control" required />
                        <label class="control-label">Apellido</label>
                        <input id="Apellido2" name="Apellido2" class="form-control" required />
                        <label class="control-label">Edad</label>
                        <input id="Edad2" name="Edad2" class="form-control" required min="14" max="99" />
                        <label class="control-label">Correo</label>
                        <input id="Correo2" name="Correo2" class="form-control" type="email" disabled required/>

                        <label for="" class="control-label">Imagen:</label>
                        <input type="file" name="Imagen2" id="Imagen2" class="form-control" accept="image/jpeg, image/png, image/gif" disabled />
                        <div class="form-check form-switch d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">¿Desea modificar la imagen?</label>
                        </div>

                    </div>
                    <div class="form-group mb-1">
                        <label class="control-label">Rol</label>
                        <select id="IdRol2" name="IdRol2" class="form-control" required>
                            <option value=""> - Elije uno -</option>
                            @foreach ($rol as $roles)
                                <option value="{{ $roles->id_rol }}">{{ $roles->nombre_rol }}</option>
                            @endforeach
                        </select>
                    </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" id="btnCerrar2" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnActualizar" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    var footer = document.getElementById("footer");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            footer.style.bottom = "0";
        } else {
            footer.style.bottom = "-200px";
        }
    }


        function cargarTabla() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('usuarios.getTablaUsuarios') }}',
                type: 'post',
                dataType: 'json',
                cache: false
            }).done(function (resp) {
                var div = $("#contenido");
                var tabla = "<table id='tabla' class='table table-hover'><thead><tr><th class='fw-bold'>Usuario ID</th><th class='fw-bold'>Nombre</th><th class='fw-bold'>Apellido</th><th class='fw-bold'>Edad</th><th class='fw-bold'>Correo</th><th class='fw-bold'>Foto</th><th class='fw-bold'>Rol</th><th class='fw-bold'>Creacion</th><th class='fw-bold'>Acciones</th></tr></thead><tbody>";
                $.each(resp, function (index, usuario) {

                    var img = 'data:image;base64,' + usuario.imagen;
                    var imagenHTML = "<img class='rounded-pill' style='width: 50px;height: 50px;border-radius: 50%;margin-right: 10px;' src='" + img + "' >";


                    tabla += "<tr>";
                    tabla += "<td class='fw-bold'>" + usuario.id_usuario + "</td>";
                    tabla += "<td>" + usuario.nombre + "</td>";
                    tabla += "<td>" + usuario.apellido + "</td>";
                    tabla += "<td>" + usuario.edad + "</td>";
                    tabla += "<td>" + usuario.correo + "</td>";
                    tabla += "<td>" + imagenHTML + "</td>";
                    tabla += "<td>" + usuario.nombre_rol + "</td>";
                    tabla += "<td>" + usuario.fechaCreacion + "</td>";

                    var tNombre = usuario.nombre;
                    var tNombreModificado = tNombre.replace(/ /g, "-");
                    var tApellido = usuario.apellido;
                    var tApellidoModificado = tApellido.replace(/ /g, "-");

                    tabla += "<td><a data-bs-toggle='modal' data-bs-target='#exampleModal2' class='fw-light btn btn-warning' onclick=cargarUpt('" + usuario.id_usuario
                        + "&&" + tNombreModificado + "&&" + tApellidoModificado + "&&" + usuario.edad + "&&" + usuario.correo + "&&" + usuario.id_rol + "') >Editar</a> | <a class='fw-light btn btn-danger' href=\"javascript:cargarDel('" + usuario.id_usuario + "')\">Eliminar</a></td>";
                    tabla += "</tr>";
                });
                tabla += "</tbody></table>";
                div.empty();
                div.append(tabla);

                //$('#tabla').DataTable();

                var table = new DataTable('#tabla', {
                language: {
                    url: '{{ asset('ES.json') }}',
                },
                });

            }).fail();

        }

        function cargarDel(idUsuario) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Estas seguro?',
                text: "Una vez eliminado se pierde definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('usuarios.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: { id_usuario: idUsuario }
                    }).done(function (resp) {
                        if (resp) {
                            swalWithBootstrapButtons.fire(
                                'Eliminado!',
                                'Tu registro ha sido elimando.',
                                'success'
                            )
                            cargarTabla();
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Cancelado',
                                'Se omitieron los datos',
                                'error'
                            )
                        }
                    }).fail();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Se han omitido los datos',
                        'error'
                    )
                }
            })
        }

        function cargarUpt(valor) {

            var obj = valor.split('&&');
            var tNombreModificado = obj[1];
            var tNombreOriginal = tNombreModificado.replace(/-/g, " ");
            var tApellidoModificado = obj[2];
            var tApellidoOriginal = tApellidoModificado.replace(/-/g, " ");

            document.getElementById("IdUsuario2").value = obj[0];
            document.getElementById("Nombre2").value = tNombreOriginal;
            document.getElementById("Apellido2").value = tApellidoOriginal;
            document.getElementById("Edad2").value = obj[3];
            document.getElementById("Correo2").value = obj[4];
            document.getElementById("IdRol2").value = obj[5];
            
        }

        function limpiarCajas(){
            $("#Nombre").val("");
            $("#Apellido").val("");
            $("#Edad").val("");
            $("#Correo").val("");
            $("#Password").val("");
            $("#IdRol").val("");
            $("#Imagen").val("");
        }

        function limpiarClases(){
            document.getElementById("Nombre").classList.remove("is-valid");
            document.getElementById("Nombre").classList.remove("is-invalid");
            document.getElementById("Apellido").classList.remove("is-valid");
            document.getElementById("Apellido").classList.remove("is-invalid");
            document.getElementById("Edad").classList.remove("is-valid");
            document.getElementById("Edad").classList.remove("is-invalid");
            document.getElementById("Correo").classList.remove("is-valid");
            document.getElementById("Correo").classList.remove("is-invalid");
            document.getElementById("Password").classList.remove("is-valid");
            document.getElementById("Password").classList.remove("is-invalid");
            document.getElementById("IdRol").classList.remove("is-valid");
            document.getElementById("IdRol").classList.remove("is-invalid");

            document.getElementById("Nombre2").classList.remove("is-valid");
            document.getElementById("Nombre2").classList.remove("is-invalid");
            document.getElementById("Apellido2").classList.remove("is-valid");
            document.getElementById("Apellido2").classList.remove("is-invalid");
            document.getElementById("Edad2").classList.remove("is-valid");
            document.getElementById("Edad2").classList.remove("is-invalid");
            document.getElementById("Correo2").classList.remove("is-valid");
            document.getElementById("Correo2").classList.remove("is-invalid");
            document.getElementById("IdRol2").classList.remove("is-valid");
            document.getElementById("IdRol2").classList.remove("is-invalid");
        }

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const radioInput = document.getElementById('flexSwitchCheckDefault');
            const fileInput = document.getElementById('Imagen2');

            radioInput.addEventListener('change', function () {
                if (radioInput.checked) {
                    fileInput.disabled = false;
                } else {
                    fileInput.disabled = true;
                    document.getElementById("Imagen2").value = "";
                }
            });

            // Modal Agregar
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

            var inputNombre = document.getElementById("Nombre");
            function validarNombre() {

                var valor = inputNombre.value.trim();
                if (valor.length >= 4) {
                    inputNombre.classList.add("is-valid");
                    inputNombre.classList.remove("is-invalid");
                } else {
                    inputNombre.classList.add("is-invalid");
                    inputNombre.classList.remove("is-valid");
                }
            }

            inputNombre.addEventListener("keypress", function () {
                validarNombre();
            });

            inputNombre.addEventListener("keydown", function () {
                setTimeout(validarNombre, 0);
            });

            var inputApellido = document.getElementById("Apellido");
            function validarApellido() {

                var valor = inputApellido.value.trim();
                if (valor.length >= 4) {
                    inputApellido.classList.add("is-valid");
                    inputApellido.classList.remove("is-invalid");
                } else {
                    inputApellido.classList.add("is-invalid");
                    inputApellido.classList.remove("is-valid");
                }
            }

            inputApellido.addEventListener("keypress", function () {
                validarApellido();
            });

            inputApellido.addEventListener("keydown", function () {
                setTimeout(validarApellido, 0);
            });

            var inputEdad = document.getElementById("Edad");
            inputEdad.addEventListener("keypress", function (event) {
                var keyCode = event.keyCode || event.which;

                if (keyCode < 48 || keyCode > 57) {
                    event.preventDefault();
                    inputEdad.classList.add("is-invalid");
                    inputEdad.classList.remove("is-valid");
                }else{
                    inputEdad.classList.add("is-valid");
                    inputEdad.classList.remove("is-invalid");
                    
                }
            });

            var inputEmail = document.getElementById("Correo");
            var correo = inputEmail.value;
            inputEmail.addEventListener("keypress", function(event) {
             
              var char = String.fromCharCode(event.keyCode);              
              var pattern = /[a-zA-Z0-9@@._-]/;

              if (!pattern.test(char)) {
                if(correo.includes("@@") && correo.includes(".")){
                        event.preventDefault();
                        inputEmail.classList.add("is-invalid");
                        inputEmail.classList.remove("is-valid");
                }else{
                        inputEmail.classList.add("is-valid");
                        inputEmail.classList.remove("is-invalid");
                }
              }else{
                    inputEmail.classList.add("is-valid");
                    inputEmail.classList.remove("is-invalid");
              }
            });

            var inputPassword = document.getElementById("Password");
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

            var selectRol = document.getElementById("IdRol");
            selectRol.addEventListener("change", function () {
                if (selectRol.value !== "") {
                    selectRol.classList.add("is-valid");
                    selectRol.classList.remove("is-invalid");
                } else {
                    selectRol.classList.add("is-invalid");
                    selectRol.classList.remove("is-valid");
                }
            });

            // Termina Modal Agregar
            
            // Modal Actualizar

            var inputNombre2 = document.getElementById("Nombre2");
            function validarNombre2() {

                var valor = inputNombre2.value.trim();
                if (valor.length >= 4) {
                    inputNombre2.classList.add("is-valid");
                    inputNombre2.classList.remove("is-invalid");
                } else {
                    inputNombre2.classList.add("is-invalid");
                    inputNombre2.classList.remove("is-valid");
                }
            }

            inputNombre2.addEventListener("keypress", function () {
                validarNombre2();
            });

            inputNombre2.addEventListener("keydown", function () {
                setTimeout(validarNombre2, 0);
            });

            var inputApellido2 = document.getElementById("Apellido2");
            function validarApellido2() {

                var valor = inputApellido2.value.trim();
                if (valor.length >= 4) {
                    inputApellido2.classList.add("is-valid");
                    inputApellido2.classList.remove("is-invalid");
                } else {
                    inputApellido2.classList.add("is-invalid");
                    inputApellido2.classList.remove("is-valid");
                }
            }

            inputApellido2.addEventListener("keypress", function () {
                validarApellido2();
            });

            inputApellido2.addEventListener("keydown", function () {
                setTimeout(validarApellido2, 0);
            });

            var inputEdad2 = document.getElementById("Edad2");
            inputEdad2.addEventListener("keypress", function (event) {
                var keyCode = event.keyCode || event.which;

                if (keyCode < 48 || keyCode > 57) {
                    event.preventDefault();
                    inputEdad2.classList.add("is-invalid");
                    inputEdad2.classList.remove("is-valid");
                } else {
                    inputEdad2.classList.add("is-valid");
                    inputEdad2.classList.remove("is-invalid");

                }
            });

            var selectRol2 = document.getElementById("IdRol2");
            selectRol2.addEventListener("change", function () {
                if (selectRol2.value !== "") {
                    selectRol2.classList.add("is-valid");
                    selectRol2.classList.remove("is-invalid");
                } else {
                    selectRol2.classList.add("is-invalid");
                    selectRol2.classList.remove("is-valid");
                }
            });

            // Termina Modal Actualizar
            
            
            $('#Form1').submit(function (event) {
                event.preventDefault();

                if ($("#Nombre").val() != "" && $("#Apellido").val() != "" &&
                    $("#Edad").val() != "" && $("#Correo").val() != "" &&
                    $("#Password").val() != "" && $("#IdRol").val() != ""){

                    var inputsInvalidos = $("#Form1 .is-invalid").length;
                    var corr = $("#Correo").val();

                    var formData = new FormData($('#Form1')[0]);

                    $.ajax({
                        url: '{{ route('usuarios.getCorreo') }}',
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: { correo: corr }
                    }).done(function(resp){

                        if(resp.length > 0){
                            Swal.fire({
                                title: 'El correo electronico ya existe',
                                icon: 'error',
                                confirmButtonText: 'Continuar'
                            })
                        }else{
                            if(inputsInvalidos === 0){
                                $.ajax({
                                    url: '{{ route('usuarios.save') }}',
                                    type: 'POST',
                                    data: formData,
                                    dataType: 'json',
                                    cache: false,
                                    processData: false,
                                    contentType: false
                                }).done(function (respuesta) {
                                    if (respuesta) {
                                        Swal.fire({
                                            title: 'El registro ha sido agregado correctamente',
                                            icon: 'success',
                                            confirmButtonText: 'Continuar'
                                        })
                                        cargarTabla();
                                        $("#btnCerrar").click();
                                        limpiarCajas();
                                        limpiarClases();
                                    } else {
                                        Swal.fire({
                                            title: 'Hubo un error al momento de agregar el dato',
                                            icon: 'error',
                                            confirmButtonText: 'Continuar'
                                        })
                                    }
                                }).fail(function () {
                                    Swal.fire({
                                        title: 'Hubo un error al momento de agregar el dato',
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
                        }
                    }).fail(); 
                } else {
                    Swal.fire({
                        title: 'Todos los campos son obligatorios',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                }
            });


            $('#Form2').submit(function (event) {
                event.preventDefault();

                var inputsInvalidos = $("#Form2 .is-invalid").length;
                var idUser = $("#IdUsuario2").val();
                var name = $("#Nombre2").val();
                var lastName = $("#Apellido2").val();
                var age = $("#Edad2").val();
                var rol = $("#IdRol2").val();
                var im = $("#Imagen2").val();


                if (!radioInput.checked) {
                    if (idUser != "" && name != "" && lastName != ""
                        && age != "" && rol != "") {

                        if (inputsInvalidos === 0) {
                            $.ajax({
                                url: '{{ route('usuarios.update') }}',
                                type: 'post',
                                cache: false,
                                dataType: 'json',
                                data: { id_usuario: idUser, id_rol: rol, nombre: name, apellido: lastName, edad: age }
                            }).done(function (resp) {
                                if (resp) {
                                    Swal.fire({
                                        title: 'El registro ha sido modificado correctamente',
                                        icon: 'success',
                                        confirmButtonText: 'Continuar'
                                    })
                                    cargarTabla();
                                    $("#btnCerrar2").click();
                                    limpiarCajas();
                                    limpiarClases();
                                } else {
                                    Swal.fire({
                                        title: 'Hubo un error al momento de modificar el dato',
                                        icon: 'error',
                                        confirmButtonText: 'Continuar'
                                    })
                                }
                            }).fail(function () {
                                Swal.fire({
                                    title: 'Hubo un error al momento de modificar el dato',
                                    icon: 'error',
                                    confirmButtonText: 'Continuar'
                                })
                            });;

                        } else {
                            Swal.fire({
                                title: 'Verifica los textos en rojo para continuar',
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
                }else{
                    if (idUser != "" && name != "" && lastName != ""
                        && age != "" && rol != "" && im != "") {

                        if (inputsInvalidos === 0) {

                            var formData2 = new FormData($('#Form2')[0]);

                            $.ajax({
                                url: '{{ route('usuarios.updateImage') }}',
                                type: 'POST',
                                data: formData2,
                                dataType: 'json',
                                cache: false,
                                processData: false,
                                contentType: false
                            }).done(function (resp) {
                                if (resp) {
                                    Swal.fire({
                                        title: 'El registro ha sido modificado correctamente',
                                        icon: 'success',
                                        confirmButtonText: 'Continuar'
                                    })
                                    cargarTabla();
                                    $("#btnCerrar2").click();
                                    limpiarCajas();
                                    limpiarClases();
                                    radioInput.checked = false;
                                    fileInput.disabled = true;
                                    document.getElementById("Imagen2").value = "";
                                } else {
                                    Swal.fire({
                                        title: 'Hubo un error al momento de modificar el dato',
                                        icon: 'error',
                                        confirmButtonText: 'Continuar'
                                    })
                                }
                            }).fail(function () {
                                Swal.fire({
                                    title: 'Hubo un error al momento de modificar el dato',
                                    icon: 'error',
                                    confirmButtonText: 'Continuar'
                                })
                            });;

                        } else {
                            Swal.fire({
                                title: 'Verifica los textos en rojo para continuar',
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
                }

            });



            
            cargarTabla();
        });
    </script>


</body>
</html>