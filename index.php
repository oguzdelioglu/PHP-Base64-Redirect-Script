<?
if(isset($_SERVER['REQUEST_URI']) AND $_SERVER['REQUEST_URI'] != "/" AND validBase64(substr($_SERVER['REQUEST_URI'],1)))
{
$url = base64_decode(substr($_SERVER['REQUEST_URI'],1));
header('Location: '.$url, true, 302);
}

function validBase64($string)
{
    $decoded = base64_decode($string, true);

    // Check if there is no invalid character in string
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

    // Decode the string in strict mode and send the response
    if (!base64_decode($string, true)) return false;

    // Encode and compare it to original one
    if (base64_encode($decoded) != $string) return false;

    return true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shortener URL</title>
    <style>
        body {
            background: #2a7cd3;
            font-family: 'Arial';
            text-align: center;
        }

        ::-moz-selection {
            color: #fff;
            background: black;
        }

        ::selection {
            color: #fff;
            background: black;
        }

        * {
            box-sizing: border-box;
        }

        p {
            color: #fff;
        }

        p a {
            color: rgba(255, 255, 255, 0.5);
        }

        form {
            position: relative;
            margin: 200px auto 50px auto;
            width: 550px;
            height: 80px;
        }

        input {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            border: 0;
            border-radius: 4px;
            background: #065cb7;
            outline: 0;
            padding: 2em 1em 1em 1em;
            color: #fff;
            font-size: 1em;
            transition: background 0.35s ease-out;
        }

        input::-webkit-input-placeholder {
            color: #fff;
            text-transform: capitalize;
        }

        input:-moz-placeholder {
            color: #fff;
            text-transform: capitalize;
        }

        input::-moz-placeholder {
            color: #fff;
            text-transform: capitalize;
        }

        input:-ms-input-placeholder {
            color: #fff;
            text-transform: capitalize;
        }

        input:focus {
            background: #044f9e;
        }

        input:focus+label {
            -webkit-transform: translateY(-10px) scale(0.8);
            transform: translateY(-10px) scale(0.8);
            color: #6da6df;
        }

        input:focus+label+button {
            opacity: 1;
        }

        label {
            position: absolute;
            left: 1em;
            top: 50%;
            margin-top: -8px;
            color: #fff;
            text-transform: capitalize;
            -webkit-transform-origin: left center;
            transform-origin: left center;
            transition: color 0.25s ease-out, -webkit-transform 0.25s ease-out;
            transition: transform 0.25s ease-out, color 0.25s ease-out;
            transition: transform 0.25s ease-out, color 0.25s ease-out, -webkit-transform 0.25s ease-out;
        }

        button {
            position: absolute;
            right: 0;
            width: 120px;
            height: 100%;
            border: 0;
            border-radius: 4px;
            font-size: 1em;
            background: #065cb7;
            color: #044f9e;
            cursor: pointer;
            opacity: 0;
            outline: none;
            transition: opacity 0.35s ease-out, width 0.5s ease-out, background 0.25s ease-out;
        }

        button.is-active {
            background: #5c94cd;
            color: #fff;
        }

        input:focus~button {
            color: #fff;
        }

        button.is-done {
            width: 100%;
            opacity: 1;
        }

        h2 {
            color: #fff;
            word-break: break-all;
        }
    </style>
</head>

<body>
    <form>
        <input type="url" id="url" />
        <label for="url">URL Adress</label>
    </form>
    <h2 id="url_show"></h2>
    <script>
        var url = document.getElementById('url'),
            url_show = document.getElementById('url_show');
        url.addEventListener('change', function() {
            url_show.innerHTML = window.location.href + encodeURI(btoa(document.getElementById('url').value));
        });
    </script>
    <!-- tech by oguzdelioglu.com -->
</body>
</html>