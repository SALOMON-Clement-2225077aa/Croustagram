<?php

/**
 * @return string
 * Upload l'image sur imgur et renvoie le lien de l'image upload
 * Si aucune image n'est selectionné (ou en cas d'erreur) renvoie 'no_img'
 */
function upload_img(): string
{
    // Client ID of Imgur App
    $IMGUR_CLIENT_ID = "23ad4ae172d4530";
    $client_secret = '098599a2cbc7c0c926d9d35a4a535deb19298bf4';

    // Validate form input fields
    if(empty($_FILES["myfile"]["name"])){
        return 'no_img';
    }

    else {
        // Get file info
        $fileName = basename($_FILES["myfile"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');
        if (in_array($fileType, $allowTypes)) {

            // Source image
            $image_source = file_get_contents($_FILES['myfile']['tmp_name']);
            $squaredImage = cropToSquare($image_source, 100);
            $base64ImageData = imageToBase64($squaredImage);
            $postFields = array('image' => $base64ImageData);

            // Post image to Imgur via API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);

            // Extract the link from the response
            $responseArr = json_decode($response, true);
            if (!empty($responseArr['data']['link'])) {
                $imgurLink = $responseArr['data']['link'];
                return $imgurLink;
            }
        }
    }
    return 'no_img';
}


/**
 * Prend en paramètre une image et la transforme en un carré
 * de la taille voulue en paramètre (pour les photos de profil)
 */
function cropToSquare($imageData, $size) {
    // Load the image from data
    $sourceImage = imagecreatefromstring($imageData);

    if ($sourceImage === false) {
        die('Unable to create image from data');
    }

    // Get the dimensions of the image
    $sourceWidth = imagesx($sourceImage);
    $sourceHeight = imagesy($sourceImage);

    // Calculate the crop dimensions
    $cropSize = min($sourceWidth, $sourceHeight);
    $cropX = intval(($sourceWidth - $cropSize) / 2);
    $cropY = intval(($sourceHeight - $cropSize) / 2);

    // Create a new square image
    $squareImage = imagecreatetruecolor($size, $size);

    // Copy the cropped portion to the square image
    imagecopyresampled($squareImage, $sourceImage, 0, 0, $cropX, $cropY, $size, $size, $cropSize, $cropSize);

    // Free up memory
    imagedestroy($sourceImage);

    // Return the square image
    return $squareImage;
}

/**
 * @param $imageResource
 * @return string
 * Convertit une image en format base64.
 */
function imageToBase64($imageResource): string
{
    ob_start();
    imagejpeg($imageResource);
    $imageData = ob_get_clean();
    return base64_encode($imageData);
}
