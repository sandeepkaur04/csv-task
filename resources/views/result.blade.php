<!DOCTYPE html>
<html>
<head>
<title>Output</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    div .tbldiv {
        background: #b9bfb9;
        margin-top:2px;
        padding:5px;
    }
    .anc {
        margin-top:2px;
    }
    .coldiv {
        margin-top:2px;
        min-width: 100px;
    }
    </style>
</head>
<body>

<div class="container">
  <h2>Output:</h2>        
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Customer Details</th>
        <th>Order Header</th>
        <th width="420px">Order Items (Products)</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            $p = 0;
        ?>
        @foreach($result as $key => $value)
        <?php
            $i += 1;
        ?>
        <tr>
            <td>{{ $i }}</td>
            <td>
                <p>
                    <span> <label>School URN: </label> {{ $value->school_URN }} </span>  <br>
                    <span> <label>Organization Name: </label>  {{ $value->organization_name }}</span>  <br>
                    <span> <label>Organization Telephone: </label> {{ $value->organization_telephone }} </span>  <br>
                    <span> <label>Organization Email: </label> {{ $value->organization_email }} </span>  <br>
                    <span> <label>Organization URL: </label> <a href="{{ $value->organization_url }}" target="_blank">{{ $value->organization_url }} </a></span>
                </p>
            </td>
            <td>
                <span> <label>Order ID: </label> {{ $value->order_id }} </span>  <br>
                <span> <label>Order Total: </label> {{ $value->order_total }} </span>  <br>
                <span> <label>Order Date: </label> {{ $value->order->date }} </span>  <br>
                <span> <label>Order Contact Name: </label> {{ $value->order->contact_name }} </span>  <br>
                <span> <label>Order Email: </label> {{ $value->order->email_address }} </span>  <br>
                <span> <label>Order Telephone: </label> {{ $value->order->telephone }} </span>  <br>
                <span> <label>Delivery Address: </label> {{ $value->delivery_address->address_1 }}, {{ $value->delivery_address->address_2 }}, 
                {{ $value->delivery_address->address_3 }} {{ $value->delivery_address->town }} ,{{ $value->delivery_address->county }} {{ $value->delivery_address->postcode }}</span>  <br>
            </td>
            <td id="ordtd">
                @foreach($value->product as $key2 => $product)
                <?php
                    $p += 1;
                ?>
                <a class="btn btn-primary anc" data-toggle="collapse" href="#collapseExample{{$p}}" role="button" aria-expanded="false" aria-controls="collapseExample">
    Product {{$key2+1}}
  </a> <br>
                <div class="tbldiv collapse coldiv" id="collapseExample{{$p}}">
                <div class="card card-body">
                        <span> <label>Product Name: </label> </span> {{ $product->name }}  <br>
                        <span> <label>Product Style Reference: </label>  {{ $product->colour_style_ref }} </span>  <br>
                        <span> <label>Product Color: </label> </span> {{ $product->colour_name }}  <br>
                        <span> <label>Product Size: </label> </span> {{ $product->size_name }}  <br>
                        <span> <label>Product Color Image URL: </label> <a href="{{ $product->colour_image_url }}" target="_blank">{{ $product->colour_image_url }} </a> </span>  <br>
                        <span> <label>Product EAN: </label> {{ $product->ean }} </span>  <br>
                        <span> <label>Product Price: </label> {{ $product->price }} </span>  <br>
                        <span> <label>Product Quantity: </label> {{ $product->quantity }} </span>  <br>
                        <span> <label>Product Line Price: </label> {{ $product->line_price }} </span>  <br>
</div>
                </div>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>


</body>
</html>


