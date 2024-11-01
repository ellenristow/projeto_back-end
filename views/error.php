<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= isset($statusCode) ? htmlspecialchars($statusCode) : 'Unknown' ?></title>
</head>
<body>
    <div class="error-container">
        <h1>Error <?= isset($statusCode) ? htmlspecialchars($statusCode) : 'Unknown' ?></h1>
        <h3><?= isset($errorMessage) ? htmlspecialchars($errorMessage) : 'An unexpected error occurred.' ?></h3>
 
        <a href="<?= isset($home) ? htmlspecialchars($home) : '/' ?>" class="btn">Home</a>
    </div>
 
</body>
</html>