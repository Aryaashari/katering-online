<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background-color: #F5F5F5;
        }

        .box {
            width: 700px;
            background-color: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0px 6px 14px 0px #413D661A;
        }

        .box h1 {
            font-weight: bold;
        }

        @media (max-width: 767.98px) {
            .box {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-12">
                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="box m-auto">
                        <h1 class="text-center">Daftar</h1>
                        <div class="form-group mb-4">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Nama" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>No Telp / WA</label>
                            <input type="number" class="form-control @error('telp') is-invalid @enderror"
                                id="telp" name="telp" placeholder="Nomor telepon/WA"
                                value="{{ old('telp') }}">
                            @error('telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label>Konfirmasi Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="Konfirmasi Password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="hero__btn d-flex justify-content-center mb-2" data-animation="fadeInLeft"
                            data-delay=".8s" data-duration="2000ms">
                            <button type="submit" class="btn hero-btn d-block w-100">Daftar</button>
                        </div>

                        <p class="text-center">Sudah punya akun? <span><a href="{{ url('/login') }}"
                                    style="color: #ED3237">Masuk</a></span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
