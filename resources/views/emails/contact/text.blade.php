Has recibido un *nuevo* mensaje de la forma de contacto de tu sitio.


Aquí los detalles.

    - Nombre: *{{ $name }}* @if($registered) (REGISTRADO) @endif
    - Correo: {{ $email }}
    - Registrado: {{ $registered }}

El mensaje:

@foreach ($umessage as $line)
{{ $line }}
@endforeach


Saludos!
{{ config('app.url') }}


------------------------------
The master of puppets!