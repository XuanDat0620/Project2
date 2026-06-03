<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Order:{{ $id}}</h1>
     <ul>
        <li>
            <a href="{{ route('admin.orders.list') }}">Back to order list</a>
        </li>
        
    </ul>
</body>
</html>