<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Galileo - Nouvel abonné newsletter</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Nouvel abonné Newsletter</h2>
<ul>
    <li><strong>Prénom</strong> : {{ $subscriber['firstname'] }}</li>
    <li><strong>Nom</strong> : {{ $subscriber['lastname'] }}</li>
    <li><strong>Email</strong> : {{ $subscriber['email'] }}</li>
</ul>
</body>
</html>
