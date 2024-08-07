<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/custom/login.css', 'resources/js/custom/custom.js'])

    </head>
    <body>
        <section>
            <div class="form-box">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h2>Login</h2>
                        <div class="inputbox">
                            <ion-icon name="person-circle-sharp"></ion-icon>
                            <input type="text" name="phone" required placeholder=" ">
                            <label for="">Phone</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed"></ion-icon>
                            <input type="password" name="password" required placeholder=" ">
                            <label for="">Password</label>
                        </div>
                        <button type="submit">Login</button>

                    </form>

            </div>
        </section>


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
