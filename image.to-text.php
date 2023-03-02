<?php
if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    $imageFileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sadece JPG, JPEG ve PNG dosyaları yüklenebilir.";
    } else {
        $temp_name = $_FILES["file"]["tmp_name"];
        $img_info = getimagesize($temp_name);
        if ($img_info === false) {
            echo "Yüklenen dosya bir resim değil.";
        } else {
            $img = imagecreatefromstring(file_get_contents($temp_name));
            $text_color = imagecolorallocate($img, 255, 255, 255);
            $font_size = 20;
            $text = "Örnek Metin";
            $font_path = "path/to/your/font.ttf"; // Kullanacağınız fontun dosya yolu
            imagettftext($img, $font_size, 0, 10, 50, $text_color, $font_path, $text);
            header("Content-type: image/jpeg"); // Çıktı tipini belirleyin
            imagejpeg($img);
            imagedestroy($img);
        }
    }
} else {
    echo "Dosya yüklenirken bir hata oluştu.";
}
?>
