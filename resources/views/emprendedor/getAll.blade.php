<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SivarBook</title>
    <link rel="shortcut icon" href="~/Images/SivarBook.png" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/valoraciones.css') }}" rel="stylesheet">
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
    <link href="{{ asset('css/dashboardEmprendedor.css') }}" rel="stylesheet">
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
                    <li class="breadcrumb-item active" aria-current="page">Ver otras publicaciones</li>
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
                    <div class="handle">
                        <br />
                            <b id="nombrePlaceholder"><span class=""></span></b>
                            <p class="text-muted mb-0" id="edadPlaceholder">
                                Edad: <span class=""></span>
                            </p>
                            <p class="text-muted" id="emailPlaceholder">
                                E-mail: <span class=""></span>
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
                            <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.592 3.027C14.68 2.042 13.406 1.5 12 1.5c-1.414 0-2.692.54-3.6 1.518-.918.99-1.365 2.334-1.26 3.786C7.348 9.67 9.528 12 12 12c2.472 0 4.648-2.33 4.86-5.195.106-1.439-.344-2.78-1.268-3.778Z">
                            </path>
                            <path
                                d="M20.25 22.5H3.75a1.454 1.454 0 0 1-1.134-.522 1.655 1.655 0 0 1-.337-1.364c.396-2.195 1.63-4.038 3.571-5.333C7.574 14.132 9.758 13.5 12 13.5c2.242 0 4.426.633 6.15 1.781 1.94 1.294 3.176 3.138 3.571 5.332.091.503-.032 1-.336 1.365a1.453 1.453 0 0 1-1.135.522Z">
                            </path>
                        </svg>                            &nbsp; &nbsp;
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
                            <b style="font-size:20px;"> > > Todas las publicaciones</b> 
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

        function cargarLugares() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('emprendedor.getTablaLugares') }}',
                type: 'post',
                dataType: 'json',
                cache: false,
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
                        var textomodificado3 = texto3.replace(/ /g, "-");

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



        $(document).ready(function () {
            cargarUsuarioById();
            cargarLugares();
            callAPI();

        });

</script>

</body>
</html>