<?php
    include "hoa.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <h1 class="text-center">Danh sách các loài hoa</h1>
    </div>
    <div class="container mx-auto" >
        <div class="container" style="width: 65%;margin-top:70px">
            <?php foreach ($flower as $flower): ?>
                <div class="card" style="width: 100%;">
                    <img src="<?= $flower['image']; ?>" class="card-img-top" alt="Card image">
                    <p class="card-text"><?= $flower['description']; ?></p>
                    <div class="container" style="width:100%; margin-top:50px"></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    
</body>
</html>