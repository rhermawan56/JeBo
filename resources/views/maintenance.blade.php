<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maintenance</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>
        body {
            width: 100%;
            height: 100vh;
        }

        .container {
            height: 100vh;
        }

        p {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 50%;
        }

        a {
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="container my-0 position-relative">
        <p class="my-0 position-absolute fs-2 text-secondary">sorry, the system is under maintenance</p>
        <a href="/dashboard/transaction" class="position-absolute btn btn-secondary text-light border-1 fs-9"><i data-feather="arrow-left-circle" style="width: 1rem;"></i> Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>
