BANTUAN DESKRIPSI DAN COMMENT

<!-- UNTUK BISA KE SEMUA DOMAIN -->
<script>
    function untukUrlLink(text) {
        var urlRegex = /(<img[^>]+>|https?:\/\/[^\s]+)/g;
        return text.replace(urlRegex, function(match) {
            if (match.startsWith('<img')) {
                var srcMatch = match.match(/src="([^"]+)"/);
                return '<img src="<?= base_url() ?>' + srcMatch[1] + '" alt="Gambar">';
            } else if (match.match(/^https?:\/\/[^\s]+/)) {
                return '<a href="' + match + '" target="_blank">' + match + '</a>';
            }
        });
    }
</script>

<!-- CONTROLLER KE SEMUA DOMAIN -->
<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class s extends BaseController
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
            if ($width <= 40 && $height <= 40) {
                move_uploaded_file($nameFile, $newFilePath);
            } else {
                $newWidth = 40;
                $newHeight = 40;
                $image = imagecreatefromstring(file_get_contents($nameFile));
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagepng($newImage, $newFilePath);
                imagedestroy($image);
                imagedestroy($newImage);
            }
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
            if ($width <= 90 && $height <= 90) {
                move_uploaded_file($nameFile, $newFilePath);
            } else {
                $newWidth = 90;
                $newHeight = 90;
                $image = imagecreatefromstring(file_get_contents($nameFile));
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagepng($newImage, $newFilePath);
                imagedestroy($image);
                imagedestroy($newImage);
            }
            $urlink = 'upload/rumessage/' . $newFilename;
            echo $urlink;
        } else {
            echo 'Error uploading image.';
        }
    }
}
?>
// END CONTROLLER









// CONTROLLER SATU DOMAIN PERMANEN
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
            if ($width <= 40 && $height <= 40) {
                move_uploaded_file($nameFile, $newFilePath);
            } else {
                $newWidth = 40;
                $newHeight = 40;
                $image = imagecreatefromstring(file_get_contents($nameFile));
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagepng($newImage, $newFilePath);
                imagedestroy($image);
                imagedestroy($newImage);
            }
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
            if ($width <= 90 && $height <= 90) {
                move_uploaded_file($nameFile, $newFilePath);
            } else {
                $newWidth = 90;
                $newHeight = 90;
                $image = imagecreatefromstring(file_get_contents($nameFile));
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagepng($newImage, $newFilePath);
                imagedestroy($image);
                imagedestroy($newImage);
            }
            $urlpath = 'upload/rumessage/' . $newFilename;
            $urlink = base_url() . $urlpath;
            echo $urlink;
        } else {
            echo 'Error uploading image.';
        }
    }
}
?>
<script>
    function untukUrlLink(text) {
        var urlRegex = /(<img[^>]+>|https?:\/\/[^\s]+)/g;
        return text.replace(urlRegex, function(match) {
            if (match.startsWith('<img')) {
                return match;
            } else if (match.match(/^https?:\/\/[^\s]+/)) {
                return '<a href="' + match + '" target="_blank">' + match + '</a>';
            }
        });
    }
</script>
// END CONTROLLER SATU DOMAIN PERMANEN