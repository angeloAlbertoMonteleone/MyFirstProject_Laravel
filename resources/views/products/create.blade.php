<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body style="max-width: 1000px; margin: auto">
    <h1>Creation Form</h1>

    <p>{{ json_encode($products) }}</p>


    {{-- method="get" action="{{ route('products.store') }} --}}
    <form method="get" action="{{ route('products.store') }}">
      <div class="form-group">
        <label for="exampleFormControlInput1">UUID</label>
        <input name="uuid" class="form-control" id="exampleFormControlInput1" placeholder="enter the product uuid">
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input name="name" class="form-control" id="exampleFormControlInput1" placeholder="enter the product name">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" placeholder="enter the product description"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Price</label>
        <input name="price" class="form-control" id="exampleFormControlTextarea1" placeholder="enter the product price"></input>
      </div>


      <div class="form-group">
        <label for="exampleFormControlSelect1">Availability</label>
        <select name="availability" class="form-control" id="exampleFormControlSelect1">
          <option value=false selected>0</option>
          <option value=true>1</option>
        </select>
      </div>


      <button class="btn btn-primary" type="submit" name="button">SEND</button>

    </form>
  </body>
</html>
