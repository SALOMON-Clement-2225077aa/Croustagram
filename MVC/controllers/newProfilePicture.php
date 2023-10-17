
<?php
    function uploadPfp(){
        return '
<form action="../models/uploadProfilePicture.php" method="post"">
    Select image to upload:
    <input required type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Upload Image" name="submit">
</form>
';
}
?>