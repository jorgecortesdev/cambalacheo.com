<table cellspacing="0" cellpadding="0" border="0" style="font-family:arial,sans-serif;font-size:12px;">
   <tr>
      <td valign="top" style="padding-right:15px;"><img src="{{ Gravatar::src($question->user->email, 50) }}" style="border:0;"></td>
      <td valign="top"><strong>{{ $question->user->name }}</strong> ha agregado una pregunta sobre uno de tus cambalaches.
      <br><br>Te sugerimos responder a la brevedad. Para revisar la pregunta da clic <a href="{{ config('app.url') }}/panel/questions#received">aquí</a>.
      </td>
   </tr>
</table>

<br>
<p style="margin:1em 0">Saludos!</p>
<p style="margin:1em 0"><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>