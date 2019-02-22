<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w4</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>

</head>
<body>
    <h1>recaptcha</h1>
    <form id="frm" action="res.php" method="post">
        <input type="text" name="n" placeholder="Name..">
        <br><br>
        <div class="g-recaptcha" data-sitekey="..."></div>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>