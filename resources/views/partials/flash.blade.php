@if (session()->has('flash_message'))
    <script type="text/javascript">
        swal({
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.message') }}",
            type: "{{ session('flash_message.level') }}",
            animation: "slide-from-top",
            timer: 1800,
            html: true,
            showConfirmButton: false
        });
    </script>
@endif

@if (session()->has('flash_message_overlay'))
    <script type="text/javascript">
        swal({
            title: "{{ session('flash_message_overlay.title') }}",
            text: "{{ session('flash_message_overlay.message') }}",
            type: "{{ session('flash_message_overlay.level') }}",
            html: true,
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif