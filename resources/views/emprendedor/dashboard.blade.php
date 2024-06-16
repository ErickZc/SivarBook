<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de credenciales</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/dashboardEmprendedor.css') }}" rel="stylesheet">
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
<body class="body-image body-html"  >
<header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-light border-bottom box-shadow mb-3">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="{{ asset('icon.svg') }}" height="50px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav">
                            
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                                <span class="nav-link text-dark">Bienvenido, {{ Auth::user()->nombre }}</span>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" method="post">
                                    <a href="/" type="submit" class="nav-link text-dark" style="background: none; border: none; cursor: pointer;">Cerrar sesión</a>
                                </form>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="row">
        <div class="left col-md-3 grid gap-0 row-gap-3">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Emprendedor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="left col-md-3 grid gap-0 row-gap-3">
            <div class="row p-2 g-col-12">
                <div class="sidebar rol-acceso">
                    <strong>EMPRENDEDOR</strong>
                </div>
            </div>
            <div class="row p-2 g-col-12 ">
                <div class="profile pb-4">
                    <div class="profile-photo-align">
                        <div class="profile-photo-primary" id="fotoPrimary">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#868e96"></rect>
                            </svg>
                        </div>
                    </div>
                    <div class="handle ps-3">
                        <br />
                        <p class="placeholder-glow text-muted mb-0 text-start" id="nombrePlaceholder">
                            Nombre: <span class="placeholder col-6"></span>
                        </p>
                        <p class="placeholder-glow text-muted mb-0 text-start" id="edadPlaceholder">
                            Edad: <span class="placeholder col-4"></span>
                        </p>
                        <p class="placeholder-glow text-muted mb-0 text-start" id="emailPlaceholder">
                            E-mail: <span class="placeholder col-8"></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row p-2 g-col-12">
                <div class="sidebar">
                    <a class="menu-item" href="/emprendedor/dashboard">
                        <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 14h-4v7h4v-7Z"></path>
                            <path d="m20.42 10.184-7.71-7.88a.999.999 0 0 0-1.42 0l-7.71 7.89a2 2 0 0 0-.58 1.43v8.38a2 2 0 0 0 1.89 2H8v-9a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v9h3.11a2 2 0 0 0 1.89-2v-8.38a2.07 2.07 0 0 0-.58-1.44Z"></path>
                        </svg>&nbsp; &nbsp;<h5> Inicio</h5>
                    </a>

                    <form id="profileForm" action="{{ route('emprendedor.profile') }}" method="GET">
                        <input type="hidden" name="id_usuario" value="36">
                        <a class="menu-item" href="javascript:void(0);" onclick="setProfileUserId(usuario);">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" fill="#000000"></path></g></svg>
                            &nbsp; &nbsp;
                            <h5> Mi perfil</h5>
                        </a>
                        
                    </form>
                    <a class="menu-item" href="/emprendedor/getAll">
                        <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 4.34a1.24 1.24 0 0 0-1.08-.23L13 5.89v14.27l7.56-1.94A1.25 1.25 0 0 0 21.5 17V5.32a1.25 1.25 0 0 0-.5-.98Z"></path>
                            <path d="M11 5.89 4.06 4.11A1.27 1.27 0 0 0 3 4.34a1.25 1.25 0 0 0-.48 1V17a1.25 1.25 0 0 0 .94 1.21L11 20.16V5.89Z"></path>
                        </svg>&nbsp; &nbsp;<h5> Ver otras publicaciones</h5>
                    </a>
                    <a class="menu-item" href="/">
                        <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 11.001H7.14l3.63-4.36a1.001 1.001 0 0 0-1.54-1.28l-5 6a1.184 1.184 0 0 0-.09.15c0 .05 0 .08-.07.13a1 1 0 0 0-.07.36 1 1 0 0 0 .07.36c0 .05 0 .08.07.13.026.052.056.103.09.15l5 6a1 1 0 0 0 1.41.13 1 1 0 0 0 .13-1.41l-3.63-4.36H19a1 1 0 0 0 0-2Z"></path>
                        </svg>&nbsp; &nbsp;<h5> Cerrar sesión</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="middle col-md-6 grid gap-0 row-gap-3">

            <div class="row p-2 g-col-12">
                <div class="create-post">
                    <div class="row">
                        <div class="col-auto">
                            <b style="font-size:24px;"> > > Mis publicaciones</b> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-2 g-col-12">
                <div class="create-post">
                    <div class="row">
                        <div class="col-auto">
                            <b style="font-size:17px;">¡Comparte tu emprendimiento con todo El Salvador!</b>
                            <p> Crea una nueva publicación ahora mismo y permite que otros disfruten de tu contenido.</p>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-auto bp">
                            <a class="btnPost" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"> <span>Crear publicación</span>  </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contenido">
                <div class="table-responsive create-post mb-3 mt-2">  
                    <div class="" aria-hidden="true">
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                            <span class="placeholder col-6 bg-secondary"></span>
                            </h5>
                            <p class="card-text placeholder-glow">
                            <span class="placeholder col-7 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-6 bg-secondary"></span>
                            <span class="placeholder col-8 bg-secondary"></span>
                            </p>
                            <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-5"></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive create-post">  
                    <div class="" aria-hidden="true">
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                            <span class="placeholder col-6 bg-secondary"></span>
                            </h5>
                            <p class="card-text placeholder-glow">
                            <span class="placeholder col-7 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-6 bg-secondary"></span>
                            <span class="placeholder col-8 bg-secondary"></span>
                            </p>
                            <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-5"></a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive create-post mt-3 mb-5">  
                    <div class="" aria-hidden="true">
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                            <span class="placeholder col-6 bg-secondary"></span>
                            </h5>
                            <p class="card-text placeholder-glow">
                            <span class="placeholder col-7 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <span class="placeholder col-6 bg-secondary"></span>
                            <span class="placeholder col-8 bg-secondary"></span>
                            </p>
                            <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-5"></a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="right col-md-3 grid gap-0 row-gap-3">
            
            <div class="row p-2 g-col-12">
                <div class="data">
                    <div class="row">
                        <div class="col-auto">
                            <b style="font-size:17px;">Noticias relevantes</b>
                            <p>En esta sección encontrarás las noticias más relevantes del mundo del turismo en el país.</p>
                        </div>
                    </div>
                    <div class="news" id="news">

                    </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregando Lugar turistico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Form1" enctype="multipart/form-data" method="post">
                
                <input type="text" name="IdUsuario" id="IdUsuario" class="form-control" placeholder="Escribe el nombre" hidden />

                <div class="modal-body">
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

                <input type="text" name="IdUsuario2" id="IdUsuario2" class="form-control" placeholder="Escribe el nombre" hidden />


                <div class="modal-body">
                    <div class="form-group mb-1">
                        <input type="hidden" id="idLugar" name="idLugar" class="form-control" required />
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
    window.onscroll = function() {scrollFunction()};



    // Variable de prueba mientras se hace el login, es el id de un emprendedor
    // var usuario = 4;
    var usuario = {{ Auth::user()->id_usuario }};

    function setProfileUserId(userId) {
        $.ajax({
            url: '{{ route("emprendedor.setProfileUserId") }}',
            type: 'POST',
            data: { userId: userId },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                // Redirecciona a la página de perfil
                window.location.href = '{{ route("emprendedor.profile") }}';
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    function scrollFunction() {
    var footer = document.getElementById("footer");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            footer.style.bottom = "0";
        } else {
            footer.style.bottom = "-200px";
        }
    }

        function cargarLugares() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('emprendedor.getTablaLugaresByUserId') }}',
                type: 'post',
                dataType: 'json',
                cache: false,
                data: {id_usuario : usuario}
            }).done(function (resp) {
                
                if(resp.length > 0){
                    var div = $("#contenido");
                    var post = "";
                    
                    $.each(resp, function (index, lugares) {
                        var fechaComentario = new Date(lugares.fecha);
                        var diferenciaComentario = new Date() - fechaComentario;

                        var formatoFechaComentario;

                        if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                            formatoFechaComentario = fechaComentario.toLocaleDateString("es-ES", { day: "2-digit", month: "2-digit", year: "numeric" });
                        } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 2) {
                            formatoFechaComentario = `${Math.floor(diferenciaComentario / (1000 * 60 * 60 * 24))} días atrás`;
                        } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 1) {
                            formatoFechaComentario = "Ayer";
                        } else {
                            formatoFechaComentario = "Hoy";
                        }

                        var img = 'data:image;base64,' + lugares.imagen;
                        var imgUser = 'data:image;base64,' + lugares.imagenUser;
                        var texto2 = lugares.nombre;
                        var textomodificado2 = texto2.replace(/ /g, "-");

                        var texto3 = lugares.descripcion;
                        var textomodificado3 = btoa(texto3.replace(/ /g, "-"));

                        post += `<div class="row p-2 g-col-12">
                                <div class="feed">
                                            <div class="d-flex justify-content-between">
                                                <div class="row g-2 feed-header">
                                                    <div class="col-auto" >
                                                        <div class="profile-photo">
                                                                <img src='${imgUser}' alt='Foto de perfil' width='37.8' height='37.8' class='imagen-turista'>
                                                                </div>

                                                                </div>
                                                                <div class="col-auto">
                                                                                <b>${lugares.user}</b>
                                                                                <p class="text-muted"> ${formatoFechaComentario}</p>
                                                                        </div>
                                                                        <div class="col-auto" >
                                                                            <div class="btn-group" >
                                                                                <button class="btn btn-sm dropdown-toggle" type = "button" data-bs-toggle="dropdown" aria-expanded="false" >
                                                                                    <svg width="20" height = "20" fill = "#000000" viewBox = "0 0 24 24" xmlns = "http://www.w3.org/2000/svg" >
                                                                                        <path fill - rule="evenodd" d = "M15.964 3.793a3 3 0 0 1 4.243 4.242l-7.122 7.123a3 3 0 0 1-1.533.82l-2.942.588a1 1 0 0 1-1.176-1.176l.588-2.942a3 3 0 0 1 .82-1.533l7.122-7.122Zm2.829 1.414a1 1 0 0 0-1.414 0L17 5.586 18.414 7l.379-.379a1 1 0 0 0 0-1.414ZM17 8.414 15.586 7l-5.33 5.33a1 1 0 0 0-.273.51l-.294 1.47 1.47-.293a1 1 0 0 0 .512-.274L17 8.414ZM6 5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-6a1 1 0 1 1 2 0v6a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h6a1 1 0 1 1 0 2H6Z" clip - rule="evenodd" > </path>
                                                                                            </svg>
                                                                                            </button>
                                                                                            <ul class="dropdown-menu" >
                                                                                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick=cargarUpt('${lugares.idLugar}&&${textomodificado2}&&${textomodificado3}&&${lugares.idMunicipio}&&${lugares.idDepto}&&${lugares.idCategoria}&&${lugares.precio2}')> Editar </a></li>
                                                                                                    <li><a class="dropdown-item" href = "javascript:cargarDel(${lugares.idLugar})"> Eliminar </a></li>
                                                                                                        </ul>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                        </div>
                                                                                                        <div class="row feed-description" >
                                                                                                            <div class="col-auto" >
                                                                                                                            <h4>${lugares.nombre}</h4>
                                                                                                                </div>
                                                                                                                </div>
                                                                                                                <div class="row g1 feed-location" >
                                                                                                                    <div class="col-auto" >
                                                                                                                        <svg width="20" height = "20" fill = "#696969" viewBox = "0 0 24 24" xmlns = "http://www.w3.org/2000/svg" >
                                                                                                                            <path d="M12 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" > </path>
                                                                                                                                <path d = "M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z" > </path>
                                                                                                                                    </svg>
                            ${lugares.municipio}, ${lugares.departamento}
                                </div>
                                </div>


                                <div class='row mb-3 g1 details-location'>
                                        <div class='col-auto'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cash-coin' viewBox='0 0 16 16'>
                                        <path fill-rule='evenodd' d='M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0'/>
                                        <path d='M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z'/>
                                        <path d='M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z'/>
                                        <path d='M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567'/>
                                        </svg>
                                        ${lugares.precio}
                                        </div>
                                    </div>


                                <div class="row feed-description" >
                                    <div class="col-auto" >
                                        <p class="lh-lg">
                            ${lugares.descripcion}
                                        </p>
                                        </div>
                                        </div>
                                        <div class="feed-photo" >
                                            <img src='${img}' alt = "Foto de perfil" class="profile-picture" >
                                                </div>
                                                <div class="feed-button" >
                                                                        <a class="btn" style="background: #2098d8; color: #fff; border-radius: 100px;" href="/emprendedor/postDetails/${lugares.idLugar}" > Ver publicación </a>
                                                        </div>
                                                        </div>
                                                                    </div>`
                    });

                    div.empty();
                    div.append(post);
                }else{
                    var div = $("#contenido");
                    var post = "<div class='row p-2 g-col-12'> <div class='create-post'> <div class='row'> <div class='col-auto'> <div class='ps-5 d-flex flex-row align-items-center'>  <img src='{{ asset('advertencia.png') }}' class='profile-picture img-fluid' style='width: 300px;'>  <p class='ms-3 fw-bold fs-5'>Vaya, no hemos encontrado ningun resultado :(  </p>  </div> </div> </div> </div> </div>";

                    div.empty();
                    div.append(post);

                }


            }).fail();

        }

    function cargarUsuarioById() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('emprendedor.getTablaUsuariosByUserId') }}',
                type: 'post',
                dataType: 'json',
                cache: false,
                data: {id_usuario : usuario}
            }).done(function (resp) {
                $.each(resp, function (index, usuario) {

                    var nombrePlaceholder = $("#nombrePlaceholder");
                    var edadPlaceholder = $("#edadPlaceholder");
                    var emailPlaceholder = $("#emailPlaceholder");
                    var fotoPrimary = $("#fotoPrimary");
                    
                    nombrePlaceholder.removeClass("placeholder-glow");
                    edadPlaceholder.removeClass("placeholder-glow");
                    emailPlaceholder.removeClass("placeholder-glow");

                    var nombre =  "Nombre: " + usuario.nombre + " " + usuario.apellido;
                    var edad = "Edad: " + usuario.edad;
                    var email = "E-mail: " + usuario.correo;
                    var url = "data:image;base64," + usuario.imagen;
                    var foto = "<img src='" + url + "' alt='Foto de perfil' class='profile-photo-primary'>";

                    nombrePlaceholder.empty();
                    edadPlaceholder.empty();
                    emailPlaceholder.empty();
                    fotoPrimary.empty();

                    nombrePlaceholder.append(nombre);
                    edadPlaceholder.append(edad);
                    emailPlaceholder.append(email);
                    fotoPrimary.append(foto);
                });
            }).fail();

    }

    function callAPI() {
            const url = 'https://newsdata.io/api/1/news?apikey=pub_24023d24caea9400184d5f62d4dbd77f52c41&q=el%20salvador&country=sv&language=es&category=entertainment,tourism';

            fetch(url)
                .then(data => {
                    return data.json();
                })
                .then(dataJSON => {
                    var content = $("#news");
                    var res="";
                    if (dataJSON.cod === '404') {
                        showError('datos no encontrados');
                    } else {
                            dataJSON.results.forEach(function (result) {
                                res+=`
                                <div class="mb-2">
                                    <div class="col">
                                        <div class="card">
                                        <img src="${result.image_url}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">${result.title}</h5>
                                            
                                            <a href="${result.link}" target="_blank" class="btn btn-primary">Ver noticia</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            });
                    }
                    content.empty();
                    content.append(res);
                    //console.log(dataJSON);
                })
                .catch(error => {
                    console.log(error);
                })
    }

        function cargarDel(IdLugar) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estas seguro(a)?',
                text: "Una vez eliminada ya no podrás recuperar la publicación",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('emprendedor.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: { id: IdLugar }
                    }).done(function (resp) {
                        if (resp) {
                            swalWithBootstrapButtons.fire(
                                '¡Eliminado!',
                                'Tu registro ha sido elimando.',
                                'success'
                            )
                            cargarLugares();
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Cancelado',
                                    'Se ha omitido la acción',
                                'error'
                            )
                        }
                    }).fail();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Se ha omitido la acción',
                        'error'
                    )
                }
            })
        }


    function cargarUpt(lugar) {
        
        var obj = lugar.split('&&');
        var textoModificado1 = obj[1];
        var textoOriginal1 = textoModificado1.replace(/-/g, " ");

        var textoModificado2 = obj[2];
        var textoOriginal2 = atob(textoModificado2);

         var textoOriginal3 = textoOriginal2.replace(/-/g, " ");


        document.getElementById("idLugar").value = obj[0];

        document.getElementById("NombreLugar2").value = textoOriginal1;
        document.getElementById("Descripcion2").value = textoOriginal3;
        document.getElementById("IdMunicipio2").value = obj[3];
        document.getElementById("idDepto2").value = obj[4];
        document.getElementById("IdCategoria2").value = obj[5];
        document.getElementById("Precio2").value = obj[6];

        tinymce.get("Descripcion2").setContent(textoOriginal3);
    }

    function limpiarCajas() {
        $('#NombreLugar').val('');
        $('#Descripcion').val('');
        $('#idDepto').val('');
        $('#IdMunicipio').val('');
        $('#Precio').val('');
        $('#Imagen').val('');
        $('#IdCategoria').val('');
    }

    function limpiarClases() {
        $('#NombreLugar').removeClass('is-valid');
        $('#Descripcion').removeClass('is-valid');
        $('#idDepto').removeClass('is-valid');
        $('#IdMunicipio').removeClass('is-valid');
        $('#Precio').removeClass('is-valid');
        $('#Imagen').removeClass('is-valid');
        $('#IdCategoria').removeClass('is-valid');

        $('#NombreLugar').removeClass('is-invalid');
        $('#Descripcion').removeClass('is-invalid');
        $('#idDepto').removeClass('is-invalid');
        $('#IdMunicipio').removeClass('is-invalid');
        $('#Precio').removeClass('is-invalid');
        $('#Imagen').removeClass('is-invalid');
        $('#IdCategoria').removeClass('is-invalid');

        $('#NombreLugar2').removeClass('is-valid');
        $('#Descripcion2').removeClass('is-valid');
        $('#idDepto2').removeClass('is-valid');
        $('#IdMunicipio2').removeClass('is-valid');
        $('#Precio2').removeClass('is-valid');
        $('#Imagen2').removeClass('is-valid');
        $('#IdCategoria2').removeClass('is-valid');

        $('#NombreLugar2').removeClass('is-invalid');
        $('#Descripcion2').removeClass('is-invalid');
        $('#idDepto2').removeClass('is-invalid');
        $('#IdMunicipio2').removeClass('is-invalid');
        $('#Precio2').removeClass('is-invalid');
        $('#Imagen2').removeClass('is-invalid');
        $('#IdCategoria2').removeClass('is-invalid');
    }


        $(document).ready(function () {
            cargarUsuarioById();
            cargarLugares();
            callAPI();




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
                    url: '{{ route('emprendedor.getTablaMunicipioByIdDepto') }}',
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
                    url: '{{ route('emprendedor.getTablaMunicipioByIdDepto') }}',
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
            var nombre = $("#NombreLugar").val();
            var desc = $("#Descripcion").val();
            var muni = $("#IdMunicipio").val();
            var prec = $("#Precio").val();
            var cat = $("#IdCategoria").val();
            $("#IdUsuario").val(usuario);

                        

            if(nombre != "" && desc != ""
            && muni != "" && prec != "" && cat != ""){

                if(inputsInvalidos === 0){
                    $.ajax({
                        url: '{{ route('emprendedor.save') }}',
                        type: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false
                    }).done(function (resp) {
                        
                        if (resp) {
                            
                            Swal.fire({
                                title: 'El registro ha sido agregado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Continuar'
                            })
                            $("#btnCerrar").click();
                            cargarLugares();
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
            var idlugar = $("#idLugar").val();
            var nombr = $("#NombreLugar2").val();
            var desc = $("#Descripcion2").val();
            var muni = $("#IdMunicipio2").val();
            var prec = $("#Precio2").val();
            var cat = $("#IdCategoria2").val();
            var formulario = $("#Form2").serialize();
            var im = $("#Imagen2").val();

            $("#IdUsuario2").val(usuario);

            if (!radioInput.checked) {
                if ( nombr != "" && desc != ""
                    && muni != "" && prec != "" && cat != "") {

                    if (inputsInvalidos === 0) {
                        $.ajax({
                            url: '{{ route('emprendedor.update') }}',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            data: { id_lugar: idlugar, id_usuario: usuario, id_categoria: cat, nombre: nombr, descripcion: desc, id_municipio: muni, precio: prec }
                        }).done(function (resp) {
                            if (resp) {
                                Swal.fire({
                                    title: 'El registro ha sido modificado correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Continuar'
                                })
                                $("#btnCerrar2").click();
                                cargarLugares();
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
                if (nombr != "" && desc != ""
                    && muni != "" && prec != "" && cat != "" && im != "") {

                    if (inputsInvalidos === 0) {

                        $.ajax({
                            url: '{{ route('emprendedor.updateImage') }}',
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
                                $("#btnCerrar2").click();
                                cargarLugares();
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


            
        });

</script>

</body>
</html>