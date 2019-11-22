<?php

namespace ISBase\Util;

class Imagem {

    public static function convertImage($originalImage, $outputImage, $quality) {
        $exploded = explode('.', $originalImage);
        $ext = $exploded[count($exploded) - 1];
        if (preg_match('/jpg|jpeg/i', $ext)) {
            $imageTmp = imagecreatefromjpeg($originalImage);
        } else if (preg_match('/png/i', $ext)) {
            $imageTmp = imagecreatefrompng($originalImage);
        } else if (preg_match('/gif/i', $ext)) {
            $imageTmp = imagecreatefromgif($originalImage);
        } else if (preg_match('/bmp/i', $ext)) {
            $imageTmp = imagecreatefromwbmp($originalImage);
        } else {
            return false;
        }

        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        if ($originalImage !== $outputImage) {
            @unlink($originalImage);
        }

        return true;
    }

    public static function base64ToImage($base64_string, $output_file) {
        $file = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $output_file;
    }

}
