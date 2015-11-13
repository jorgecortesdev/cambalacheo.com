En horabuena! *{{ $offer_owner->name }}*, han aceptado tu oferta!

Aquí los detales:
 - Cambalache: {{ $article->title }}
 - Descripción: {{ $article->description }}
 - Propietario: {{ $article->user->name }}
 - Correo: {{ $article->user->email }}

Ponte en contacto con el propietario para finalizar el cambalache. Te sugerimos contactarlo a la brevedad.


Saludos!
{{ config('app.url') }}
