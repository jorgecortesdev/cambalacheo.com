<table cellspacing="0" cellpadding="0" border="0" style="font-family:arial,sans-serif;font-size:12px;">
   <tr>
      <td valign="top" style="padding-right:15px;"><img src="{{ Gravatar::src($replay->user->email, 50) }}" style="border:0;"></td>
      <td valign="top"><strong>{{ $replay->user->name }}</strong> ha agregado una respuesta a tu oferta.
      <br><br>Te sugerimos responder a la brevedad. Para revisar la respuesta da clic <a href="{{ config('app.url') }}/articulo/{{ $replay->article->slug }}">aquí</a>.
      </td>
   </tr>
</table>

<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>