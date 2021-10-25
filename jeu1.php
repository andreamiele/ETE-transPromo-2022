<?php
$all_images = glob("/img/Jeu1/NoSourires/{*.jpg, *.JPG, *.JPEG, *.png, *.PNG}", GLOB_BRACE);
$image_Souri = glob("/img/Jeu1/Sourires/{*.jpg, *.JPG, *.JPEG, *.png, *.PNG}", GLOB_BRACE);



// shuffle($all_images); // Pour randomiser, décommenter la ligne
// shuffle($image_Souri); // Pareil

$imagesN = array(); // Images sans sourire
$imagesS = array(); // Image sourire

foreach ($all_images as $index => $image) {
    if ($index == 35) break;  // On ne prends que 35 images qui ne sourient pas
    $image_name = basename($image);
    array_push($imagesN,( "<img src='/img/Jeu1/NoSourires/{$image_name}' />"));
}

$imagesS = $image_Souri[1]


?>



<script type="text/javascript">
    var jArray= <?php echo json_encode($imagesN); ?>;
</script>

<script type="text/javascript">
    var jArray2= <?php echo json_encode($imagesS); ?>;
</script>





<script type="text/javascript" src="main.js" >


