<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class RUimage_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->IsLoggedIn();
        $this->load->helper(array('url', 'download'));
    }

    // PROCESSING
    #==============================================================
    function ProcImage()
    {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $nameFile = $_FILES['image']['tmp_name'];
            $originalName = $_FILES['image']['name'];
            $uploadDirectory = './upload/ruimage/';
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFilename = time() . '.' . $extension;
            $newFilePath = $uploadDirectory . $newFilename;
            list($width, $height) = getimagesize($nameFile);
            move_uploaded_file($nameFile, $newFilePath);
            // if ($width <= 110 && $height <= 110) {
            //     move_uploaded_file($nameFile, $newFilePath);
            // } else {
            //     $newWidth = 110;
            //     $newHeight = 110;
            //     $image = imagecreatefromstring(file_get_contents($nameFile));
            //     $newImage = imagecreatetruecolor($newWidth, $newHeight);
            //     imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            //     imagepng($newImage, $newFilePath);
            //     imagedestroy($image);
            //     imagedestroy($newImage);
            // }
            $urlpath = 'upload/ruimage/' . $newFilename;
            $urlink = base_url() . $urlpath;
            echo $urlink;
        } else {
            echo 'Error uploading image.';
        }
    }
    function ProcImageMessage()
    {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $nameFile = $_FILES['image']['tmp_name'];
            $originalName = $_FILES['image']['name'];
            $uploadDirectory = './upload/rumessage/';
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFilename = time() . '.' . $extension;
            $newFilePath = $uploadDirectory . $newFilename;
            list($width, $height) = getimagesize($nameFile);
            move_uploaded_file($nameFile, $newFilePath);
            // if ($width <= 90 && $height <= 90) {
            //     move_uploaded_file($nameFile, $newFilePath);
            // } else {
            //     $newWidth = 90;
            //     $newHeight = 90;
            //     $image = imagecreatefromstring(file_get_contents($nameFile));
            //     $newImage = imagecreatetruecolor($newWidth, $newHeight);
            //     imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            //     imagepng($newImage, $newFilePath);
            //     imagedestroy($image);
            //     imagedestroy($newImage);
            // }
            $urlpath = 'upload/rumessage/' . $newFilename;
            $urlink = base_url() . $urlpath;
            echo $urlink;
        } else {
            echo 'Error uploading image.';
        }
    }
}
