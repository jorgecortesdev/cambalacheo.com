<?php
return [
	'conditions' => [
		['id' => 1, 'name' => 'Nuevo', 'slug' => 'nuevo'],
		['id' => 2, 'name' => 'Usado', 'slug' => 'usado'],
		['id' => 3, 'name' => 'Renovado', 'slug' => 'renovado']
	],
	'status_article' => [
		1 => 'Recibiendo ofertas',
		2 => 'Permutado',
		3 => 'Clausurado',
		4 => 'Cerrado',
	],
	'status_question' => [
		1 => 'Abierta',
		2 => 'Oculta',
		3 => 'Borrada',
	],
	'status_offer' => [
		1 => 'Abierta',
		2 => 'Aceptada',
		3 => 'Rechazada',
	],
	'main_article_list_limit' => 10,
];