<?php

function ImageAddWatermark($im, $stamp, $small_stamp, $opacity, $percentage, $degree, $smallOpacity, $small_percentage, $smallPosition, $horizontal_distance, $vertical_distance, $onLeft = 0, $onTop = 0, $margin = 0)
{
    list($width, $height) = getimagesize(($im));
    list($small_width, $small_height) = getimagesize(($small_stamp));
    $old = $im;
    $im = imagecreatefromjpeg($im);
    $stamp = imagecreatefrompng($stamp);
    $small_stamp = imagecreatefrompng($small_stamp);

    $stamp = imagescale($stamp, $width * (0.01 * (100 - $percentage)));
    $small_stamp = imagescale($small_stamp, $width * (0.01 * ($small_percentage)));
    $transColor = imagecolorallocatealpha($stamp, 255, 255, 255, 127);
    $stamp = imagerotate($stamp, ((360 - $degree) % 360), $transColor);

    if ($onLeft) {
        $orgX = $margin;
    } else {
        $orgX = imagesx($im) - $margin - imagesx($stamp);
    }

    if ($onTop) {
        $orgY = $margin;
    } else {
        $orgY = imagesy($im) - $margin - imagesy($stamp);
    }

    $imageWidth = imagesx($im);
    $imageHeight = imagesy($im);

    $logoWidth = imagesx($stamp);
    $logoHeight = imagesy($stamp);
    $cut = imagecreatetruecolor(imagesx($stamp), imagesy($stamp));
    imagecopy($cut, $im, 0, 0, ($imageWidth - $logoWidth) / 2, ($imageHeight - $logoHeight) / 2, imagesx($stamp), imagesy($stamp));
    imagecopy($cut, $stamp, 0, 0, 0, 0, imagesx($stamp), imagesy($stamp));

    imagecopymerge($im, $cut, ($imageWidth - $logoWidth) / 2, ($imageHeight - $logoHeight) / 2, 0, 0, imagesx($stamp), imagesy($stamp), $opacity);
    if ($smallPosition == 'top-right'){
      $cut = imagecreatetruecolor(imagesx($small_stamp), imagesy($small_stamp));
      imagecopy($cut, $im, 0, 0, $width - ($small_percentage * 0.01 * $width) - ($horizontal_distance * 0.01 * $width), ($vertical_distance * 0.01 * $height), imagesx($stamp), imagesy($stamp));
      imagecopy($cut, $small_stamp, 0, 0, 0, 0, imagesx($small_stamp), imagesy($small_stamp));
      imagecopymerge($im, $cut, $width - ($small_percentage * 0.01 * $width) - ($horizontal_distance * 0.01 * $width), ($vertical_distance * 0.01 * $height), 0, 0, imagesx($small_stamp), imagesy($small_stamp), $smallOpacity);
    }elseif ($smallPosition == 'top-left'){
      $cut = imagecreatetruecolor(imagesx($small_stamp), imagesy($small_stamp));
        imagecopy($cut, $im, 0, 0, ($horizontal_distance * 0.01 * $width), ($vertical_distance * 0.01 * $height), imagesx($stamp), imagesy($stamp));
        imagecopy($cut, $small_stamp, 0, 0, 0, 0, imagesx($small_stamp), imagesy($small_stamp));
        imagecopymerge($im, $cut, ($horizontal_distance * 0.01 * $width), ($vertical_distance * 0.01 * $height), 0, 0, imagesx($small_stamp), imagesy($small_stamp), $smallOpacity);
    }elseif ($smallPosition == 'bottom-left'){
      $cut = imagecreatetruecolor(imagesx($small_stamp), imagesy($small_stamp));
      imagecopy($cut, $im, 0, 0, ($horizontal_distance * 0.01 * $width), $height - (($small_height / $small_width) * (0.01 * $small_percentage * $width)) - ($vertical_distance * 0.01 * $height), imagesx($small_stamp), imagesy($small_stamp));
      imagecopy($cut, $small_stamp, 0, 0, 0, 0, imagesx($small_stamp), imagesy($small_stamp));
      imagecopymerge($im, $cut, ($horizontal_distance * 0.01 * $width), $height - (($small_height / $small_width) * (0.01 * $small_percentage * $width)) - ($vertical_distance * 0.01 * $height), 0, 0, imagesx($small_stamp), imagesy($small_stamp), $smallOpacity);
    }elseif ($smallPosition == 'bottom-right'){
      $cut = imagecreatetruecolor(imagesx($small_stamp), imagesy($small_stamp));
      imagecopy($cut, $im, 0, 0, $width - ($small_percentage * 0.01 * $width) - ($horizontal_distance * 0.01 * $width), $height - (($small_height / $small_width) * (0.01 * $small_percentage * $width)) - ($vertical_distance * 0.01 * $height), imagesx($stamp), imagesy($stamp));
      imagecopy($cut, $small_stamp, 0, 0, 0, 0, imagesx($small_stamp), imagesy($small_stamp));
      imagecopymerge($im, $cut, $width - ($small_percentage * 0.01 * $width) - ($horizontal_distance * 0.01 * $width), $height - (($small_height / $small_width) * (0.01 * $small_percentage * $width)) - ($vertical_distance * 0.01 * $height), 0, 0, imagesx($small_stamp), imagesy($small_stamp), $smallOpacity);
    }
    imagejpeg($im, $old, 100);
}
