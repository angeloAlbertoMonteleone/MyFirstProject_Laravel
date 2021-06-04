<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>
  <body style="max-width: 1000px; margin: auto;">
    <div class="">
      {{ json_encode($product) }}

    <div class="mt-5">
      <strong>#</strong>
      <span>{{ $product['uuid'] }}</span>
    </div>

    <div class="mt-2">
      <strong>Name</strong>
      <span>{{ $product['name'] }}</span>
    </div>

    <div class="mt-2">
      <strong>Description</strong>
      <span>{{ $product['description'] }}</span>
    </div>

    <div class="mt-2">
      <strong>Price</strong>
      <span>{{ $product['price'] }}</span>
    </div>

    <div class="mt-2">
      <strong>Availability</strong>
      @if ($product['available'])
        <span style="color:green">Available</span>
      @else
        <span style="color:red">Not Available</span>
      @endif
    </div>

<br>
    <div class="">
        <a class="btn btn-primary mt-4" href="{{ route('products.edit', ['product' => $product['uuid']]) }}">Modify Product</a>
    </div>

    <div class="">
      <p>If you wanna go back to the main page, <a class="btn btn-danger mt-4 btn-xs" href={{ route('products.index') }}>Click here!</a></p>
    </div>
    </div>
  </body>
</html>
