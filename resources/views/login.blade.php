<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $system->title_name }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/custom/login.css', 'resources/js/custom/login.js'])

    </head>
    <body>
        <div class="wrapper">
            <div class="title-text">
                <div class="title login {{ $tab == 'login' ? 'active' : '' }}">
                    Login Form
                </div>
                <div class="title signup {{ $tab == 'register' ? 'active' : '' }}">
                    Signup Form
                </div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" {{ $tab == 'login' ? 'checked' : '' }}>
                    <input type="radio" name="slide" id="signup" {{ $tab == 'register' ? 'checked' : '' }}>
                    <label for="login" class="slide login">Login</label>
                    <label for="signup" class="slide signup">Signup</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form method="POST" action="{{ route('login') }}" class="login {{ $tab == 'login' ? '' : 'hidden' }}">
                        @csrf
                        <div class="field">
                            <input type="text" name="phone" placeholder="Phone number" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">
                        </div>
                        <div class="signup-link">
                            Not a member? <a href="">Signup now</a>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('register') }}" class="signup {{ $tab == 'register' ? '' : 'hidden' }}">
                        @csrf
                        <div class="field">
                            <input type="text" name="name" placeholder="Full name" required>
                        </div>
                        <div class="field">
                            <input type="text" name="phone" placeholder="Phone number" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- jQuery-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @include('includes.alert')
    </body>
</html>
