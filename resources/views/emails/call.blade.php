<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Demande de rappel</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Être rappelé</h2>
<p>Réception d'une demande de rappel avec les éléments suivants :</p>
<ul>
    <li><strong>programme</strong> : {{ $call['programmename'] }} (#{{ $call['programmeid'] }})</li>
    <li><strong>Lot</strong> : {{ $call['lotnumero'] }} (#{{ $call['lotid'] }})</li>
</ul>
<ul>
    <li><strong>Civilité</strong> : {{ $call['genre'] }}</li>
    <li><strong>Prénom</strong> : {{ $call['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $call['lastname'] }}</li>
    <li><strong>Téléphone</strong> : {{ $call['phone'] }}</li>
    <li><strong>Adresse</strong> : {{ $call['address'] }}</li>
    <li><strong>Code postal</strong> : {{ $call['zipcode'] }}</li>
    <li><strong>Ville</strong> : {{ $call['city'] }}</li>
</ul>
</body>
</html>
