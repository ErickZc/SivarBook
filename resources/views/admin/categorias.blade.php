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
                        <a class="nav-link text-dark" href="/admin">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMantenimiento">
                            <li><a class="dropdown-item" href="{{ route('lugares.index') }}">Lugares</a></li>
                            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                            <li><a class="dropdown-item active" href="{{ route('categorias.index') }}">Categorias</a></li>
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
                <li class="breadcrumb-item active" aria-current="page">Categoria</li>
            </ol>
        </nav>

    <h1 class="text-center fw-bold">Mantenimiento de Categorias</h1>

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
                <h5 class="modal-title" id="exampleModalLabel">Agregando Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form1" name="Form1">
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label class="control-label">Nombre de la categoria</label>
                        <input id="NombreCategoria" name="NombreCategoria" class="form-control" required/>
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
                <h5 class="modal-title" id="exampleModalLabel">Modificar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form2" name="Form2">
                <div class="modal-body">
                    <input id="IdCategoria2" name="IdCategoria2" class="form-control" placeholder="IdDepto" hidden />
                    <div class="form-group mb-1">
                        <label class="control-label">Nombre de la Categoria</label>
                        <input id="NombreCategoria2" name="NombreCategoria2" class="form-control" required/>
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
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
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
                url: '{{ route('categorias.getTablaCategorias') }}',
                type: 'post',
                dataType: 'json',
                cache: false
            }).done(function (resp) {
                console.log(resp);
                var div = $("#contenido");
                var tabla = "<table id='tabla' class='table table-hover'><thead><tr><th class='fw-bold'>Categoria ID</th><th class='fw-bold'>Categoria</th><th class='fw-bold'>Acciones</th></tr></thead><tbody>";
                $.each(resp, function (index, categoria) {
                    tabla += "<tr>";
                    tabla += "<td class='fw-bold'>" + categoria.id_categoria + "</td>";
                    tabla += "<td>" + categoria.nombre_categoria + "</td>";

                    var texto = categoria.nombre_categoria;
                    var textoModificado = texto.replace(/ /g, "-");
                    //console.log(textoModificado);

                    tabla += "<td><a data-bs-toggle='modal' data-bs-target='#exampleModal2' class='btn btn-warning fw-light' onclick=cargarUpt('" + categoria.id_categoria + "&&" + textoModificado + "') >Editar</a> | <a class='btn btn-danger fw-light' href=\"javascript:cargarDel('" + categoria.id_categoria + "')\">Eliminar</a></td>";
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

        function cargarDel(idCategoria) {
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
                        url: '{{ route('categorias.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: { id_categoria: idCategoria }
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
            var textoModificado = obj[1];
            var textoOriginal = textoModificado.replace(/-/g, " ");

            document.getElementById("IdCategoria2").value = obj[0];
            document.getElementById("NombreCategoria2").value = textoOriginal;

        }

        function limpiarCajas(){
            document.getElementById("NombreCategoria").value = "";
        }

        function limpiarClases(){
            document.getElementById("NombreCategoria").classList.remove("is-valid");
            document.getElementById("NombreCategoria").classList.remove("is-invalid");

            document.getElementById("NombreCategoria2").classList.remove("is-valid");
            document.getElementById("NombreCategoria2").classList.remove("is-invalid");
        }

        $(document).ready(function () {

            var inputCategoria = document.getElementById("NombreCategoria");
            function validarCategoria() {

                var valor = inputCategoria.value.trim();
                if (valor.length >= 4) {
                    inputCategoria.classList.add("is-valid");
                    inputCategoria.classList.remove("is-invalid");
                } else {
                    inputCategoria.classList.add("is-invalid");
                    inputCategoria.classList.remove("is-valid");
                }
            }

            inputCategoria.addEventListener("keypress", function () {
                validarCategoria();
            });

            inputCategoria.addEventListener("keydown", function () {
                setTimeout(validarCategoria, 0);
            });

            var inputCategoria2 = document.getElementById("NombreCategoria2");
            function validarCategoria2() {

                var valor = inputCategoria2.value.trim();
                if (valor.length >= 4) {
                    inputCategoria2.classList.add("is-valid");
                    inputCategoria2.classList.remove("is-invalid");
                } else {
                    inputCategoria2.classList.add("is-invalid");
                    inputCategoria2.classList.remove("is-valid");
                }
            }

            inputCategoria2.addEventListener("keypress", function () {
                validarCategoria2();
            });

            inputCategoria2.addEventListener("keydown", function () {
                setTimeout(validarCategoria2, 0);
            });

            cargarTabla();

            $('#Form1').submit(function (event) {
                event.preventDefault();

                if ($("#NombreCategoria").val() != "") {

                    var inputsInvalidos = $("#Form1 .is-invalid").length;

                    if(inputsInvalidos === 0){
                        $.ajax({
                            url: '{{ route('categorias.save') }}',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            data: {nombre_categoria : $("#NombreCategoria").val()}
                        }).done(function (resp) {
                            if (resp) {
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

                if ($("#IdCategoria2").val() != "" && $("#NombreCategoria2").val() != "") {

                    var inputsInvalidos2 = $("#Form2 .is-invalid").length;

                    var obj1 = document.getElementById("IdCategoria2").value;
                    var obj2 = document.getElementById("NombreCategoria2").value;

                    if(inputsInvalidos2 === 0){
                        $.ajax({
                            url: '{{ route('categorias.update') }}',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            data: { id_categoria: obj1, nombre_categoria: obj2 }
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