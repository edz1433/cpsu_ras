<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('create') }}" method="POST">
        @csrf
        <input type="text" name="column1">
        <input type="text" name="column2">
        <button type="submit"></button>
    </form>
<table>
    @foreach ($samples as $sample)
    <tr>
        <th>{{ $sample->column1 }}</th>
        <th>{{ $sample->column2 }}</th>
    </tr>
    @endforeach
</table>
</body>
</html>