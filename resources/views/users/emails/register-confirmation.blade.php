<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mx-auto mt-3">
        <div class="card w-100 border-0" >
            <div class="card-header" id="custom-header">
                <h4>Hello! {{ $name }} Thank you for registering.</h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col text-muted">
                        Yor Email: <span class="fw-bold">{{$email}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-muted ">
                        Yor user name:  <span class="fw-bold">{{ $name }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p>To start, please access the website <a href="{{ $app_url }}"><i class="fa-brands fa-instagram"></i></a></p>
                <p>Thank you!</p>
            </div>
        </div>
    </div>
   
   
   
   
</body>
</html>