<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Prise de contact</h2>
<p>Réception d'une prise de contact avec les éléments suivants :</p>
<ul>
    <li><strong>programme</strong> : {{ $contact['programme_name'] }} (#{{ $contact['programme_id'] }})</li>
    <li><strong>Lot</strong> : {{ $contact['lot_number'] }} (#{{ $contact['lot_id'] }})</li>
</ul>
<ul>
    <li><strong>Prénom</strong> : {{ $contact['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $contact['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $contact['email'] }}</li>
    <li><strong>Téléphone</strong> : {{ $contact['phone'] }}</li>
    <li><strong>Adresse</strong> : {{ $contact['address'] }}</li>
    <li><strong>Code postal</strong> : {{ $contact['zipcode'] }}</li>
    <li><strong>Ville</strong> : {{ $contact['city'] }}</li>
    <li><strong>Message</strong> : {{ $contact['message'] }}</li>
</ul>
</body>
</html>