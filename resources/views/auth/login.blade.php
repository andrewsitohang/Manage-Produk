<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .main-container {
            display: flex;
            min-height: 100vh;
        }
        .login-section {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            background-color: #fff;
            padding: 20px;
        }
        .image-section {
            display: none;
            flex: 1;
            background-image: url("{{ asset('img/ilustrasi.jpg') }}"); /* Placeholder for your image */
            justify-content: center;
            align-items: center;
        }
        .image-section img {
            max-width: 100%;
            height: auto;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
        }
        .image-section .custom-graphic {
            position: relative;
            display: flex;
            justify-content: center;
        }
        .image-section .custom-graphic::after {
            content: "";
            background-image: url("{{ asset('img/ilustrasi.jpg') }}"); /* Placeholder for your image */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .form-control,.input-group-text{
            color: #dee2e6;
            border-radius: 0px !important;
        }   
        .form-control::placeholder{
            color: #dee2e6;
        }     
        .form-control:focus{
            box-shadow: none !important;
            border-color: #dee2e6
        }
        #show-password{
            cursor: pointer;
        }
        @media (min-width: 992px) {
            .image-section {
                display: flex;
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="login-section">
            <div class="form-container text-center">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <img src="{{ asset('img/bag.png') }}" alt="bag" style="width: 28px;height: 28px;object-fit: cover;">
                    <h4 class="mb-0 fw-bold">SIMS Web App</h4>
                </div>
                <h3 class="mt-4 mb-5 fw-bold">Masuk atau buat akun untuk memulai</h3>
                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @session('success')
                        <div class="alert alert-success">{{ $message }}</div>
                    @endsession
                    <div class="input-group mb-4">
                        <span style="border-right: none;" class="input-group-text bg-white" id="basic-addon1">@</span>
                        <input style="border-left: none;" type="email" required class="form-control" placeholder="masukan email anda" aria-label="masukan email anda" aria-describedby="basic-addon1" name="email">
                    </div>
                    <div class="input-group mb-5">
                        <span style="border-right: none;" class="input-group-text bg-white"><i class="fa-solid fa-lock"></i></span>
                        <input style="border-right: none;border-left: none;" required placeholder="masukan password anda" id="input-password" type="password" class="form-control" name="password">
                        <span style="border-left: none;" class="input-group-text bg-white" data-hide="true" id="show-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Masuk</button>
                </form>
            </div>
        </div>
        <div class="image-section">
            <div class="custom-graphic"></div> <!-- This is for the custom image -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#show-password").click(() => {
                let hide = $("#show-password").attr('data-hide')
                console.log(hide);
                if (hide === "true") {
                    $("#input-password").attr("type","text");
                    $("#show-password").attr("data-hide","false");
                    $("#show-password").html('<i class="fa-solid fa-eye-slash"></i>');                    
                }else{
                    $("#input-password").attr("type","password");
                    $("#show-password").attr("data-hide","true");
                    $("#show-password").html('<i class="fa-solid fa-eye"></i>');                    
                }
            })
        })
    </script>
</body>
</html>
