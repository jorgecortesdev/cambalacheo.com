<p>
En horabuena! {{ $offer->article->user->name }}, has recibido una oferta!
</p>

<ul>
    <li>Cambalache: {{ $offer->article->title }}</li>
    <li>Te lo envia: {{ $offer->user->name }}</li>
</ul>