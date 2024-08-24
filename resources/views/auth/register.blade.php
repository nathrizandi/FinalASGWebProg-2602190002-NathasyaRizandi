<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-sm" style="width: 100%; max-width: 1000px;">
        <div class="card-body">
            <div class="mb-4 mt-3" style="display: flex; align-items: center; justify-content: center">
                <h1 class="card-title text-center" style="font-weight: bold; margin: 0;">Register</h1>
                <img src="/assets/logo.png" style="width: 5vw; margin-left: 10px;">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Input Your Name" value="{{ old('name') }}"
                        required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Input your email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Input your password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="instagram_username" class="form-label">Instagram Username</label>
                    <input type="text" id="instagram_username" name="instagram_username" class="form-control" placeholder="Input your Instagram Username" value="{{ old('instagram_username') }}" required>
                </div>

                <div class="mb-3">
                    <label for="hobbies_field" class="form-label">Hobby</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="hobbies_field[]" value="Sports">
                        <label class="form-check-label">Sports</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="hobbies_field[]" value="Photography">
                        <label class="form-check-label">Photography</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="hobbies_field[]" value="Culinary">
                        <label class="form-check-label">Culinary</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="hobbies_field[]" value="Otomotive">
                        <label class="form-check-label">Otomotive</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="hobbies_field[]" value="Music">
                        <label class="form-check-label">Music</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Input your mobile number" value="{{ old('mobile_number') }}" required>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-outline-primary">Register</button>
                </div>
            </form>
            <div class="mt-3" style="display: flex; align-items: center; justify-content: center">
                <p style="margin: 0;">Already Have an Account?</p>
                <a href="/login" style="text-decoration: none; margin-left: 5px;">Login Here</a>
            </div>    
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
