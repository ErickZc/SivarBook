<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Lugares</title>
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
    
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <x-head.tinymce-config/>
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
                            <li><a class="dropdown-item active" href="{{ route('lugares.index') }}">Lugares</a></li>
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

<div class="container contenedor create-post">
    <div class="row feed mt-5">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a>Inicio</a></li>
            <li class="breadcrumb-item"><a >Mantenimiento</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lugares</li>
        </ol>
    </nav>

        <h1 class="text-center fw-bold">Mantenimiento de Lugares</h1>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregando Lugar turistico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form1" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="IdUsuario" class="control-label">Emprendedor:</label>
                        <select name="IdUsuario" id="IdUsuario" class="form-control" required>
                            <option value="">Seleccione un emprendedor</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group mb-1">
                        <label for="NombreLugar" class="control-label">Nombre del Lugar:</label>
                        <input type="text" name="NombreLugar" id="NombreLugar" class="form-control" placeholder="Escribe el nombre" required />
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-floating">
                        <textarea name="Descripcion" id="Descripcion" class="form-control" placeholder="Escribe una descripcion"></textarea>
                        <label for="Descripcion">Escribe la descripcion del lugar</label>
                    </div>
                    <div class="form-group mb-1">
                        <label class="control-label">Departamento:</label>
                        <select name="idDepto" id="idDepto" class="form-control" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id_depto }}">{{ $departamento->departamento }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label class="control-label">Municipio:</label>
                        <select name="IdMunicipio" id="IdMunicipio" class="form-control" required disabled>
                            <option value="">Seleccione un municipio</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}">{{ $municipio->id_municipio }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label for="Precio" class="control-label">Precio del Lugar:</label>
                        <input type="text" name="Precio" id="Precio" class="form-control" required />
                        <span class="text-danger"></span>

                        <label for="Imagen" class="control-label">Imagen:</label>
                        <input type="file" name="imagenArchivo" id="Imagen" class="form-control" accept="image/jpeg, image/png, image/gif" required />
                        <span class="text-danger"></span>

                    </div>
                    <div class="form-group mb-1">
                        <label for="IdCategoria" class="control-label">Categoria:</label>
                        <select name="IdCategoria" id="IdCategoria" class="form-control" required>
                            <option value="">Seleccione una categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCerrar" class="btn btn-outline-secondary buttonGeneric flex-grow-1" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary buttonAdd buttonGeneric flex-grow-1">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal actualizar -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Modificando Lugar turistico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form2" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <input type="hidden" id="idLugar" name="idLugar" class="form-control" required />
                    </div>
                    <div class="form-group mb-1">
                        <label for="IdUsuario2" class="control-label">Emprendedor:</label>
                        <select name="IdUsuario2" id="IdUsuario2" class="form-control" required>
                            <option value="">Seleccione un emprendedor</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label for="NombreLugar2" class="control-label">Nombre del Lugar:</label>
                        <input type="text" name="NombreLugar2" id="NombreLugar2" class="form-control" placeholder="Escribe el nombre" required />
                    </div>
                    <div class="form-floating">
                        <textarea name="Descripcion2" id="Descripcion2" class="form-control" placeholder="Escribe una descripcion"></textarea>
                        <label for="Descripcion2">Escribe la descripcion del lugar</label>
                    </div>
                    <div class="form-group mb-1">
                        <label class="control-label">Departamento:</label>
                        <select name="idDepto2" id="idDepto2" class="form-control" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id_depto }}">{{ $departamento->departamento }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label class="control-label">Municipio:</label>
                        <select name="IdMunicipio2" id="IdMunicipio2" class="form-control" required>
                            <option value="">Seleccione un municipio</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}">{{ $municipio->municipio }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <label for="Precio2" class="control-label">Precio del Lugar:</label>
                        <input type="text" name="Precio2" id="Precio2" class="form-control" required />

                        <label for="Imagen2" class="control-label">Imagen:</label>
                        <input type="file" name="imagenArchivo2" id="Imagen2" class="form-control" accept="image/jpeg, image/png, image/gif" disabled />

                    </div>
                    <div class="form-check form-switch d-grid gap-2 d-md-flex justify-content-md-end">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">¿Desea modificar la imagen?</label>
                    </div>
                    <div class="form-group mb-1">
                        <label for="IdCategoria2" class="control-label">Categoria:</label>
                        <select name="IdCategoria2" id="IdCategoria2" class="form-control" required>
                            <option value="">Seleccione una categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCerrar2" class="btn btn-outline-secondary buttonGeneric flex-grow-1" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnActualizar" class="btn btn-primary buttonAdd buttonGeneric flex-grow-1">Actualizar</button>
                </div>
            </form>
        </div>
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
        console.log("si entra");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route('lugares.getTablaLugares') }}',
            type: 'post',
            dataType: 'json',
            cache: false
        }).done(function (resp) {
            var div = $("#contenido");
            var tabla = "<table id='tabla' class='table table-hover'><thead><tr><th class='fw-bold'>ID</th><th class='fw-bold'>Usuario</th><th class='fw-bold'>Nombre</th><th class='fw-bold'>Descripcion</th><th class='fw-bold'>Departamento</th><th class='fw-bold'>Categoria</th><th class='fw-bold'>Precio</th><th class='fw-bold'>Imagen</th><th class='fw-bold'>Fecha</th><th class='fw-bold'>Acciones</th></tr></thead><tbody >";
                                
            $.each(resp, function (index, lugares) {

                var img = 'data:image;base64,' + lugares.imagen;
                var imagenHTML = "<img class='rounded-pill' style='width: 50px;height: 50px;border-radius: 50%;margin-right: 10px;' src='" + img + "' >";


                tabla += "<tr>";
                tabla += "<td class='fw-bold'>" + lugares.idLugar + "</td>";
                tabla += "<td>" + lugares.user + "</td>";
                tabla += "<td>" + lugares.nombre + "</td>";

                var descripcion = lugares.descripcion.length > 40 ? "<p class='fst-italic text-decoration-line-through'>Texto muy grande</p>" : lugares.descripcion;
                    
                tabla += "<td>" + descripcion + "</td>";
                // tabla += "<td>" + lugares.municipio + "</td>";
                tabla += "<td>" + lugares.departamento + "</td>";
                tabla += "<td>" + lugares.categoria + "</td>";
                tabla += "<td>" + lugares.precio + "</td>";
                tabla += "<td>" + imagenHTML + "</td>";
                tabla += "<td>" + lugares.fecha + "</td>";

                var texto2 = lugares.nombre;
                var textomodificado2 = texto2.replace(/ /g, "-");

                var texto3 = lugares.descripcion;
                var textomodificado3 = btoa(texto3.replace(/ /g, "-"));

                tabla += "<td><a data-bs-toggle='modal' data-bs-target='#exampleModal2' class='fw-light btn btn-warning btn-sm buttonGeneric' onclick=\"cargarUpt('" + lugares.idLugar + "&&" + lugares.idUser + "&&" + textomodificado2 + "&&" + textomodificado3 + "&&" + lugares.idMunicipio + "&&" + lugares.idDepto + "&&" + lugares.idCategoria + "&&" + lugares.precio2 + "')\">Editar</a> | <a class='fw-light btn btn-danger btn-sm buttonGeneric' href=\"javascript:cargarDel('" + lugares.idLugar + "')\">Eliminar</a></td>";
                tabla += "</tr>";
            });
            tabla += "</tbody></table>";
            div.empty();
            div.append(tabla);

            var table = new DataTable('#tabla', {
                language: {
                    url: '{{ asset('ES.json') }}',
                },
            });


        }).fail(function () {
            console.log('Error en la petición');
        });
    }

    function cargarDel(idLugar) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-4'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Confirmación',
            text: "¿Estás seguro(a) que deseas eliminar el registro seleccionado?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('lugares.destroy') }}',
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: { id: idLugar }
                }).done(function (resp) {
                    if (resp) {
                        swalWithBootstrapButtons.fire(
                            'Eliminado',
                            'El registro seleccionado ha sido eliminado correctamente',
                            'success'
                        )
                        cargarTabla();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'Se canceló el proceso de eliminación',
                            'error'
                        )
                    }
                }).fail(function () {
                    swalWithBootstrapButtons.fire(
                        'Hubo un error al momento de eliminar el dato',
                        'error'
                    )
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Se canceló el proceso de eliminación',
                    'error'
                )
            }
        })
    }

    function cargarUpt(lugar) {
        console.log(lugar);
        var obj = lugar.split('&&');
        var textoModificado1 = obj[2];
        var textoOriginal1 = textoModificado1.replace(/-/g, " ");

        var textoModificado2 = obj[3];

        var textoOriginal2 = atob(textoModificado2);

         var textoOriginal3 = textoOriginal2.replace(/-/g, " ");


        document.getElementById("idLugar").value = obj[0];
        document.getElementById("IdUsuario2").value = obj[1];
        document.getElementById("NombreLugar2").value = textoOriginal1;

        tinymce.get("Descripcion2").setContent(textoOriginal3);

        // document.getElementById("Descripcion2").value = textoOriginal3;
        document.getElementById("IdMunicipio2").value = obj[4];
        document.getElementById("idDepto2").value = obj[5];
        document.getElementById("IdCategoria2").value = obj[6];
        document.getElementById("Precio2").value = obj[7];
    }

    function limpiarCajas() {
        $('#IdUsuario').val('');
        $('#NombreLugar').val('');
        $('#Descripcion').val('');
        $('#idDepto').val('');
        $('#IdMunicipio').val('');
        $('#Precio').val('');
        $('#Imagen').val('');
        $('#IdCategoria').val('');
    }

    function limpiarClases() {
        $('#IdUsuario').removeClass('is-valid');
        $('#NombreLugar').removeClass('is-valid');
        $('#Descripcion').removeClass('is-valid');
        $('#idDepto').removeClass('is-valid');
        $('#IdMunicipio').removeClass('is-valid');
        $('#Precio').removeClass('is-valid');
        $('#Imagen').removeClass('is-valid');
        $('#IdCategoria').removeClass('is-valid');

        $('#IdUsuario').removeClass('is-invalid');
        $('#NombreLugar').removeClass('is-invalid');
        $('#Descripcion').removeClass('is-invalid');
        $('#idDepto').removeClass('is-invalid');
        $('#IdMunicipio').removeClass('is-invalid');
        $('#Precio').removeClass('is-invalid');
        $('#Imagen').removeClass('is-invalid');
        $('#IdCategoria').removeClass('is-invalid');

        $('#IdUsuario2').removeClass('is-valid');
        $('#NombreLugar2').removeClass('is-valid');
        $('#Descripcion2').removeClass('is-valid');
        $('#idDepto2').removeClass('is-valid');
        $('#IdMunicipio2').removeClass('is-valid');
        $('#Precio2').removeClass('is-valid');
        $('#Imagen2').removeClass('is-valid');
        $('#IdCategoria2').removeClass('is-valid');

        $('#IdUsuario2').removeClass('is-invalid');
        $('#NombreLugar2').removeClass('is-invalid');
        $('#Descripcion2').removeClass('is-invalid');
        $('#idDepto2').removeClass('is-invalid');
        $('#IdMunicipio2').removeClass('is-invalid');
        $('#Precio2').removeClass('is-invalid');
        $('#Imagen2').removeClass('is-invalid');
        $('#IdCategoria2').removeClass('is-invalid');
    }

    $(document).ready(function () {

        $('#IdCategoria2').change(function() {
            var cat = $("#IdCategoria2").val();
            console.log('id: ' + cat)
        });

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

        $("#idDepto").change(function () {
            var selectedValue = $(this).val();
            if(selectedValue != ""){

                document.getElementById("IdMunicipio").removeAttribute("disabled");
                var idDepto = $("#idDepto").val();
                $("#IdMunicipio").empty();
                $("#IdMunicipio").append('<option value="">' + "Seleccione un municipio" + '</option>');

                $.ajax({
                    type: "post",
                    url: '{{ route('lugares.getTablaMunicipioByIdDepto') }}',
                    cache: false,
                    dataType: 'json',
                    data: { id: selectedValue }
                }).done(function (resp){
                    $.each(resp, function (index, muni){
                        $("#IdMunicipio").append('<option value="' + muni.id_municipio + '">' + muni.municipio + '</option>');
                    });
                });
            }else{
                document.getElementById("IdMunicipio").classList.remove("is-invalid");
                document.getElementById("IdMunicipio").classList.remove("is-valid");
                $("#IdMunicipio").empty();
                $("#IdMunicipio").append('<option value="">' + "Seleccione un municipio" + '</option>');
                document.getElementById("IdMunicipio").setAttribute("disabled", "disabled");
            }
        });

        $("#idDepto2").change(function () {
        var selectedValue = $(this).val();
        if (selectedValue != "") {

            document.getElementById("IdMunicipio2").removeAttribute("disabled");
            var idDepto2 = $("#idDepto2").val();
            $("#IdMunicipio2").empty();
            $("#IdMunicipio2").append('<option value="">' + "Seleccione un municipio" + '</option>');

            $.ajax({
                type: "post",
                    url: '{{ route('lugares.getTablaMunicipioByIdDepto') }}',
                    cache: false,
                    dataType: 'json',
                    data: { id: selectedValue }
            }).done(function (resp) {
                $.each(resp, function (index, muni) {
                    $("#IdMunicipio2").append('<option value="' + muni.id_municipio + '">' + muni.municipio + '</option>');
                });
            });
        } else {
            document.getElementById("IdMunicipio2").classList.remove("is-invalid");
            document.getElementById("IdMunicipio2").classList.remove("is-valid");
            $("#IdMunicipio2").empty();
            $("#IdMunicipio2").append('<option value="">' + "Seleccione un municipio" + '</option>');
            document.getElementById("IdMunicipio2").setAttribute("disabled", "disabled");
        }
        });


        $('#Form1').submit(function (event) {
            event.preventDefault();

            var inputsInvalidos = $("#Form1 .is-invalid").length;
            var idUser = $("#IdUsuario").val();
            var nombre = $("#NombreLugar").val();
            var desc = $("#Descripcion").val();
            var muni = $("#IdMunicipio").val();
            var prec = $("#Precio").val();
            var cat = $("#IdCategoria").val();
            

            if(idUser != "" && nombre != "" && desc != ""
            && muni != "" && prec != "" && cat != ""){

                if(inputsInvalidos === 0){
                    $.ajax({
                        url: '{{ route('lugares.save') }}',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function (resp) {
                        console.log(resp);
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
                            tinymce.get('Descripcion').setContent('');
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
                    });;

                }else{
                    Swal.fire({
                        title: 'Verifica los textos en rojo para continuar',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })
                }
            }else{
                Swal.fire({
                    title: 'Todos los campos son obligatorios',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        $('#Form2').submit(function (event) {
            event.preventDefault();

            var formData = new FormData();
            var inputsInvalidos = $("#Form2 .is-invalid").length;
            var idUser = $("#IdUsuario2").val();
            var idlugar = $("#idLugar").val();
            var nombr = $("#NombreLugar2").val();
            var desc = $("#Descripcion2").val();
            var muni = $("#IdMunicipio2").val();
            var prec = $("#Precio2").val();
            var cat = $("#IdCategoria2").val();
            var formulario = $("#Form2").serialize();
            var im = $("#Imagen2").val();

            if (!radioInput.checked) {
                if (idUser != "" && nombr != "" && desc != ""
                    && muni != "" && prec != "" && cat != "") {

                    if (inputsInvalidos === 0) {
                        $.ajax({
                            url: '{{ route('lugares.update') }}',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            data: { id_lugar: idlugar, id_usuario: idUser, id_categoria: cat, nombre: nombr, descripcion: desc, id_municipio: muni, precio: prec }
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
                                tinymce.get('Descripcion2').setContent('');
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
                if (idUser != "" && nombr != "" && desc != ""
                    && muni != "" && prec != "" && cat != "" && im != "") {

                    if (inputsInvalidos === 0) {

                        $.ajax({
                            url: '{{ route('lugares.updateImage') }}',
                            type: 'POST',
                            data: new FormData(this),
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

        // -----------------
        var selectUsuario = document.getElementById("IdUsuario");
            selectUsuario.addEventListener("change", function () {
                if (selectUsuario.value !== "") {
                    selectUsuario.classList.add("is-valid");
                    selectUsuario.classList.remove("is-invalid");
                } else {
                    selectUsuario.classList.add("is-invalid");
                    selectUsuario.classList.remove("is-valid");
                }
            });

            var inputNombre = document.getElementById("NombreLugar");
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

            var inputDescripcion = document.getElementById("Descripcion");
            function validarDescripcion() {

                var valor = inputDescripcion.value.trim();
                if (valor.length >= 4) {
                    inputDescripcion.classList.add("is-valid");
                    inputDescripcion.classList.remove("is-invalid");
                } else {
                    inputDescripcion.classList.add("is-invalid");
                    inputDescripcion.classList.remove("is-valid");
                }
            }

            inputDescripcion.addEventListener("keypress", function () {
                validarDescripcion();
            });

            inputDescripcion.addEventListener("keydown", function () {
                setTimeout(validarDescripcion, 0);
            });

            var selectDepto = document.getElementById("idDepto");
            selectDepto.addEventListener("change", function () {
                if (selectDepto.value !== "") {
                    selectDepto.classList.add("is-valid");
                    selectDepto.classList.remove("is-invalid");
                } else {
                    selectDepto.classList.add("is-invalid");
                    selectDepto.classList.remove("is-valid");
                }
            });

            var selectMunicipio = document.getElementById("IdMunicipio");
            selectMunicipio.addEventListener("change", function () {
                if (selectMunicipio.value !== "") {
                    selectMunicipio.classList.add("is-valid");
                    selectMunicipio.classList.remove("is-invalid");
                } else {
                    selectMunicipio.classList.add("is-invalid");
                    selectMunicipio.classList.remove("is-valid");
                }
            });

            var selectCategoria = document.getElementById("IdCategoria");
            selectCategoria.addEventListener("change", function () {
                if (selectCategoria.value !== "") {
                    selectCategoria.classList.add("is-valid");
                    selectCategoria.classList.remove("is-invalid");
                } else {
                    selectCategoria.classList.add("is-invalid");
                    selectCategoria.classList.remove("is-valid");
                }
            });

            const inputPrecio = document.getElementById('Precio');

            inputPrecio.addEventListener('input', function () {
                let valor = inputPrecio.value;
                const tieneSimboloNegativo = valor.includes('-');

                valor = valor.replace(/[^0-9.-]/g, '');

                const signoPositivo = valor.indexOf('+');
                const signoNegativo = valor.indexOf('-');
                if (signoPositivo !== -1 && signoPositivo !== valor.lastIndexOf('+')) {
                    valor = valor.slice(0, signoPositivo) + valor.slice(signoPositivo + 1);
                }
                if (signoNegativo !== -1 && signoNegativo !== valor.lastIndexOf('-')) {
                    valor = valor.slice(0, signoNegativo) + valor.slice(signoNegativo + 1);
                }

                if (valor !== inputPrecio.value) {
                    inputPrecio.value = valor;
                    inputPrecio.classList.add('is-invalid');
                    inputPrecio.classList.remove('is-valid');
                }else{
                    inputPrecio.classList.add('is-valid');
                    inputPrecio.classList.remove('is-invalid');
                }

                if (tieneSimboloNegativo) {
                    inputPrecio.classList.add('is-invalid');
                    inputPrecio.classList.remove('is-valid');
                } else {
                    inputPrecio.classList.add('is-valid');
                    inputPrecio.classList.remove('is-invalid');
                }

                if(valor === ""){
                    inputPrecio.classList.add('is-invalid');
                    inputPrecio.classList.remove('is-valid');
                }

            });

            var inputImagen = document.getElementById("Imagen");
            inputImagen.addEventListener('change', function () {

                if (inputImagen.files.length > 0) {
                    inputImagen.classList.add('is-valid');
                    inputImagen.classList.remove('is-invalid');
                } else {
                    inputImagen.classList.add('is-invalid');
                    inputImagen.classList.remove('is-valid');
                }
            });

            //----------------
            var selectUsuario2 = document.getElementById("IdUsuario2");
            selectUsuario2.addEventListener("change", function () {
                if (selectUsuario2.value !== "") {
                    selectUsuario2.classList.add("is-valid");
                    selectUsuario2.classList.remove("is-invalid");
                } else {
                    selectUsuario2.classList.add("is-invalid");
                    selectUsuario2.classList.remove("is-valid");
                }
            });

            var inputNombre2 = document.getElementById("NombreLugar2");
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

            var inputDescripcion2 = document.getElementById("Descripcion2");
            function validarDescripcion2() {

                var valor = inputDescripcion2.value.trim();
                if (valor.length >= 4) {
                    inputDescripcion2.classList.add("is-valid");
                    inputDescripcion2.classList.remove("is-invalid");
                } else {
                    inputDescripcion2.classList.add("is-invalid");
                    inputDescripcion2.classList.remove("is-valid");
                }
            }

            inputDescripcion2.addEventListener("keypress", function () {
                validarDescripcion2();
            });

            inputDescripcion2.addEventListener("keydown", function () {
                setTimeout(validarDescripcion2, 0);
            });

            var selectDepto2 = document.getElementById("idDepto2");
            selectDepto2.addEventListener("change", function () {
                if (selectDepto2.value !== "") {
                    selectDepto2.classList.add("is-valid");
                    selectDepto2.classList.remove("is-invalid");
                } else {
                    selectDepto2.classList.add("is-invalid");
                    selectDepto2.classList.remove("is-valid");
                }
            });

            var selectMunicipio2 = document.getElementById("IdMunicipio2");
            selectMunicipio2.addEventListener("change", function () {
                if (selectMunicipio2.value !== "") {
                    selectMunicipio2.classList.add("is-valid");
                    selectMunicipio2.classList.remove("is-invalid");
                } else {
                    selectMunicipio2.classList.add("is-invalid");
                    selectMunicipio2.classList.remove("is-valid");
                }
            });

            var selectCategoria2 = document.getElementById("IdCategoria2");
            selectCategoria2.addEventListener("change", function () {
                if (selectCategoria2.value !== "") {
                    selectCategoria2.classList.add("is-valid");
                    selectCategoria2.classList.remove("is-invalid");
                } else {
                    selectCategoria2.classList.add("is-invalid");
                    selectCategoria2.classList.remove("is-valid");
                }
            });

            const inputPrecio2 = document.getElementById('Precio2');

            inputPrecio2.addEventListener('input', function () {
                let valor2 = inputPrecio2.value;
                const tieneSimboloNegativo2 = valor2.includes('-');

                valor2 = valor2.replace(/[^0-9.-]/g, '');

                const signoPositivo2 = valor2.indexOf('+');
                const signoNegativo2 = valor2.indexOf('-');
                if (signoPositivo2 !== -1 && signoPositivo2 !== valor2.lastIndexOf('+')) {
                    valor2 = valor2.slice(0, signoPositivo2) + valor2.slice(signoPositivo2 + 1);
                }
                if (signoNegativo2 !== -1 && signoNegativo2 !== valor2.lastIndexOf('-')) {
                    valor2 = valor2.slice(0, signoNegativo2) + valor2.slice(signoNegativo2 + 1);
                }

                if (valor2 !== inputPrecio2.value) {
                    inputPrecio2.value = valor2;
                    inputPrecio2.classList.add('is-invalid');
                    inputPrecio2.classList.remove('is-valid');
                } else {
                    inputPrecio2.classList.add('is-valid');
                    inputPrecio2.classList.remove('is-invalid');
                }

                if (tieneSimboloNegativo2) {
                    inputPrecio2.classList.add('is-invalid');
                    inputPrecio2.classList.remove('is-valid');
                } else {
                    inputPrecio2.classList.add('is-valid');
                    inputPrecio2.classList.remove('is-invalid');
                }

                if (valor2 === "") {
                    inputPrecio2.classList.add('is-invalid');
                    inputPrecio2.classList.remove('is-valid');
                }

            });

            var inputImagen2 = document.getElementById("Imagen2");
            inputImagen2.addEventListener('change', function () {

                if (inputImagen2.files.length > 0) {
                    inputImagen2.classList.add('is-valid');
                    inputImagen2.classList.remove('is-invalid');
                } else {
                    inputImagen2.classList.add('is-invalid');
                    inputImagen2.classList.remove('is-valid');
                }
            });

        cargarTabla();
    });
</script>
</body>
</html>