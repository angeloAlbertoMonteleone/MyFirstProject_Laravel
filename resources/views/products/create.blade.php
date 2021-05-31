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
      @csrf

      {{-- <div class="form-group">
        <label for="exampleFormControlInput1">UUID</label>
        <input name="uuid" class="form-control" id="exampleFormControlInput1" placeholder="enter the product uuid">
      </div> --}}

      <div class="form-group">
        <label for="exampleFormControlInput1">Name</label>
        <input name="name" value={{ old('name') }} class="form-control" id="exampleFormControlInput1" placeholder="enter the product name">
      </div>

      @error ('name')
          <p style="color:red">{{ $message }}</p>
      @enderror

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" value={{ old('description') }} class="form-control" id="exampleFormControlTextarea1" placeholder="enter the product description"></textarea>
      </div>

      @error ('description')
          <p style="color:red">{{ $message }}</p>
      @enderror

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Price</label>
        <input name="price" value={{ old('price') }} class="form-control" type="number" step="0.01" min="0" id="exampleFormControlTextarea1" placeholder="enter the product price"></input>
      </div>

      @error ('price')
          <p style="color:red">{{ $message }}</p>
      @enderror

      <div class="form-group">
        <label for="exampleFormControlSelect1">Availability</label>
        <input type="checkbox" name="available" value="1"{{ old('available', false) ? 'checked' : ''}}>
      </div>

      @error ('available')
          <p style="color:red">{{ $message }}</p>
      @enderror

      <button class="btn btn-primary" type="submit" name="button">SEND</button>

    </form>
  </body>
</html>
