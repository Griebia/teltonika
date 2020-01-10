
<!DOCTYPE html>
<html>
<head>
    <title>Countries&Cities</title>
    <link href="/public/css/style.css" rel="stylesheet">
    <script src="/public/js/javascript.js"></script> 
</head>
<body>
    <!-- Header -->
<header>
    <div onclick="location.href='/public/countries/'" class="header">
        <h1 class="font">Countries&Cities</h1>
    </div>
</header>



<?php  
    require_once('../app/init.php');
    $app = new App;
?>
</body>
</html> 