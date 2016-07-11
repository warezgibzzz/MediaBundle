<?php

namespace Creonit\MediaBundle\Model;

use Creonit\MediaBundle\Model\Base\Video as BaseVideo;

/**
 * Skeleton subclass for representing a row from the 'video' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Video extends BaseVideo
{

    public function getCode($width = null, $height = null){
        if($this->getUrl()){
            if(!$width && $height){
                $width = $height * 1.587301587301587;
            }
            if(!$height && $width){
                $height = $width * 0.63;
            }
            /*
            if(!$width){
                $width = $this->getWidth();
            }
            if(!$height){
                $height = $this->getHeight();
            }
            */

            if(preg_match('/(?:\?v=([\w\d]+)|.be\/([\w\d]+))/i', $this->getUrl(), $match)){
                $src = 'http://www.youtube.com/embed/' . ($match[1] ? $match[1] : $match[2]);
            }else{
                $src = '';
            }
            return "<iframe width=\"{$width}\" height=\"{$height}\" src=\"{$src}\" frameborder=\"0\" allowfullscreen></iframe>";
        }
    }

    public function getPreviewTag($width = null, $height = null, $type = 0){
        return '<img src="'.$this->getPreviewUrl($type).'" style="'.($width ? 'width: '.$width.'px;' : '').' '.($height ? 'width: '.$height.'px;' : '').'">';
    }

    public function getPreviewUrl($type = 0){
        if(preg_match('/(?:\?v=([\w\d]+)|.be\/([\w\d]+))/i', $this->getUrl(), $match)){
            return 'http://img.youtube.com/vi/'.($match[1] ? $match[1] : $match[2]).'/'.$type.'.jpg';
        }else{
            return '';
        }
    }
    
}
