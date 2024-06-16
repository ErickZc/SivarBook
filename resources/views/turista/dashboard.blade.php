<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SivarBook</title>
    <!-- <link rel="shortcut icon" href="~/Images/SivarBook.png" /> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"
        asp-append-version="true" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"
        asp-append-version="true" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome icons -->
    <link href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="{{ asset('css/turista.css') }}" rel="stylesheet">

    <!-- Agrega el CSS de Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script>
        // Verificar si el usuario intenta navegar hacia atrás
        window.onload = function() {
            if (window.history && window.history.pushState) {
                window.history.pushState('forward', null, ''); // Agregar una entrada en el historial de navegación
                window.onpopstate = function() {
                    // Cuando el usuario intenta navegar hacia atrás
                    window.location.reload(true); // Forzar la recarga de la página sin caché
                };
            }
        }
    </script>
</head>

<body class="mb-0 pb-0">
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a class="navbar-brand"><img src="{{ asset('icon.svg') }}" height="50px" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                                <a href="/" type="submit" class="nav-link text-dark"
                                    style="background: none; border: none; cursor: pointer;">Cerrar sesión</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container" id="primary-content">
        <div class="row">
            <div class="left col-md-3 grid gap-0 row-gap-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Turista</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="left col-md-3 grid gap-0 row-gap-3">
                <div class="row p-2 g-col-12">
                    <div class="sidebar rol-acceso">
                        <strong>TURISTA</strong>
                    </div>
                </div>
                <div class="row p-2 g-col-12">
                    <div class="profile">
                        <div class="profile-photo-align">
                            <div class="profile-photo-primary">
                                <img src="data:image;base64,{{ $turista->imagen }}" width='98'
                                    height='98' alt="Foto de perfil" class="imagen-turista">
                            </div>
                        </div>
                        <div class="handle">
                            <br />
                            <b>{{ $turista->nombre }} {{ $turista->apellido }}</b>
                            <p class="text-muted">
                                Edad: {{ $turista->edad }}
                                <br />
                                E-mail: {{ $turista->correo }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row p-2 g-col-12">
                    <div class="sidebar">
                        <a class="menu-item" href="{{ route('turista.index') }}">
                            <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 14h-4v7h4v-7Z"></path>
                                <path
                                    d="m20.42 10.184-7.71-7.88a.999.999 0 0 0-1.42 0l-7.71 7.89a2 2 0 0 0-.58 1.43v8.38a2 2 0 0 0 1.89 2H8v-9a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v9h3.11a2 2 0 0 0 1.89-2v-8.38a2.07 2.07 0 0 0-.58-1.44Z">
                                </path>
                            </svg>&nbsp; &nbsp;<h5> Inicio</h5>
                        </a>
                        <form id="profileForm" action="{{ route('turista.profile') }}" method="GET">
                            <input type="hidden" name="id_usuario" value="36">
                            <a class="menu-item" href="javascript:void(0);"
                                onclick="setProfileUserId(usuario);">
                                <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.592 3.027C14.68 2.042 13.406 1.5 12 1.5c-1.414 0-2.692.54-3.6 1.518-.918.99-1.365 2.334-1.26 3.786C7.348 9.67 9.528 12 12 12c2.472 0 4.648-2.33 4.86-5.195.106-1.439-.344-2.78-1.268-3.778Z">
                                    </path>
                                    <path
                                        d="M20.25 22.5H3.75a1.454 1.454 0 0 1-1.134-.522 1.655 1.655 0 0 1-.337-1.364c.396-2.195 1.63-4.038 3.571-5.333C7.574 14.132 9.758 13.5 12 13.5c2.242 0 4.426.633 6.15 1.781 1.94 1.294 3.176 3.138 3.571 5.332.091.503-.032 1-.336 1.365a1.453 1.453 0 0 1-1.135.522Z">
                                    </path>
                                </svg>
                                &nbsp; &nbsp;
                                <h5> Mi perfil</h5>
                            </a>

                        </form>
                        <a class="menu-item" href="/">
                            <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 11.001H7.14l3.63-4.36a1.001 1.001 0 0 0-1.54-1.28l-5 6a1.184 1.184 0 0 0-.09.15c0 .05 0 .08-.07.13a1 1 0 0 0-.07.36 1 1 0 0 0 .07.36c0 .05 0 .08.07.13.026.052.056.103.09.15l5 6a1 1 0 0 0 1.41.13 1 1 0 0 0 .13-1.41l-3.63-4.36H19a1 1 0 0 0 0-2Z">
                                </path>
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
                                <b style="font-size:20px;"> > > Todas las publicaciones</b> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-2 g-col-12">
                    <div class="create-post">
                        <div class="row">
                            <div class="col-auto">
                                <b style="font-size:17px;">Explora todos tus destinos</b>
                                <p>Encuentra los mejores destinos turísticos y lugares de interés en El Salvador
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="find" data-bs-toggle="modal"
                                    data-bs-target="#busquedaUbicacion">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <svg width="22" height="22" fill="#000000"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z">
                                                    </path>
                                                    <path
                                                        d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z">
                                                    </path>
                                                </svg>
                                                Busca por ubicación
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="find" data-bs-toggle="modal"
                                    data-bs-target="#busquedaCategoria">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <svg width="22" height="22" fill="#000000"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 16H9a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2Z"></path>
                                                    <path d="M9 14h3a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2Z"></path>
                                                    <path
                                                        d="m19.74 8.33-5.44-6a1 1 0 0 0-.74-.33h-7A2.53 2.53 0 0 0 4 4.5v15A2.53 2.53 0 0 0 6.56 22h10.88A2.531 2.531 0 0 0 20 19.5V9a1 1 0 0 0-.26-.67ZM14 5l2.74 3h-2a.79.79 0 0 1-.74-.85V5Zm3.44 15H6.56a.53.53 0 0 1-.56-.5v-15a.53.53 0 0 1 .56-.5H12v3.15A2.79 2.79 0 0 0 14.71 10H18v9.5a.53.53 0 0 1-.56.5Z">
                                                    </path>
                                                </svg>
                                                Busca por categoría
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="find" data-bs-toggle="modal"
                                    data-bs-target="#busquedaDescripcion">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <svg width="22" height="22" fill="#000000"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"></path>
                                                    <path d="M17 13a3 3 0 1 0 0-5.999A3 3 0 0 0 17 13Z"></path>
                                                    <path
                                                        d="M21 19.998a1 1 0 0 0 1-1 5 5 0 0 0-8.06-3.95A7 7 0 0 0 2 19.998a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1">
                                                    </path>
                                                </svg>
                                                Buscar por descripción
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="find" data-bs-toggle="modal"
                                    data-bs-target="#busquedaNombre">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <svg width="22" height="22" fill="#000000"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19 3H7a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1ZM7 19a1 1 0 0 1 0-2h11v2H7Z">
                                                    </path>
                                                </svg>
                                                Busca por nombre
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
                @if (!empty($lugares) && count($lugares) > 0)
                    @foreach ($lugares as $item)
                        <?php
                        $fechaPublicacion = new DateTime($item->fecha);
                        $diferencia = (new DateTime())->diff($fechaPublicacion);
                        
                        if ($diferencia->days >= 7) {
                            $formatoFecha = $fechaPublicacion->format('d/m/Y');
                        } elseif ($diferencia->days >= 2) {
                            $formatoFecha = $diferencia->days . ' días atrás';
                        } elseif ($diferencia->days >= 1) {
                            $formatoFecha = 'Ayer';
                        } else {
                            $formatoFecha = 'Hoy';
                        }
                        ?>
                        <div class="row p-2 g-col-12">
                            <div class="feed">
                                <input type="hidden" name="IdLugar" value="{{ $item->idLugar }}">
                                <div class="d-flex justify-content-between">
                                    <div class="row g-2 feed-header">
                                        <div class="col-auto">
                                            <div class="profile-photo">
                                                <img src="data:image;base64,{{ $item->imagenUser }}"
                                                    width='37.8' height='37.8' alt="Foto de perfil"
                                                    class="imagen-turista">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <b>{{ $item->user }}</b>
                                            <p class="text-muted">{{ $formatoFecha }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <!-- Código adicional si es necesario -->
                                    </div>
                                </div>
                                <div class="row feed-description">
                                    <div class="col-auto">
                                        <h4>{{ $item->nombre }}</h4>
                                    </div>
                                </div>
                                <div class="row g1 feed-location">
                                    <div class="col-auto">
                                        <svg width="20" height="20" fill="#696969"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path>
                                            <path
                                                d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z">
                                            </path>
                                        </svg>
                                        {{ $item->municipio }}, {{ $item->departamento }}
                                    </div>
                                </div>
                                <div class="row feed-description">
                                    <div class="col-auto">
                                        <p>{!! $item->descripcion !!}</p>
                                    </div>
                                </div>
                                <div class="feed-photo">
                                    <img src="data:image;base64,{{ $item->imagen }}" alt="Foto de perfil"
                                        class="profile-picture">
                                </div>
                                <div class="feed-button">
                                    <a href="{{ route('turista.postDetails', ['id' => $item->idLugar]) }}"
                                        class="btn buttonAdd buttonGeneric btn-sm">Ver publicación</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="right col-md-3 grid gap-0 row-gap-3">

                <div class="row p-2 g-col-12">
                    <div class="data">
                        <div class="row">
                            <div class="col-auto">
                                <b style="font-size:17px;">Noticias relevantes</b>
                                <p>En esta sección encontrarás las noticias más relevantes del mundo del turismo
                                    en el país.</p>
                            </div>
                        </div>
                        <div class="news" id="news">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main role="main" class="">
            <div class="container">
                
            </div>
        </main>
    </div>

    <!--Modal para buscar por ubicacion-->
    <div class="modal fade" id="busquedaUbicacion" tabindex="-1" aria-labelledby="busquedaUbicacionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busquedaUbicacionLabel">¿Dónde ir?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form id="formUbicacion" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <p>Buscar por:</p>
                                    <div class="input-group">
                                        <select class="form-select" aria-label=".form-select-sm example"
                                            id="TipoUbicacion" name="TipoUbicacion">
                                            <option value="Dpto" selected>Departamento</option>
                                            <option value="Municipio">Municipio</option>
                                        </select>
                                        <input type="text" class="form-control" placeholder="Ingresa un valor"
                                            id="Ubicacion" name="Ubicacion" />
                                        <button type="submit" class="btn btn-icon" id="enviar">
                                            <svg width="22" height="22" fill="#000000" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m20.71 19.29-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1.002 1.002 0 0 0 1.639-.325 1 1 0 0 0-.219-1.095ZM5 11a6 6 0 1 1 12 0 6 6 0 0 1-12 0Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-12 ms-auto" id="find-ubicacion">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="limpiarCajas()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para buscar por categoria-->
    <div class="modal fade" id="busquedaCategoria" tabindex="-1" aria-labelledby="busquedaCategoriaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busquedaCategoriaLabel">¿Qué mood tienes hoy?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form id="formCategoria">
                                    @csrf
                                    <p>Buscar por:</p>
                                    <div class="input-group">
                                        <select class="form-select" aria-label=".form-select-sm example"
                                            id="Categorias" name="Categorias">

                                        </select>
                                        <button type="submit" class="btn btn-icon" id="enviar">
                                            <svg width="22" height="22" fill="#000000" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m20.71 19.29-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1.002 1.002 0 0 0 1.639-.325 1 1 0 0 0-.219-1.095ZM5 11a6 6 0 1 1 12 0 6 6 0 0 1-12 0Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-12 ms-auto" id="find-categorias">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="limpiarCajas()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para buscar por descripcion-->
    <div class="modal fade" id="busquedaDescripcion" tabindex="-1" aria-labelledby="busquedaDescripcionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busquedaDescripcionLabel">¿No sabes que lugar es? ¡Busca alguna
                        descripción!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form id="formDescripcion">
                                    <p>Buscar por:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Ingresa un valor"
                                            id="Descripcion" name="Descripcion" />
                                        <button type="submit" class="btn btn-icon" id="enviar">
                                            <svg width="22" height="22" fill="#000000" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m20.71 19.29-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1.002 1.002 0 0 0 1.639-.325 1 1 0 0 0-.219-1.095ZM5 11a6 6 0 1 1 12 0 6 6 0 0 1-12 0Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-12 ms-auto" id="find-descripcion">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="limpiarCajas()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para buscar por nombre del lugar-->
    <div class="modal fade" id="busquedaNombre" tabindex="-1" aria-labelledby="busquedaNombreLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="busquedaNombreLabel">¡Busca el nombre del lugar que deseas encontrar!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form id="formNombre">
                                    <p>Buscar por:</p>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Ingresa el nombre del lugar" id="Lugar"
                                            name="Lugar" />
                                        <button type="submit" class="btn btn-icon" id="enviar">
                                            <svg width="22" height="22" fill="#000000" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m20.71 19.29-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1.002 1.002 0 0 0 1.639-.325 1 1 0 0 0-.219-1.095ZM5 11a6 6 0 1 1 12 0 6 6 0 0 1-12 0Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-12 ms-auto" id="find-nombre">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="limpiarCajas()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer-dark2 text-muted" id="footer">
        <br>
        <div class="container footer-2">
            <div class="row footer-3">
                <div class="col-md-6">
                    <p class="text-start texto-footer">&copy; 2024 - Proyecto Final, Aplicacion de Framework
                        Empresariales</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="text-end">&copy; SivarBook Inc</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Agrega el JS de jQuery y Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>  
    window.onscroll = function() {
            scrollFunction()
        };


        function scrollFunction() {
            var footer = document.getElementById("footer");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                footer.style.bottom = "0px";
            } else {
                footer.style.bottom = "-200px";
            }
        }

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
            cargarDatosCategoria();
            callAPI();
        });
        // Mostrar el modal automáticamente si debe responder preguntas
        @if ($debeResponderPreguntas)
            var modal = new bootstrap.Modal(document.getElementById('preguntasModal'), {
                keyboard: false, // Deshabilitar el cierre con la tecla ESC
                backdrop: 'static' // Evitar el cierre haciendo clic fuera del modal
            });
            modal.show();
        @endif

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
                url: '{{ route('guardarRespuestasTurista') }}',
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

        // Variable de prueba mientras se hace el login, es el id de un turista
        // var usuario = 1;
        var usuario = {{ Auth::user()->id_usuario }};

        function setProfileUserId(userId) {
            $.ajax({
                url: '{{ route('turista.setProfileUserId') }}',
                type: 'POST',
                data: {
                    userId: userId
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Redirecciona a la página de perfil
                    window.location.href = '{{ route('turista.profile') }}';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function callAPI() {
            const url =
                'https://newsdata.io/api/1/news?apikey=pub_24023d24caea9400184d5f62d4dbd77f52c41&q=el%20salvador&country=sv&language=es&category=entertainment,tourism';

            fetch(url)
                .then(data => {
                    return data.json();
                })
                .then(dataJSON => {
                    var content = $("#news");
                    var res = "";
                    if (dataJSON.cod === '404') {
                        showError('datos no encontrados');
                    } else {
                        dataJSON.results.forEach(function(result) {
                            res += `
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

        function limpiarCajas() {
            $('#Ubicacion').val("");
            $('#Categorias').val("");
            $('#Descripcion').val("");
            $('#Lugar').val("");
            $('#find-ubicacion').empty();
            $('#find-categorias').empty();
            $('#find-descripcion').empty();
            $('#find-nombre').empty();
        }

        $('#formUbicacion').submit(function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var valor = $("#Ubicacion").val();
            var tipo = $("#TipoUbicacion").val();

            if (valor != "") {
                var content = $('#find-ubicacion');
                var resultado = `<div class="d-flex justify-content-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>`;
                content.empty();
                content.append(resultado);
                $.ajax({
                    url: '{{ route('turista.findByMunicipio') }}',
                    data: {
                        sValor: valor,
                        sTipo: tipo
                    },
                    type: "post",
                    dataType: 'json',
                    cache: false,
                }).done(function(resp) {
                   
                    var content = $('#find-ubicacion');
                    content.empty();
                    var resultado = "";
                    if (resp.length == 0) {
                        
                        resultado +=
                            "<br /><svg width='27' height='27' fill='none' stroke='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z'></path><path fill='#000000' stroke='none' d='M8.625 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path fill='#000000' stroke='none' d='M15.375 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path d='M15.497 15.918a4.5 4.5 0 0 0-6.994 0'></path></svg> ¡Ops!, parece que no hay resultados <br />";
                    } else {
                        resultado += "<p> Total de resultados: " + resp.length + "</p>"
                        $.each(resp, function(index, lugar) {
                            var fechaComentario = new Date(lugar.fecha);
                            var diferenciaComentario = new Date() - fechaComentario;

                            var formatoFechaComentario;

                            if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                                formatoFechaComentario = fechaComentario.toLocaleDateString(
                                    "es-ES", {
                                        day: "2-digit",
                                        month: "2-digit",
                                        year: "numeric"
                                    });
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 2) {
                                formatoFechaComentario =
                                    `${Math.floor(diferenciaComentario / (1000 * 60 * 60 * 24))} días atrás`;
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 1) {
                                formatoFechaComentario = "Ayer";
                            } else {
                                formatoFechaComentario = "Hoy";
                            }
                            var lugarId = lugar.idLugar;
                            var url =
                                "{{ route('turista.postDetails', ['id' => ':lugarId']) }}";
                            url = url.replace(':lugarId', lugarId);

                            var img = 'data:image;base64,' + lugar.imagen;
                            resultado +=
                                "<div class='card mb-3'><div class='row g-0'><div class='col-md-4 feed-image'><img src='" +
                                img +
                                "' class='img-fluid rounded-start' alt='Foto del lugar'></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>" +
                                lugar.nombre + "</h5><p class='card-text'>" + lugar.descripcion +
                                "</p><p class='card-text'><small class='text-muted'>" +
                                formatoFechaComentario +
                                "</small></p><p class='card-text'><a class='btn btn-primary btn-sm' href='" +
                                url + "'>Ver publicación</a></p></div></div></div></div>";

                        });
                    }

                    content.empty();
                    content.append(resultado);
                }).fail(function() {
                    Swal.fire({
                        title: 'Ocurrió un error en la búsqueda',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })
                });
            } else {
                Swal.fire({
                    title: 'Debes completar el campo para realizar la búsqueda',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        function cargarDatosCategoria() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('turista.getCategorias') }}',
                type: 'post',
                dataType: 'json',
                cache: false
            }).done(function(resp) {
                
                var select = $("#Categorias");
                $.each(resp, function(index, categoria) {
                    select.append('<option value="' + categoria.id_categoria + '">' + categoria
                        .nombre_categoria + '</option>');

                });

            }).fail();

        }

        $('#formCategoria').submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var valor = $("#Categorias").val();

            if (valor != "") {
                var content = $('#find-categorias');
                var resultado = `<div class="d-flex justify-content-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>`;
                content.empty();
                content.append(resultado);

                $.ajax({
                    url: '{{ route('turista.findByCategorias') }}',
                    data: {
                        sValor: valor
                    },
                    type: 'Post',
                    dataType: 'json',
                    cache: false,
                }).done(function(resp) {
                    
                    var content = $('#find-categorias');
                    content.empty();
                    var resultado = "";
                    if (resp.length == 0) {
                        
                        resultado +=
                            "<br /><svg width='27' height='27' fill='none' stroke='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z'></path><path fill='#000000' stroke='none' d='M8.625 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path fill='#000000' stroke='none' d='M15.375 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path d='M15.497 15.918a4.5 4.5 0 0 0-6.994 0'></path></svg> ¡Ops!, parece que no hay resultados <br />";
                    } else {
                        resultado += "<p> Total de resultados: " + resp.length + "</p>"
                        $.each(resp, function(index, lugar) {
                            var fechaComentario = new Date(lugar.fecha);
                            var diferenciaComentario = new Date() - fechaComentario;

                            var formatoFechaComentario;

                            if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                                formatoFechaComentario = fechaComentario.toLocaleDateString(
                                    "es-ES", {
                                        day: "2-digit",
                                        month: "2-digit",
                                        year: "numeric"
                                    });
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 2) {
                                formatoFechaComentario =
                                    `${Math.floor(diferenciaComentario / (1000 * 60 * 60 * 24))} días atrás`;
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 1) {
                                formatoFechaComentario = "Ayer";
                            } else {
                                formatoFechaComentario = "Hoy";
                            }

                            var lugarId = lugar.idLugar;
                            var url =
                                "{{ route('turista.postDetails', ['id' => ':lugarId', 'user' => 1]) }}";
                            url = url.replace(':lugarId', lugarId);

                            var img = 'data:image;base64,' + lugar.imagen;
                            resultado +=
                                "<div class='card mb-3'><div class='row g-0'><div class='col-md-4 feed-image'><img src='" +
                                img +
                                "' class='img-fluid rounded-start' alt='Foto del lugar'></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>" +
                                lugar.nombre + "</h5><p class='card-text'>" + lugar.descripcion +
                                "</p><p class='card-text'><small class='text-muted'>" +
                                formatoFechaComentario +
                                "</small></p><p class='card-text'><a class='btn btn-primary btn-sm' href='" +
                                url + "'>Ver publicación</a></p></div></div></div></div>";
                        });
                    }

                    content.empty();
                    content.append(resultado);
                }).fail(function() {
                    Swal.fire({
                        title: 'Ocurrió un error en la búsqueda',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })
                });
            } else {
                Swal.fire({
                    title: 'Debes completar el campo para realizar la búsqueda',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        $('#formDescripcion').submit(function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var valor = $("#Descripcion").val();

            if (valor != "") {
                var content = $('#find-descripcion');
                var resultado = `<div class="d-flex justify-content-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>`;
                content.empty();
                content.append(resultado);

                $.ajax({
                    url: '{{ route('turista.findByDescripcion') }}',
                    data: {
                        sValor: valor
                    },
                    type: 'Post',
                    dataType: 'json',
                    cache: false,
                }).done(function(resp) {
                    
                    var content = $('#find-descripcion');
                    content.empty();
                    var resultado = "";
                    if (resp.length == 0) {
                        
                        resultado +=
                            "<br /><svg width='27' height='27' fill='none' stroke='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z'></path><path fill='#000000' stroke='none' d='M8.625 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path fill='#000000' stroke='none' d='M15.375 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path d='M15.497 15.918a4.5 4.5 0 0 0-6.994 0'></path></svg> ¡Ops!, parece que no hay resultados <br />";
                    } else {
                        resultado += "<p> Total de resultados: " + resp.length + "</p>"
                        $.each(resp, function(index, lugar) {
                            var fechaComentario = new Date(lugar.fechaPublicacion);
                            var diferenciaComentario = new Date() - fechaComentario;

                            var formatoFechaComentario;

                            if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                                formatoFechaComentario = fechaComentario.toLocaleDateString(
                                    "es-ES", {
                                        day: "2-digit",
                                        month: "2-digit",
                                        year: "numeric"
                                    });
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 2) {
                                formatoFechaComentario =
                                    `${Math.floor(diferenciaComentario / (1000 * 60 * 60 * 24))} días atrás`;
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 1) {
                                formatoFechaComentario = "Ayer";
                            } else {
                                formatoFechaComentario = "Hoy";
                            }

                            var lugarId = lugar.id_lugar;
                            var url =
                                "{{ route('turista.postDetails', ['id' => ':lugarId', 'user' => 1]) }}";
                            url = url.replace(':lugarId', lugarId);

                            var img = 'data:image;base64,' + lugar.imagen;
                            resultado +=
                                "<div class='card mb-3'><div class='row g-0'><div class='col-md-4 feed-image'><img src='" +
                                img +
                                "' class='img-fluid rounded-start' alt='Foto del lugar'></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>" +
                                lugar.nombre_lugar + "</h5><p class='card-text'>" + lugar
                                .descripcion +
                                "</p><p class='card-text'><small class='text-muted'>" +
                                formatoFechaComentario +
                                "</small></p><p class='card-text'><a class='btn btn-primary btn-sm' href='" +
                                url + "'>Ver publicación</a></p></div></div></div></div>";
                        });
                    }

                    content.empty();
                    content.append(resultado);
                }).fail(function() {
                    Swal.fire({
                        title: 'Ocurrió un error en la búsqueda',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })
                });
            } else {
                Swal.fire({
                    title: 'Debes completar el campo para realizar la búsqueda',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        $('#formNombre').submit(function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var valor = $("#Lugar").val();

            if (valor != "") {
                var content = $('#find-nombre');
                var resultado = `<div class="d-flex justify-content-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>`;
                content.empty();
                content.append(resultado);
                $.ajax({
                    url: '{{ route('turista.findByNombre') }}',
                    data: {
                        sValor: valor
                    },
                    type: 'Post',
                    dataType: 'json',
                    cache: false,
                }).done(function(resp) {
                    var content = $('#find-nombre');
                    content.empty();
                    var resultado = "";
                    if (resp.length == 0) {
                        
                        resultado +=
                            "<br /><svg width='27' height='27' fill='none' stroke='#000000' stroke-linecap='round' stroke-linejoin='round' stroke-width='1' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z'></path><path fill='#000000' stroke='none' d='M8.625 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path fill='#000000' stroke='none' d='M15.375 11.625a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'></path><path d='M15.497 15.918a4.5 4.5 0 0 0-6.994 0'></path></svg> ¡Ops!, parece que no hay resultados <br />";
                    } else {
                        resultado += "<p> Total de resultados: " + resp.length + "</p>"
                        $.each(resp, function(index, lugar) {
                            var fechaComentario = new Date(lugar.fechaPublicacion);
                            var diferenciaComentario = new Date() - fechaComentario;

                            var formatoFechaComentario;

                            if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                                formatoFechaComentario = fechaComentario.toLocaleDateString(
                                    "es-ES", {
                                        day: "2-digit",
                                        month: "2-digit",
                                        year: "numeric"
                                    });
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 2) {
                                formatoFechaComentario =
                                    `${Math.floor(diferenciaComentario / (1000 * 60 * 60 * 24))} días atrás`;
                            } else if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 1) {
                                formatoFechaComentario = "Ayer";
                            } else {
                                formatoFechaComentario = "Hoy";
                            }

                            var lugarId = lugar.id_lugar;
                            var url =
                                "{{ route('turista.postDetails', ['id' => ':lugarId', 'user' => 1]) }}";
                            url = url.replace(':lugarId', lugarId);

                            var img = 'data:image;base64,' + lugar.imagen;
                            resultado +=
                                "<div class='card mb-3'><div class='row g-0'><div class='col-md-4 feed-image'><img src='" +
                                img +
                                "' class='img-fluid rounded-start' alt='Foto del lugar'></div><div class='col-md-8'><div class='card-body'><h5 class='card-title'>" +
                                lugar.nombre_lugar + "</h5><p class='card-text'>" + lugar
                                .descripcion +
                                "</p><p class='card-text'><small class='text-muted'>" +
                                formatoFechaComentario +
                                "</small></p><p class='card-text'><a class='btn btn-primary btn-sm' href='" +
                                url + "'>Ver publicación</a></p></div></div></div></div>";
                        });
                    }

                    content.empty();
                    content.append(resultado);
                }).fail(function() {
                    Swal.fire({
                        title: 'Ocurrió un error en la búsqueda',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })
                });
            } else {
                Swal.fire({
                    title: 'Debes completar el campo para realizar la búsqueda',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });
    </script>
</body>

</html>
