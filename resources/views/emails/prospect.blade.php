<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Dénonce d'un prospect</h2>
<p>Réception d'une dénonce d'un prospect par un professionnel :</p>
<ul>
    <li><strong>programme</strong> : {{ $prospect['client']['programme_name'] }} (#{{ $prospect['client']['programme_id'] }})</li>
    <li><strong>Lot</strong> : {{ $prospect['client']['lot_number'] }} (#{{ $prospect['client']['lot_id'] }})</li>
</ul>
<ul>
    <li><strong>Id professionnel</strong> : {{ $prospect['pro']['id'] }}</li>
    <li><strong>Nom professionnel</strong> : {{ $prospect['pro']['firstname'] }}</li>
    <li><strong>Nom professionnel</strong> : {{ $prospect['pro']['lastname'] }}</li>
    <li><strong>Téléphone professionnel</strong> : {{ $prospect['pro']['phone'] }}</li>
    <li><strong>Email professionnel</strong> : {{ $prospect['pro']['email'] }}</li>
</ul>
<ul>
    <li><strong>Prénom prospect</strong> : {{ $prospect['client']['firstname'] }}</li>
    <li><strong>Nom prospect</strong> : {{ $prospect['client']['lastname'] }}</li>
    <li><strong>Email prospect</strong> : {{ $prospect['client']['email'] }}</li>
    <li><strong>Téléphone prospect</strong> : {{ $prospect['client']['phone'] }}</li>
    <li><strong>Adresse prospect</strong> : {{ $prospect['client']['address'] }}</li>
    <li><strong>Code postal prospect</strong> : {{ $prospect['client']['zipcode'] }}</li>
    <li><strong>Ville prospect</strong> : {{ $prospect['client']['city'] }}</li>
</ul>
</body>
</html>