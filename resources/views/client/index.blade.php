<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased"> 
            
        <div class="container py-4">
            <h1>Форма для заповнення</h1>
 
            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/store">

                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Імя</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Єл. пошта</label>
                    <input type="text"  value="{{ old('email') }}" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <label for="password_repeat" class="form-label">Пароль знову</label>
                    <input type="password" name="password_repeat" class="form-control" id="password_repeat" placeholder="Password" required>
                </div>

                <button class="btn btn-primary" type="submit">Засабмітити</button>

            </form>

            <form name="delete" method="POST" action="/destroy">
                @csrf
                <button onclick="retrn confirm('Бажаєте видалити всі дані')" class="btn mt-4 btn-danger" type="submit">Видалити дані</button>
            </form>


            <table class="table mt-4 table-dark">
                <thead>
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Єл. почта</th>
                   
                    </tr>
                </thead>
                <tbody>
                @foreach ($clients as $key=>$client)
                    <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $client[0] }}</td>
                    <td>{{ $client[1] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

           
                
           

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
