Has recibido un *nuevo* mensaje de la forma de contacto de tu sitio.


Aquí los detalles.

    - Nombre: *{{ $name }}*
    - Correo: {{ $email }}

El mensaje:

@foreach ($umessage as $line)
{{ $line }}
@endforeach


Saludos!
{{ config('app.url') }}


------------------------------
The master of puppets!