<?php
/**
 * Created by PhpStorm.
 * User: Fahre
 * Date: 23.01.2018
 * Time: 15:15
 */
namespace App\Components;
class ImgResizer
{
    /**
     * @param $src
     * @param $dst
     * @param $width
     * @param $height
     * @return bool|string
     */
    public static function imageResize($src, $dst, $width, $height)
    {
        if (!list($w, $h) = getimagesize($src)){
            return "Unsupported picture type!";
        }
        $type = strtolower(substr(strrchr($src,"."),1));
        if ($type == 'jpeg') {
            $type = 'jpg';
        }
        switch($type){
            case 'gif': $img = imagecreatefromgif($src); break;
            case 'jpg': $img = imagecreatefromjpeg($src); break;
            case 'png': $img = imagecreatefrompng($src); break;
            default : return "Unsupported picture type!";
        }

        if ($w < $width and $h < $height){
            return "Picture is too small!";
        }
        $ratio = min($width/$w, $height/$h);
        $width = $w * $ratio;
        $height = $h * $ratio;
        $x = 0;

        $new = imagecreatetruecolor($width, $height);
        // preserve transparency
        if($type == "gif" || $type == "png"){
            imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }
        imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
        switch($type){
            case 'bmp': imagewbmp($new, $dst); break;
            case 'gif': imagegif($new, $dst); break;
            case 'jpg': imagejpeg($new, $dst); break;
            case 'png': imagepng($new, $dst); break;
        }
        return true;
    }
}