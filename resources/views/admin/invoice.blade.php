<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h3>Customer Name   : {{$order->name}}          </h3>
        <h3>Customer Address: {{$order->rec_address}}   </h3>
        <h3>Customer Phone  : {{$order->phone}}         </h3>
        <h2>Product Name    : {{$order->product->name}} </h2>
        <h2>Price           : {{$order->product->price}}</h2>

    </center>
</body>
</html>