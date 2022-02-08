<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konu Oluştur</title>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #0a034c;
        }

        .iskelet {
            margin: 1em;
            padding: 1em;
        }

        #form-input {
            margin-top: 2rem;
            text-align: center;
            width: min-content;
            height: min-content;
            margin-left: auto;
            margin-right: auto;
            background-color: rgba(221, 221, 221, 0.6);
            border-radius: 1em;
        }

        #form-ozet {
            background-color: rgba(221, 221, 221, 0.6);
            border-radius: 1em;
            margin-top: 2rem;
            text-align: center;
            width: min-content;
            height: min-content;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            padding: 0.5rem;
            border-radius: 0.5em;
            border-color: black;
            margin: 0.1rem;
        }
    </style>
</head>

<body>
    <div id="form-input">
        <?php
        if(isset($_SESSION['titlename'])){
           unset($_SESSION['titlename']); 
        }
        ?>
        <form action="title2.php" method="post">
            <table class="iskelet">
                <tr>
                    <td colspan="2">
                        <h3>Konu Başlığı giriniz</h3>
                    </td>
                </tr>
                <tr>
                    <td>Konu Başlığı*</td>
                    <td><input type="text" placeholder="Başlığı girin" required name="title"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="gönder" class="btn"><input type="reset" value="temizle" class="btn"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>