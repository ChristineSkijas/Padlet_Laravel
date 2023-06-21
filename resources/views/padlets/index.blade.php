<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>
<body>
<h1>Übersicht der Padlets</h1>

<ul>
    @foreach ($padlets as $padlet)
        <li><a href="padlets/{{$padlet->id}}">
                {{$padlet->name}}</a></li>
    @endforeach
</ul>
</body>
</html>
