<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Nouveau lot réservé</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Nouveau lot réservé</h2>
<ul>
    <li><strong>Lot</strong> : {{ $lotBooked['lot']['numero'] }} (#{{ $lotBooked['lot']['id'] }})</li>
</ul>
<ul>
    <li><strong>Civilité</strong> : {{ $lotBooked['user']['genre'] }}</li>
    <li><strong>Prénom</strong> : {{ $lotBooked['user']['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $lotBooked['user']['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $lotBooked['user']['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $lotBooked['user']['phone'] }}</li>
    <li><strong>Adresse</strong> : {{ $lotBooked['user']['address'] }}</li>
    <li><strong>Code postal</strong> : {{ $lotBooked['user']['zipcode'] }}</li>
    <li><strong>Ville</strong> : {{ $lotBooked['user']['city'] }}</li>
</ul>
</body>
</html>
