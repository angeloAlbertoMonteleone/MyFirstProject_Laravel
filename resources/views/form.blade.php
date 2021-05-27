<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Exercises</title>
  </head>
  <body style="max-width: 900px; margin:auto;">

    @if (session()->has('success-message'))
      <p style="color:green">{{ session()->get('success-message') }}</p>
    @endif

    @foreach(session()->all() as $key => $value)
      <div class="">
        <h5>{{$key}}</h5>
        <p>{{json_encode($value, JSON_PRETTY_PRINT)}}</p>

      </div>
    @endforeach

    <h1>Form</h1>

    <form method="post" action="{{ route('session.flash') }}" >
      <div class="form-group">
        @csrf
        <label for="username">Username</label>
        <input name="username" type="Username" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter email">

        @error('username')
        <p style="color:red;">{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">

        @error('password')
        <p style="color:red;">{{$message}}</p>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <form method="post" action={{ route('session.forget') }} >
      <button type="delete" name="button">ELIMINA</button>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
