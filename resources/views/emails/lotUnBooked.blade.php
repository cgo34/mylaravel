<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Un lot n'est plus réservé</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Un lot réservé est à nouveau disponible</h2>
<ul>
    <li><strong>Lot</strong> : {{ $lotUnBooked['lot']['numero'] }} (#{{ $lotUnBooked['lot']['id'] }})</li>
</ul>
<h3>Utilisateur</h3>
<ul>
    <li><strong>Civilité</strong> : {{ $lotUnBooked['user']['genre'] }}</li>
    <li><strong>Prénom</strong> : {{ $lotUnBooked['user']['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $lotUnBooked['user']['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $lotUnBooked['user']['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $lotUnBooked['user']['phone'] }}</li>
    <li><strong>Adresse</strong> : {{ $lotUnBooked['user']['address'] }}</li>
    <li><strong>Code postal</strong> : {{ $lotUnBooked['user']['zipcode'] }}</li>
    <li><strong>Ville</strong> : {{ $lotUnBooked['user']['city'] }}</li>
</ul>
</body>
</html>
