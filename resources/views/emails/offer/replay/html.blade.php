<p>
En horabuena! {{ $offer->parent->user->name }}, han contestado a tu oferta!
</p>

<ul>
    <li>Cambalache: {{ $offer->article->title }}</li>
    <li>Te lo envia: {{ $offer->user->name }}</li>
</ul>