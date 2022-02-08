<?php
session_start();
if(isset($_GET['konu'])){
    unset($_SESSION['titlename']);
   $_SESSION['konu']=$_GET['konu'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cevap Yaz</title>
    
        
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
            width: 650px;
            align-items: center;
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
        textarea{
            resize: none;
        }


    </style>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
</head>

<body>
    
    <div id="form-input">
        <form action="topic2.php" method="post">
            <table class="iskelet">
                <tr>
                    <td>
                        <h3>Konu İçeriği giriniz</h3>
                    </td>
                </tr>
                <tr>
                    <td><textarea name="topic" id="myTextarea" style="width: 300px;" require></textarea></td>
                
                </tr>
                <tr>
                    <td><input type="submit" value="gönder" class="btn"><input type="reset" value="temizle" class="btn"></td>
                </tr>
            </table>
        </form>
        
    </div>
<script>
            CKEDITOR.replace( 'topic' );
</script>
</body>

</html>