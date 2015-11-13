<p style="margin:1em 0">Has recibido un <strong>nuevo</strong> mensaje de la forma de contacto de tu sitio.</p>

<p style="margin:1em 0">Aquí los detalles.</p>

<ul>
    <li>Nombre: <strong>{{ $name }}</strong> @if($registered) <strong>(REGISTRADO)</strong> @endif</li>
    <li>Correo: <strong>{{ $email }}</strong></li>
</ul>

<p style="margin:1em 0">El mensaje:</p>

<p style="margin:1em 0">
    <div style="background: #eee; padding: 20px;">
        @foreach ($umessage as $line)
        {{ $line }}<br>
        @endforeach
    </div>
</p>
<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
<br>
<hr>
The master of puppets!