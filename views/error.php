<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
 
    <div class="error-container">
        <h1>Error <?= $statusCode ?></h1>
        <h3><?= $errorMessage ?></h3>
 
        <a href="<?= $homeUrl ?>" class="btn">Home</a>
    </div>
 
</body>
 
</html>