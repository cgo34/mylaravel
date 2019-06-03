<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Demande d'option</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Nouvel demande d'option</h2>
<ul>
    <li><strong>Lot</strong> : {{ $optionRequests['lot']['numero'] }} (#{{ $optionRequests['lot']['id'] }})</li>
</ul>
<ul>
    <li><strong>Civilité</strong> : {{ $optionRequests['user']['genre'] }}</li>
    <li><strong>Prénom</strong> : {{ $optionRequests['user']['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $optionRequests['user']['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $optionRequests['user']['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $optionRequests['user']['phone'] }}</li>
    <li><strong>Adresse</strong> : {{ $optionRequests['user']['address'] }}</li>
    <li><strong>Code postal</strong> : {{ $optionRequests['user']['zipcode'] }}</li>
    <li><strong>Ville</strong> : {{ $optionRequests['user']['city'] }}</li>
</ul>
</body>
</html>
