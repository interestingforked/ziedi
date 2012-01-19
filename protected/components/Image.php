<?php

class Image {

    public static function thumb($image, $width = false, $height = false, $zs = true) {
        $thumbUrl = Yii::app()->params['thumbUrl'];
        $thumbUrl .= '?src=' . $image;
        if ($width)
            $thumbUrl .= '&w=' . $width;
        if ($height)
            $thumbUrl .= '&h=' . $height;
        if ($zs)
            $thumbUrl .= '&zc=0';
        return $thumbUrl;
    }

}