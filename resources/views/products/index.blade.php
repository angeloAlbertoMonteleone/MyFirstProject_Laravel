<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

    <div>
      @if(!session()->has('cart') || session()->get('cart', collect())->isEmpty())
        <h2>The cart is empty</h2>
      @else
        <p>Your Cart contains {{ session()->get('cart')->sum('quantity') }} products </p>
      @endif

      @if (session()->has('message'))
        <p style="color:green">{{ session()->get('message') }}</p>
      @endif
    </div>
    
    <div style="max-width: 1000px; margin: auto">
      <table class="table table-dark">

        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Availability</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($products as $key => $product)
            <tr>
              <th scope="row">{{ $product['uuid'] }}</th>
              <td>{{ $product['name'] }}</td>
              <td>{{ $product['description'] }}</td>
              <td>{{ $product['price'] }}</td>
              {{-- <td>
                @if ()
                  <span style="color:green">Disponibile</span>
                @else
                  <span style="color:red">Non Disponibile</span>
                @endif
              </td> --}}

              <td>
                <a class="btn btn-primary btn-sm" href={{ route('products.show', ['product' => $product['uuid']]) }}>SEE PRODUCT</a><br>

                <form method="post" id="{{ $product['uuid']. '-delete' }}" action="{{ route('products.destroy', ['product' => $product['uuid']]) }}" >
                  @method('delete')
                  @csrf

                  <a class="btn btn-danger btn-sm" href="#" onclick="document.getElementById('{{$product['uuid'].'-delete'}}').submit()">DELETE PRODUCT</a>
                </form>

                <form method="post" id="{{ $product['uuid']. '-cart' }}" action="{{ route('cart.addToCart', ['product' => $product['uuid']]) }}" >
                  @csrf
                  <input type="hidden" name="product" value="{{ $product['uuid'] }}">
                  <a class="btn btn-primary btn-sm" href="#" onclick="document.getElementById('{{$product['uuid'].'-cart'}}').submit()">ADD PRODUCT</a>
                </form>
              </td>
            </tr>
          @endforeach
        </div>

      </tbody>

    </table>

    <div class="">
        <p>If you want create a product <a href={{  route('products.create')  }} class="btn-success mt-2 p-3">Click here!</a> </p>
    </div>


  </body>
</html>
