<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect to . . .</title>
    <style>
        html, body{
            margin: 0px;
            width: 100%;
            height: 100%;
        }
        p {
            margin: 0px;
            position: relative;
            top: 45%;
            text-align: center;
            font-size: 60px;
            background-color: rgba(100%,100%,100%,0.6);
        }
        .content{
            width: 100%;
            height: 100%;
            background-color: #1d68cd;
        }
    </style>
    <script>
        var counter = 5;

        var interval = setInterval(function() {
            counter--;
            span = document.getElementById('counter');
            span.innerHTML = counter;

            if (counter <= 0) {
                span.innerHTML = "Redirect to <?php echo $data['url'];?>";
                window.location.replace("<?php echo $data['url'] ?>");
            }
        }, 1000);
    </script>
</head>
<body>
<div class="content" style="background-image:
    <?php echo 'url(data:image/png;base64,'.base64_encode( $data['wallpaper'] ).')';?>">
    <p id="counter">5</p>
</div>
</body>
</html>