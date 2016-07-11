<?php

namespace Creonit\MediaBundle\Model;

use Creonit\MediaBundle\Model\Base\Gallery as BaseGallery;

/**
 * Skeleton subclass for representing a row from the 'gallery' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Gallery extends BaseGallery
{

    protected $cover;

    public function getCover(){
        if($this->cover) return $this->cover;
        $this->cover = ImageQuery::create()
            ->useGalleryItemQuery()
            ->filterByGalleryId($this->id)
            ->orderBySortableRank()
            ->endUse()
            ->findOne();

        return $this->cover;
    }

    public function getList(){

        return GalleryItemQuery::create()
            ->filterByGalleryId($this->id)
            ->orderBySortableRank()
            ->find();
    }

}
