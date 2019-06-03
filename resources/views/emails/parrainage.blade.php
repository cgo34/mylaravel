<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Demande de parrainage</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Nouveau parrainage</h2>
<h3>Parrain</h3>
<ul>
    @if($parrainage['parrain']['genre'] !== '')
        <li><strong>Genre</strong> : {{ $parrainage['parrain']['genre'] }}</li>
    @endif
    <li><strong>Prénom</strong> : {{ $parrainage['parrain']['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $parrainage['parrain']['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $parrainage['parrain']['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $parrainage['parrain']['phone'] }}</li>
    @if($parrainage['parrain']['address'] !== '' && $parrainage['parrain']['zipcode'] !== '' && $parrainage['parrain']['city'] !== '' )
        <li><strong>Adresse</strong> : {{ $parrainage['parrain']['address'] }}</li>
        <li><strong>Code postal</strong> : {{ $parrainage['parrain']['zipcode'] }}</li>
        <li><strong>Ville</strong> : {{ $parrainage['parrain']['city'] }}</li>
    @endif
</ul>
<h3>Filleul</h3>
<ul>
    <li><strong>Prénom</strong> : {{ $parrainage['filleul']['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $parrainage['filleul']['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $parrainage['filleul']['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $parrainage['filleul']['phone'] }}</li>
</ul>
</body>
</html>
