<?php
	use Tuupola\Middleware\HttpBasicAuthentication;
	
	$app->get('/api/hello/{name}', function (Request $request, Response $response, $args) {
	    $array = [];
	    $array ["nom"] = $args ['name'];
	    $response->getBody()->write(json_encode ($array));
	    return $response;
	});

	$app->options('/api/catalogue', 'optionsCatalogue' );

	// API Nécessitant un Jwt valide
	$app->get('/api/catalogue/{filtre}', 'getSearchCalatogue' );

	// API Nécessitant un Jwt valide
	$app->get('/api/catalogue', 'getCatalogue');

	$app->options('/api/utilisateur', 'optionsUtilisateur');

	// API Nécessitant un Jwt valide
	$app->get('/api/utilisateur', 'getUtilisateur');

	// APi d'authentification générant un JWT
	$app->post('/api/utilisateur/login', 'postLogin');

	// APi d'authentification générant un JWT
	$app->post('/api/login', 'postLogin');


	// Chargement du Middleware
	$app->add(new Tuupola\Middleware\JwtAuthentication($options));