<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#Descripcion', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    language_url: "{{ asset('js/tinymce/es_MX.js') }}",
    language: 'es_MX',
    branding: false,
    menubar: false,
    statusbar: false,
    license_key: 'gpl',
    height: 300,
    setup: function (editor) {
        editor.on('keyup', function () {
        var content = editor.getContent({ format: 'text' });
        var maxChars = 800;  // Maximo de caracteres
        if (content.length > maxChars) {
            editor.setContent(content.substr(0, maxChars));
            Swal.fire({
                icon: "error",
                title: "¡Ha ocurrido una interrupción!",
                text: "No están permitidos más de " + maxChars + " caracteres.",
            });
        }
        });
    },
  });

  tinymce.init({
    selector: 'textarea#Descripcion2',
    inline: false,
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
    language_url: "{{ asset('js/tinymce/es_MX.js') }}",
    language: 'es_MX',
    branding: false,
    menubar: false,
    statusbar: false,
    license_key: 'gpl',
    height: 300,
    setup: function (editor) {
        editor.on('keyup', function () {
        var content = editor.getContent({ format: 'text' });
        var maxChars = 800;  // Maximo de caracteres
        if (content.length > maxChars) {
            editor.setContent(content.substr(0, maxChars));
            Swal.fire({
                icon: "error",
                title: "¡Ha ocurrido una interrupción!",
                text: "No están permitidos más de " + maxChars + " caracteres.",
            });
        }
        });
    },
});

</script>