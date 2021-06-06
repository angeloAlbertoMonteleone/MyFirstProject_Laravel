<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>

    <div class="">
     @if(!session()->has('cart') || session()->get('cart', collect())->isEmpty())
        <h2>The cart is empty</h2>
      @else
        <table>
          <th></th>
        </table>
      @endif

    </div>

  </body>
</html>
