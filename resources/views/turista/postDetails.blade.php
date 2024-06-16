<!DOCTYPE html>
<html lang="es-mx">

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
    <link href="{{ asset('css/turista.css') }}" rel="stylesheet">

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
                <a class="navbar-brand"><img
                        src="{{ asset('icon.svg') }}" height="50px" /></a>
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
                                    <a href="/" type="submit" class="nav-link text-dark" style="background: none; border: none; cursor: pointer;">Cerrar sesión</a>
                                </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container" id="primary-content">
        <main role="main" class="">
            <div class="row">
                @if ($lugar->count() > 0)
                    @foreach ($lugar as $item)
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

                        <div class="left col-md-6 grid gap-0 row-gap-3">
                            <div class="row p-2 g-col-12">
                                <input name="IdUsuario" class="form-control" id="idUsuario" hidden
                                    value="{{ Auth::user()->id_usuario }}" />
                                <div class="details">
                                    <div>
                                        <a href="{{ route('turista.index') }}">
                                            <svg width="21" height="21" fill="#212121" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19 11.001H7.14l3.63-4.36a1.001 1.001 0 0 0-1.54-1.28l-5 6a1.184 1.184 0 0 0-.09.15c0 .05 0 .08-.07.13a1 1 0 0 0-.07.36 1 1 0 0 0 .07.36c0 .05 0 .08.07.13.026.052.056.103.09.15l5 6a1 1 0 0 0 1.41.13 1 1 0 0 0 .13-1.41l-3.63-4.36H19a1 1 0 0 0 0-2Z">
                                                </path>
                                            </svg> Volver atrás
                                        </a>
                                    </div>
                                    <br />
                                    <input name="IdLugar" class="form-control" value="{{ $item->idLugar }}"
                                        id="idLugar" hidden />
                                    <div class="row g-2 details-header">
                                        <div class="col-auto">
                                            <div class="profile-photo">
                                                <img src="data:image;base64,{{ $item->imagenUser }}"
                                                    alt="Foto de perfil" width='37.8' height='37.8'
                                                    class='imagen-turista'>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <b>{{ $item->user }}</b>
                                            <p class="text-muted">{{ $formatoFecha }}</p>
                                        </div>
                                    </div>
                                    <div class="row g-2 ">
                                        <div class="col-auto">
                                            <h4>{{ $item->nombre }}</h4>
                                        </div>
                                    </div>
                                    <div class="row g1 details-location">
                                        <div class="col-auto">
                                            <svg width="20" height="20" fill="#696969" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path>
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 7.92c0 5.48 7.05 11.58 7.35 11.84a1 1 0 0 0 1.3 0C13 21.5 20 15.4 20 9.92A8 8 0 0 0 12 2Zm0 11a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z">
                                                </path>
                                            </svg>
                                            {{ $item->municipio }}, {{ $item->departamento }}
                                        </div>
                                    </div>
                                    <div class="row g1 details-location">
                                        <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                        </svg>
                                            {{ $item->precio }}
                                        </div>
                                    </div>
                                    <div class="row details-description">
                                        <div class="col-auto">
                                            <p>{!! $item->descripcion !!}</p>
                                        </div>
                                    </div>
                                    <div class="feed-photo">
                                        <img src="data:image;base64,{{ $item->imagen }}" alt="Foto de lugar"
                                            class="profile-picture">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="middle col-md-6 grid gap-0 row-gap-3">
                            <div class="row p-2 g-col-12">
                                <div class="feed">
                                    <div class="row g-2 comment-section-stars" style="margin-top: 5px;">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <span class="puntuacion" id="valoracionNumber"></span>
                                                <div class="valoracion mx-0 p-0">

                                                    <button type="button" id="star5" class="icon-button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="Excelente">
                                                        <i class="fas fa-star icon" id="star5i"></i>
                                                    </button>
                                                    <button id="star4" class="icon-button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="Muy Bueno">
                                                        <i class="fas fa-star icon" id="star4i"></i>
                                                    </button>
                                                    <button id="star3" class="icon-button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="Regular">
                                                        <i class="fas fa-star icon" id="star3i"></i>
                                                    </button>
                                                    <button id="star2" class="icon-button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="Malo">
                                                        <i class="fas fa-star icon" id="star2i"></i>
                                                    </button>
                                                    <button id="star1" class="icon-button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="Muy Malo">
                                                        <i class="fa fa-star icon" id="star1i"></i>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-auto">
                                                    <br>
                                                    <button id="generalAddValorcion" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#myModal">
                                                        Agregar mi valoración
                                                        <i class="fa fa-solid fa-pen ms-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="title-valoracion">Nueva valoración
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="row g-2">Valoración</label>
                                                        <div class="valoracion mx-0 p-0">
                                                            <!-- Estrella 1 -->
                                                            <button id="star5_{{ $item->idLugar }}"
                                                                class="icon-button"
                                                                onclick="valoracion({{ $item->idLugar }}, 5)">
                                                                <i class="fas fa-star icon"></i>
                                                            </button>

                                                            <!-- Estrella 2 -->
                                                            <button id="star4_{{ $item->idLugar }}"
                                                                class="icon-button"
                                                                onclick="valoracion({{ $item->idLugar }}, 4)">
                                                                <i class="fas fa-star icon"></i>
                                                            </button>

                                                            <!-- Estrella 3 -->
                                                            <button id="star3_{{ $item->idLugar }}"
                                                                class="icon-button"
                                                                onclick="valoracion({{ $item->idLugar }}, 3)">
                                                                <i class="fas fa-star icon"></i>
                                                            </button>

                                                            <!-- Estrella 4 -->
                                                            <button id="star2_{{ $item->idLugar }}"
                                                                class="icon-button"
                                                                onclick="valoracion({{ $item->idLugar }},2)">
                                                                <i class="fas fa-star icon"></i>
                                                            </button>

                                                            <!-- Estrella 5 -->
                                                            <button id="star1_{{ $item->idLugar }}"
                                                                class="icon-button"
                                                                onclick="valoracion({{ $item->idLugar }}, 1)">
                                                                <i class="fa fa-star icon"></i>
                                                            </button>

                                                        </div>

                                                        <div id="valoracionComentario" class="mt-4 mb-1 mt-2"
                                                            style="display: none">
                                                            <label class="row g-2 mt-2">Deja tu reseña
                                                                (opcional)
                                                            </label>
                                                            <textarea id="v-comentario" rows="6" cols="50" class="form-control" placeholder="Escribe tu reseña..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="button"
                                                            onclick="saveValoracion({{ $item->idLugar }})"
                                                            class="btn btn-warning" id="guardarValoracion"
                                                            data-bs-dismiss="modal"
                                                            style="display: none">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <p class="mt-3" id="valoracionesContainer"></p>

                                    <br>
                                    <div class="row comment-section-comments" id="contenido">
                                        <div class="col-12">
                                            <p class="comment-description">Comentarios</p>
                                            <div id="comments-alert" class="alert alert-danger" role="alert"
                                                style="display: none">
                                                Usuarios anónimos no pueden comentar, <a href="/Home/Login">Inicia
                                                    Sesión</a> o <a href="/Home/Register">Registrate</a>
                                            </div>
                                        </div>
                                        <div class="col-12 create-comment">
                                            <form id="formComment">
                                                <div class="form-group">
                                                    <input value="$item->idLugar" id="IdLugar" name="IdLugar"
                                                        class="form-control" hidden />
                                                </div>
                                                <div class="input-group">
                                                    <textarea id="Comentario" rows="4" cols="50" class="form-control" placeholder="Escribe tu comentario"
                                                        required></textarea>

                                                    <button type="submit" class="btn btn-icon" style="border:none;"
                                                        id="enviar">
                                                        <svg width="34" height="34" fill="#000000"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2 12a10 10 0 1 0 20 0 10 10 0 0 0-20 0Zm11.86-3.69 2.86 3a.49.49 0 0 1 .1.15.54.54 0 0 1 .1.16.94.94 0 0 1 0 .76 1 1 0 0 1-.21.33l-3 3a1.004 1.004 0 1 1-1.42-1.42l1.3-1.29H8a1 1 0 0 1 0-2h5.66l-1.25-1.31a1.001 1.001 0 0 1 1.45-1.38Z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                            <br />
                                        </div>

                                        <div class="col-12" id="Comentarios">
                                            <div class="d-flex justify-content-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Modal para editar comentario -->
            <div class="modal fade" id="modificarComment" tabindex="-1" aria-labelledby="modificarCommentLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modificarCommentLabel">Editar comentario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="cls"></button>
                        </div>
                        <form id="formModificarComentario">
                            <div class="modal-body">
                                <input id="uIdComentario" class="form-control" hidden />
                                <div class="form-group mb-1">
                                    <label class="control-label">Comentario:</label>
                                    <textarea id="uComentario" rows="6" cols="50" class="form-control" placeholder="Escribe tu comentario"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnCerrar2" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" id="btnActualizar" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script>
        //variable global puntuación
        var puntuacion = 0;
        let valoracionGlobal = 0;
        let valoraciones = 0;
        var valoracionUsuaro = null

        var usuario = {{ Auth::user()->id_usuario }};

        const swal2Btns = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-4'
            },
            buttonsStyling: false
        })

        function valoracion(idLugar, idStar) {
            const stars = [
                document.getElementById(`star1_${idLugar}`),
                document.getElementById(`star2_${idLugar}`),
                document.getElementById(`star3_${idLugar}`),
                document.getElementById(`star4_${idLugar}`),
                document.getElementById(`star5_${idLugar}`),
            ]
            //Variable global puntuacion
            puntuacion = idStar

            svButton = document.getElementById('guardarValoracion')
            svButton.style.display = 'inline';

            stars.forEach((star, index) => {
                if (index < idStar)
                    star.style.color = '#F9D75D';
                else
                    star.style.color = '#5f5050';
            })
        }

        function setValoracion(idStar) {
            var div = document.getElementById("miDiv");
            let parteEntera = Math.floor(idStar);
            let parteDecimal = idStar - parteEntera;
            const stars = [
                document.getElementById('star1'),
                document.getElementById('star2'),
                document.getElementById('star3'),
                document.getElementById('star4'),
                document.getElementById('star5'),
            ];
            //Variable global puntuacion
            stars.forEach((star, index) => {
                let val = index + 1;
                let icon = document.getElementById(`star${val}i`);
                if (index < parteEntera) {
                    star.style.color = '#F9D75D';
                    icon.classList.replace("fa-regular", "fas");
                    icon.classList.replace("fa-star-half-stroke", "fa-star");
                } else if (index === parteEntera && parteDecimal > 0.2) {
                    star.style.color = '#F9D75D';
                    icon.classList.replace("fa-regular", "fa-solid");
                    icon.classList.replace("fa-star", "fa-star-half-stroke");
                } else {
                    star.style.color = '';
                    icon.classList.replace("fas", "fa-regular");
                    icon.classList.replace("fa-star-half-stroke", "fa-star");
                }
            });
        }


        function saveValoracion(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let comentario = document.getElementById('v-comentario').value;

            $.ajax({
                url: '{{ route('turista.saveValoracion') }}',
                data: {
                    comentario: comentario,
                    puntuacion: puntuacion,
                    idLugar: id,
                    idUsuario: usuario
                },
                type: 'Post',
                dataType: 'json',
                cache: false,
            }).done(function(resp) {
                getValoracionUsusarioLugar(id);
                getValoraciones(id);
                getValoracion(id);
                //location.reload();
                swal2Btns.fire(
                    'Valoracion enviada',
                    'Muchas gracias por tu opinión',
                    'success'
                )
            }).fail(function() {
                Swal.fire({
                    title: 'Hubo un error al momento de guardar la valoración',
                    icon: 'error',
                    confirmButtonText: 'Continuar'
                })
            });
        }

        function getValoracion(lugar) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('turista.ShowValoracionesLugar') }}',
                data: {
                    idLugar: lugar
                },
                type: 'Post',
                dataType: 'json',
                cache: false,
            }).done(function(resp) {
                
                if (resp > 0) {
                    var valoracionGlobal = resp
                    var valoracionNumber = document.getElementById('valoracionNumber');
                    valoracionNumber.innerHTML = valoracionGlobal;
                    setValoracion(valoracionGlobal)
                } else {
                    var valoracionNumber = document.getElementById('valoracionNumber');
                    valoracionNumber.innerHTML = "0.0";
                }
            }).fail(function() {
                Swal.fire({
                    title: 'Hubo un error al momento de obtener el promedio de puntuación',
                    icon: 'error',
                    confirmButtonText: 'Continuar'
                })
            });
        }

        function getValoraciones(lugar) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('turista.GetValoraciones') }}',
                data: {
                    idLugar: lugar
                },
                type: 'Post',
                dataType: 'json',
                cache: false,
            }).done(function(resp) {

                var content = $('#valoracionesContainer');
                var comment = "";
                var user = $('#idUsuario').val();
                $.each(resp, function(index, comentario) {

                    if (comentario.comentario != null) {
                        var fechaComentario = new Date(comentario.fecha);
                        var diferenciaComentario = new Date() - fechaComentario;

                        var formatoFechaComentario;

                        if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                            formatoFechaComentario = fechaComentario.toLocaleDateString("es-ES", {
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

                        var img = 'data:image;base64,' + comentario.imagen;
                        comment += `<div class='row g-2 feed-header'> 
                                    <div class='col-auto'>
                                        <div class='profile-photo'>
                                        <img src='${img}' alt='Foto de perfil' width='37.8' height='37.8' class='imagen-turista'>
                                        </div>
                                    </div>
                                    <div class='col-auto'>
                                        <b>${comentario.nombre}  ${comentario.apellido} </b> 
                                        <p class='text-muted'> ${formatoFechaComentario} </p> 
                                    </div>`;


                        comment += `<div class="col-auto" >
                                <div class="btn-group">`

                        for (let i = 1; i <= 5; i++) {
                            if (i <= comentario.puntuacion) {
                                comment +=
                                    `<i class="fas fa-star icon" style="color: rgb(249, 215, 93);"></i>`
                            } else {
                                comment +=
                                    `<i class="fa-regular fa-star icon icon" style="color: rgb(249, 215, 93);"></i>`

                            }
                        }

                        comment += `</div></div></div>`



                        comment += "<div class='col-12'><p> " + comentario.comentario + "</p></div>";
                    }

                });
                content.empty();
                content.append(comment);
            })
        }

        function getValoracionUsusarioLugar(lugar_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('turista.ValoracionUsusarioLugar') }}',
                data: {
                    idLugar: lugar_id,
                    idUsuario: usuario
                },
                type: 'Post',
                dataType: 'json',
                cache: false,
            }).done(function(resp) {
                if (resp.id_usuario === undefined) {
                    console.log("no hay valoraciones");
                } else {
                    let generalAddValorcion = document.getElementById('generalAddValorcion')
                    let title = document.getElementById('title-valoracion')
                    let comentario = document.getElementById('v-comentario')

                    generalAddValorcion.innerHTML =
                        'Actualizar mi valoración  <i class="fa fa-solid fa-pen ms-2"></i>'
                    title.innerHTML = "Actualizar valoración";
                }

            })
        }

        function showData(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ route('turista.allComments') }}',
                data: {
                    id: id
                },
                type: 'Post',
                dataType: 'json',
                cache: false,
            }).done(function(resp) {

                var content = $('#Comentarios');
                var comment = "";
                var user = $('#idUsuario').val();
                $.each(resp, function(index, comentario) {
                    var fechaComentario = new Date(comentario.fecha);
                    var diferenciaComentario = new Date() - fechaComentario;

                    var formatoFechaComentario;

                    if (diferenciaComentario / (1000 * 60 * 60 * 24) >= 7) {
                        formatoFechaComentario = fechaComentario.toLocaleDateString("es-ES", {
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

                    var img = 'data:image;base64,' + comentario.imagen;
                    comment +=
                        "<div class='row g-2 feed-header'> <div class='col-auto'><div class='profile-photo'><img src='" +
                        img +
                        "' alt='Foto de perfil' width='37.8' height='37.8' class='imagen-turista'></div></div><div class='col-auto'><b>" +
                        comentario.nombre + " " + comentario.apellido + "</b> <p class='text-muted'>" +
                        formatoFechaComentario + "</p> </div>";

                    var texto = comentario.comentario;
                    var textoModificado = texto.replace(/ /g, "-");


                    if (usuario == comentario.idUsuario) {
                        comment += `<div class="col-auto" >
                                <div class="btn-group">
                                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="20" height="20" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M15.964 3.793a3 3 0 0 1 4.243 4.242l-7.122 7.123a3 3 0 0 1-1.533.82l-2.942.588a1 1 0 0 1-1.176-1.176l.588-2.942a3 3 0 0 1 .82-1.533l7.122-7.122Zm2.829 1.414a1 1 0 0 0-1.414 0L17 5.586 18.414 7l.379-.379a1 1 0 0 0 0-1.414ZM17 8.414 15.586 7l-5.33 5.33a1 1 0 0 0-.273.51l-.294 1.47 1.47-.293a1 1 0 0 0 .512-.274L17 8.414ZM6 5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-6a1 1 0 1 1 2 0v6a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3h6a1 1 0 1 1 0 2H6Z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modificarComment" onclick=cargarUpt('${comentario.idComentario}&&${textoModificado}') >Editar</a></li>
                                        <li><a class="dropdown-item" href="javascript:cargarDel(${comentario.idComentario})">Eliminar</a></li>                                        </ul>
                                </div>
                                            </div> </div>`
                    } else {
                        comment += `</div>`
                    }


                    comment += "<div class='col-12'><p> " + comentario.comentario + "</p></div>";

                    if (!(index === resp.length - 1)) {
                        comment += "<div class='text-primary'>  <hr></div>";
                    }
                });
                content.empty();
                content.append(comment);
            }).fail();
        };

        $(document).ready(function() {
            var valor = $("#idLugar").val();

            getValoracionUsusarioLugar(valor);
            showData(valor);
            getValoraciones(valor);
            getValoracion(valor);

        });

        function cargarDel(idComment) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estas seguro(a)?',
                text: "Una vez eliminado ya no podrás recuperar el comentario",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var idLugar = $("#idLugar").val();

                    $.ajax({
                        url: '{{ route('turista.deleteComment') }}',
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {
                            id: idComment
                        }
                    }).done(function(resp) {
                        if (resp) {
                            swalWithBootstrapButtons.fire(
                                'Eliminado',
                                'Tu registro ha sido eliminado.',
                                'success'
                            )
                            showData(idLugar);
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Cancelado',
                                'Se han omitido la acción',
                                'error'
                            )
                        }
                    }).fail();
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Se han omitido la acción',
                        'error'
                    )
                }
            })
        }

        function cargarUpt(valor) {
            var obj = valor.split('&&');
            var textoModificado = obj[1];
            var textoOriginal = textoModificado.replace(/-/g, " ");

            document.getElementById("uIdComentario").value = obj[0];
            document.getElementById("uComentario").value = textoOriginal;

        }


        $('#formComment').submit(function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var inputsInvalidos = $("#formComment .is-invalid").length;
            var idLugar = $("#idLugar").val();
            var comentario = $("#Comentario").val();


            if (comentario != "") {

                var commentObj = {
                    IdUsuario: usuario,
                    IdLugar: idLugar,
                    Comentario: comentario
                };

                if (inputsInvalidos === 0) {
                    $.ajax({
                        url: '{{ route('turista.createComment') }}',
                        data: commentObj,
                        type: 'Post',
                        dataType: 'json',
                        cache: false,
                    }).done(function(resp) {
                        Swal.fire({
                            title: '¡Gracias por tu comentario!',
                            icon: 'success',
                            confirmButtonText: 'Continuar'
                        })
                        document.getElementById("Comentario").value = "";
                        showData(idLugar);
                    }).fail(function() {
                        Swal.fire({
                            title: 'Ocurrió un error',
                            icon: 'success',
                            confirmButtonText: 'Continuar'
                        })
                    });

                } else {
                    Swal.fire({
                        title: 'Verifica los textos marcador en rojo para continuar',
                        icon: 'error',
                        confirmButtonText: 'Continuar'
                    })

                }
            } else {
                Swal.fire({
                    title: 'El campo es obligatorio',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                })
            }
        });

        $("#cls").click(function() {
            document.getElementById("Comentario").value = "";
        });

        $("#btnActualizar").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //console.log(1);
            if ($("#uIdComentario").val() != "" && $("#uComentario").val() != "") {

                var inputsInvalidos2 = $("#formModificarComentario .is-invalid").length;

                var obj1 = $("#uIdComentario").val();
                var obj2 = $("#uComentario").val();
                var idLugar = $("#idLugar").val();

                if (inputsInvalidos2 === 0) {
                    $.ajax({
                        url: '{{ route('turista.updateComment') }}',
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: {
                            id: obj1,
                            valor: obj2
                        }
                    }).done(function(resp) {
                        if (resp) {
                            Swal.fire({
                                title: 'El comentario ha sido modificado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Continuar'
                            })
                            showData(idLugar);
                            $("#btnCerrar2").click();
                            $("#uComentario").val("");
                            $("#uIdComentario").val("");
                        } else {
                            Swal.fire({
                                title: 'Hubo un error al momento de actualizar el dato',
                                icon: 'error',
                                confirmButtonText: 'Continuar'
                            })
                        }
                    }).fail(function() {
                        Swal.fire({
                            title: 'Hubo un error al momento de actualizar el dato',
                            icon: 'error',
                            confirmButtonText: 'Continuar'
                        })
                    });
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
        });
    </script>
</body>

</html>
