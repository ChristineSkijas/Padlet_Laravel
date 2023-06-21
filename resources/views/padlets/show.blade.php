<!DOCTYPE html>
<html>
<head>

    <title>Laravel</title>

</head>
<body>

<h1>Detailansicht Padlets</h1>
<ul>
    <h1>{{$padlet->id}}</h1>
    <p>{{$padlet->name}}</p>
    <p>{{$padlet->user_id}}</p>
</ul>

<!-- Zurück zu den Padlets-Button -->
<a href="../padlets/">Zurück zu den Padlets</a>
</body>
</html>
