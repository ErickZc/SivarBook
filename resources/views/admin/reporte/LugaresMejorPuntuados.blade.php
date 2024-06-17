<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<body>

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
                            <li><a class="dropdown-item active" href="/admin/reporte/lugaresmejorpuntuados">Lugares Mejor Puntuados</a></li>
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

<div class="container contenedor" style="height: 425px;">
    <div class="mt-3 create-post">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a>Inicio</a></li>
            <li class="breadcrumb-item"><a >Reportes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lugares mejor puntuados</li>
        </ol>
    </nav>

        <div class="row feed">
            <div class="data-body">
                <h1 class="text-center fw-bold">Reporte de lugares mejor valorados</h1>
                <br/>
                <p action="text-mutted">
                    Para generar el reporte de lugares, seleccione el departamento y clic en generar.
                    Ten en cuenta que solo se mostraran los lugares con un promedio de <strong> 4.5 </strong> a <strong> 5 </strong>estrellas
                </p>
                <div id="contenido-reporte">

                    <form>
                        <div class="d-flex align-items-center">
                            <p>Buscado por: </p>
                            <!-- <div class="spinner-border ms-auto spinner-border-sm" role="status" id="cargandoSpinner" aria-hidden="true"></div> -->
                        </div>
                        <div class="d-flex align-items-center">
                            <label class="">Departamento</label>
                        </div>
                        <select name="idDepartamento" id="idDepartamento" class="form-control" required>
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id_depto }}">{{ $departamento->departamento }}</option>
                            @endforeach
                        </select>
                        <br />
                        <button type="button" class="btn btn-primary btn-lg" id="enviar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                        <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                        <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                        </svg>
                            Generar
                        </button>
                        <button type="button" class="btn btn-outline-dark btn-lg" id="enviarAll">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                        </svg>
                        </svg>
                            Reporte sin filtro
                        </button>
                    </form>
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

    <script type="text/javascript">
        $(document).ready(function () {

            var selectCategoria = document.getElementById("idDepartamento");
            selectCategoria.addEventListener("change", function () {
                if (selectCategoria.value != "") {
                    selectCategoria.classList.add("is-valid");
                    selectCategoria.classList.remove("is-invalid");
                } else {
                    selectCategoria.classList.add("is-invalid");
                    selectCategoria.classList.remove("is-valid");
                }
            });

            $("#enviar").click(function () {
                antesDeEnviar();
            });

            $("#enviarAll").click(function () {
                window.location.href = "http://localhost:8000/admin/reporte/views/pdfLugaresMejorValoradosAll";
            });

        });

        function antesDeEnviar() {
            if ($("#idDepartamento").val() != "") {
                window.location.href = "http://localhost:8000/admin/reporte/views/pdfLugaresMejorValorados?id=" + $("#idDepartamento").val();
            } else {
                var catego = document.getElementById("idDepartamento");
                catego.classList.add("is-invalid");

                catego.classList.add('select-animation');
                setTimeout(function () {
                    catego.classList.remove('select-animation');
                }, 250);

            }
        }

    </script>
    
</body>
</html>