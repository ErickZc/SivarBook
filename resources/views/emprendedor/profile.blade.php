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
                    <li class="breadcrumb-item active" aria-current="page">Mi perfil</li>
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
                            <div class="profile mb-4">
                                <div class="profile-photo-align">
                                    <div id="foto-contenedor">
                                        <div class="profile-photo-primary-profile-2">
                                            <img src="data:image;base64,{{ $usuarios->imagen }}" id="foto"
                                                alt="Foto de perfil" class='imagen-turista'
                                                width='196' height='196'>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4 mb-4">
                                    <button class="btn buttonAdd buttonGeneric" data-bs-toggle="offcanvas" style="width: 40%;"
                                        href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
                                        id="actualizarFoto">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                                        </svg>

                                        Actualizar foto
                                        <i class="fa fa-solid fa-pen ms-2"></i>
                                    </button>

                                </div>
                                <br />
                                <h4 class="text-start mt-4 ps-4 pe-4">Datos de mi perfil</h4>
                                <div class="text-dark ps-4 pe-4">
                                    <hr>
                                </div>
                                <br />
                                <div class="row pb-4">
                                    <div class="col-md-8 offset-md-2">
                                        <form id="Form1">
                                            <input type="text" class="form-control" id="idUser"
                                                    value="{{ $usuarios->id_usuario }}" hidden>


                                            <div class="form-floating mb-3"> 
                                                <input type="text" class="form-control text-left" placeholder="Nombre" disabled id="Nombre"
                                                    value="{{ $usuarios->nombre }}">
                                                <label for="Nombre" class="text-left" >Nombre</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" disabled id="Apellido"
                                                    value="{{ $usuarios->apellido }}" placeholder="Apellido">
                                                <label for="Apellido">Apellido</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" disabled id="Edad"
                                                    value="{{ $usuarios->edad }}" placeholder="Edad">
                                                <label for="Edad">Edad</label>
                                            </div>
                                            <div class="form-floating mb-5">
                                                <input type="text" class="form-control" disabled id="Correo"
                                                    value="{{ $usuarios->correo }}" placeholder="Correo">
                                                <label for="Correo">Correo</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <button class="btn btn-outline-dark buttonGeneric"
                                                        style="width: 100%;" id="editarPerfil" name="editarPerfil" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                        </svg>
                                                        Editar

                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn buttonAdd buttonGeneric" style="width: 100%;"
                                                        id="actualizarPerfil" type="button" disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-send-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                        </svg>
                                                        Actualizar Perfil

                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Actualizar mi foto de perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"
                        id="cerrar"></button>
                </div>
                <form id="formulario">
                    @csrf
                    <div class="offcanvas-body">
                        <div>
                            Ahora que quieres cambiar tu foto de perfil, simplemente agrega una imagen en la siguiente
                            caja de texto y dale clic al boton "Modificar", de esta forma, ya habras cambiado tu foto de
                            perfil :)
                        </div>
                        <input type="text" class="form-control" name="id_usuario" id="id_usuario"
                            value="{{ $usuarios->id_usuario }}" hidden>
                        <br />
                        <input type="file" name="imagenArchivo" class="form-control"
                            accept="image/jpeg, image/png, image/gif" id="Imagen" />
                        <br />
                        <br />

                        <button class="btn buttonAdd buttonGeneric" id="actualizarPerfil" type="submit" style="width: 100%;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg>
                            Modificar

                        </button>
                    </div>
                </form>
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

    // var usuario = 36;
    var usuario = {{ Auth::user()->id_usuario }};

    function scrollFunction() {
        var footer = document.getElementById("footer");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            footer.style.bottom = "0";
        } else {
            footer.style.bottom = "-200px";
        }
    }

    function callAPI() {
            const url = 'https://newsdata.io/api/1/news?apikey=pub_24023d24caea9400184d5f62d4dbd77f52c41&q=el%20salvador&country=sv&language=es&category=entertainment,food,health,tourism,technology';

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
                    console.log(dataJSON);
                })
                .catch(error => {
                    console.log(error);
                })
    }

    $(document).ready(function() {
        callAPI();
        function cargarImagenInicio(id) {
            //console.log(id + " usuario");
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $.ajax({
                url: '{{ route('emprendedor.getImage') }}',
                type: 'post',
                data: {
                    id_usuario: id
                },
                dataType: 'json',
                cache: false
            }).done(function(resp) {
                //console.log(resp);

                var div = $("#foto-contenedor");
                var div2 = "<div class='profile-photo-primary-profile-2'>";

                $.each(resp, function(index, usuario) {
                    var img = 'data:image;base64,' + usuario.imagen;

                    console.log(img);

                    var imagenHTML =
                        "<img class='imagen-turista' id='foto' width='196' height='196' alt='Foto de perfil' src='" + img + "'>";

                    div2 += imagenHTML;
                 });
                div2 += "</div>";
                div.empty();
                div.append(div2);

            }).fail();

        }


        $('#formulario').submit(function(event) {
            event.preventDefault();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            var formData = new FormData();
            var inputsInvalidos = $("#formulario .is-invalid").length;
            var img = $("#Imagen").val();

            if (img != "") {
                if (inputsInvalidos === 0) {
                    formData.append('imageFile', $('#Imagen')[0].files[0]);
                    formData.append('idUser', $("#idUser").val());

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('emprendedor.updateImageProfile') }}',
                        type: 'POST',
                        data: new FormData(this),
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false
                    }).done(function(resp) {
                        if (resp) {
                            Swal.fire({
                                title: 'El registro ha sido agregado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Continuar'
                            })

                            $("#cerrar").trigger("click");
                            $("#Imagen").val("");
                            document.getElementById("Imagen").classList.remove("is-valid");
                            cargarImagenInicio($("#idUser").val());
                        } else {
                            Swal.fire({
                                title: 'Hubo un error al momento de agregar el dato',
                                icon: 'error',
                                confirmButtonText: 'Continuar'
                            })
                        }
                    }).fail(function() {
                        Swal.fire({
                            title: 'Hubo un error al momento de agregar el dato',
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
        });

        $("#editarPerfil").click(function() {
            habilitar();
            
        });

        $("#actualizarPerfil").click(function() {
            //deshabilitar();

            var inputsInvalidos = $("#Form1 .is-invalid").length;
            var nom = $("#Nombre").val();
            var ape = $("#Apellido").val();
            var eda = $("#Edad").val();
            var id = {{ $usuarios->id_usuario }}
            var formulario = $("#Form1").serialize();

            if (nom != "" && ape != "" && eda != "") {

                if (inputsInvalidos === 0) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('emprendedor.updateProfile') }}',
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        data: {
                            id_usuario: id,
                            nombre: nom,
                            apellido: ape,
                            edad: eda
                        }
                    }).done(function(resp) {
                        if (resp) {
                            Swal.fire({
                                title: 'La información del usuario ha sido actualizada',
                                icon: 'success',
                                confirmButtonText: 'Continuar'
                            })
                            limpiarCajas(nom, ape, eda);
                            limpiarClases();
                            deshabilitar();
                        } else {
                            Swal.fire({
                                title: 'Hubo un error al momento de agregar el dato',
                                icon: 'error',
                                confirmButtonText: 'Continuar'
                            })
                        }
                    }).fail(function() {
                        Swal.fire({
                            title: 'Hubo un error al momento de agregar el dato',
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

        });


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

        inputNombre.addEventListener("keypress", function() {
            validarNombre();
        });

        inputNombre.addEventListener("keydown", function() {
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

        inputApellido.addEventListener("keypress", function() {
            validarApellido();
        });

        inputApellido.addEventListener("keydown", function() {
            setTimeout(validarApellido, 0);
        });

        var inputEdad = document.getElementById("Edad");
        inputEdad.addEventListener("keypress", function(event) {
            var keyCode = event.keyCode || event.which;

            if (keyCode < 48 || keyCode > 57) {
                event.preventDefault();
                inputEdad.classList.add("is-invalid");
                inputEdad.classList.remove("is-valid");
            } else {
                inputEdad.classList.add("is-valid");
                inputEdad.classList.remove("is-invalid");

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

        function limpiarCajas(nombre, apellido, edad) {
            document.getElementById("Nombre").value = nombre;
            document.getElementById("Apellido").value = apellido;
            document.getElementById("Edad").value = edad;
        }

        function limpiarClases() {
            document.getElementById("Nombre").classList.remove("is-valid");
            document.getElementById("Apellido").classList.remove("is-valid");
            document.getElementById("Edad").classList.remove("is-valid");

            document.getElementById("Nombre").classList.remove("is-invalid");
            document.getElementById("Apellido").classList.remove("is-invalid");
            document.getElementById("Edad").classList.remove("is-invalid");
            
        }

        function habilitar() {
            var input1 = document.getElementById("Nombre");
            var input2 = document.getElementById("Apellido");
            var input3 = document.getElementById("Edad");
            var input4 = document.getElementById("actualizarPerfil");
            var input5 = document.getElementById("editarPerfil");
            input1.disabled = false;
            input2.disabled = false;
            input3.disabled = false;
            input4.disabled = false;
            input5.disabled = true;
        }

        function deshabilitar() {
            var input1 = document.getElementById("Nombre");
            var input2 = document.getElementById("Apellido");
            var input3 = document.getElementById("Edad");
            var input4 = document.getElementById("actualizarPerfil");
            var input5 = document.getElementById("editarPerfil");
            input1.disabled = true;
            input2.disabled = true;
            input3.disabled = true;
            input4.disabled = true;
            input5.disabled = false;
        }

    });

</script>


</body>
</html>


