<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $content }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 3vh;
            background-color: rgb(33, 33, 33);
            color: #ddd;
            font-family: 'Courier New', Courier, monospace;
            height: 100%;
            width: 100%;
            user-select: none;
            -moz-user-select: none;
        }

        div {
            margin-top: 41vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div>
        <p style="text-align: -webkit-center;">
            {{ $content }}

            <?php if (isset($message)) : ?>
                <br><br>
                {{ $message }}
            <?php endif; ?>

        </p>
    </div>
</body>

</html>