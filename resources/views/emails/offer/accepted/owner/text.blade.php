En horabuena! *{{ $article_owner->name }}*, han aceptado tu oferta!

Aquí los detales:
 - Cambalache: {{ $article->title }}
 - Descripción: {{ $article->description }}
 - Te ofertó: {{ $offer_owner->name }}
 - Su correo: {{ $offer_owner->email }}

Ponte en contacto con el para finalizar el cambalache. Te sugerimos contactarlo a la brevedad.


Saludos!
{{ config('app.url') }}
