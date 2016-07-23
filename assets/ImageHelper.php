<?php

namespace c006\email\assets;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageHelper
{
    private $base_path = '';
    private $imagine;
    private $image = [];
    private $sizes = [
        'sml' => 200,
        'med' => 600,
        'lrg' => 1000,
    ];

    function __construct($base_path = FALSE)
    {
        $this->base_path = ($base_path) ? $base_path : \Yii::getAlias('@frontend') . '/web/images/email';
        $this->imagine = new Imagine();
    }


    public function saveImage($file, $tmp_file)
    {
        $this->image = [
            'image' => $tmp_file,
            'size'  => getimagesize($tmp_file)
        ];

        $size = self::getNewImageSize('lrg');
        $image = $this->imagine->open($this->image['image']);
        $image->resize(new Box($size['w'], $size['h']));
        $image->save($this->base_path . '/' . $file, ['quality' => 90]);

        // die("CHECK");
    }

    /**
     * @param $size
     * @param bool|TRUE $keep_ratio
     *
     * @return array
     */
    private function getNewImageSize($size, $keep_ratio = TRUE)
    {

        $nw = $nh = $this->sizes[ $size ];

        if ($keep_ratio) {
            /* W > H */
            if ($this->image['size'][0] > $this->image['size'][1]) {
                $ratio = $this->image['size'][1] / $this->image['size'][0];
                $nw = $nh = ($this->image['size'][0] < $nw) ? $this->image['size'][0] : $nw;
                $nh = $nw * $ratio;
                // die("W > H");
            } else {
                /* H > W */
                $ratio = $this->image['size'][0] / $this->image['size'][1];
                $nw = $nh = ($this->image['size'][1] < $nh) ? $this->image['size'][1] : $nh;
                $nw = $nh * $ratio;
                //die("H > W : ". $nh);
            }
        }

//        die($nw .' x '. $nh );

        return ['w' => $nw, 'h' => $nh];
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public function deleteFile($file)
    {
        return @unlink($this->base_path . '/' . $file);
    }


    /**
     * @param $file
     *
     * @return mixed
     */
    static public function getFileExtension($file)
    {
        $file = explode('.', $file);

        return $file[ sizeof($file) - 1 ];

    }


}