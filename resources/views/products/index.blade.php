<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

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
            <td>
              @if ($product['available'])
                <span style="color:green">Disponibile</span>
              @else
                <span style="color:red">Non Disponibile</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>

    <form class="" action={{ route('products.create') }} method="get">
      <button class="btn-success mt-2 p-3" type="submit" name="button">Create a new product</button>
    </form>

  </body>
</html>
