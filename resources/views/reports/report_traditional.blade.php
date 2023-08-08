@php use Illuminate\Support\Carbon; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio diário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .p-2 {
            padding: 2em;
        }
        table thead {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container indigo accent-1">
    <div class="center">
        <h5>Relatorio de vendas do Hamburguer Tradicional</h5>
        <p>Total de vendas: {{ "R$ " . number_format($data["totalSales"], 2, ',', '.') }}</p>
    </div>
    <br>
    <table class="striped">
        <thead>
        <tr>
            <td class="">ID da venda</td>
            <td>Valor pago</td>
            <td>ID do pedido</td>
            <td>Data da venda</td>
        </tr>
        </thead>
        <tbody>
        @foreach($data["salesBurgerTradicional"] as $sale)
            <tr>
                <td>{{ $sale["id"] }}</td>
                <td>{{ "R$ " . number_format($sale["price"], 2, ',', '.') }}</td>
                <td>{{ $sale["order_id"] }}</td>
                <td>{{ Carbon::parse($sale["created_at"])->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
