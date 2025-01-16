<?php

interface IImage {
    public function display();
}

class RealImage implements IImage {
    private $fileName;
    public $imageResource;

    public function __construct($fileName) {
        $this->fileName = $fileName;
        $this->loadFromDisk($fileName);
    }
  

    private function loadFromDisk($fileName) {
        // echo "Loading image from disk...\n";
        if (!file_exists($fileName)) {
            throw new Exception("File not found: " . $fileName);
        }

        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        echo "file name is ".$fileName;
        switch ($fileExtension) {
            case 'jpg':
            case 'jpeg':
                // echo "Loading image from " . $fileName . "\n";
                $this->imageResource = imagecreatefromjpeg($fileName);
                break;
            case 'png':
                $this->imageResource = imagecreatefrompng($fileName);
                break;
            case 'gif':
                $this->imageResource = imagecreatefromgif($fileName);
                break;
            default:
                throw new Exception("Unsupported image format: " . $fileExtension);
        }

        echo "Image successfully loaded from " . $fileName . "\n";
    }

    public function display() {
        if ($this->imageResource) {
            header("Content-Type: image/jpeg"); // Adjust header based on image type if necessary
            imagejpeg($this->imageResource); // Output the image
            imagedestroy($this->imageResource); // Free memory
            $this->imageResource = null; // Avoid reuse
        } else {
            echo "No image resource to display.\n";
        }
    }

    public function destroyObject() {
        if ($this->imageResource) {
            imagedestroy($this->imageResource);
        }
        unset($this->fileName);
        echo "RealImage object destroyed.\n";
    }
}

class ProxyImage implements IImage {
    private $realImage;
    private $fileName;

    public function __construct($fileName) {
        
        $this->fileName = $fileName;
    }

    public function display() {
        if (!$this->realImage) {
            $this->realImage = new RealImage($this->fileName);
        }

        // Save image to a temporary location
        $tempFileName = 'temp_image.jpg'; // You can use a dynamic name based on a unique ID
        imagejpeg($this->realImage->imageResource, $tempFileName);
        imagedestroy($this->realImage->imageResource); // Clean up memory
        $this->realImage->imageResource = null; // Avoid reuse

        return $tempFileName;
    }
}


?>
