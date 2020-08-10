<?php
namespace App;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;
class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        return 'user-'.auth()->user()->id.'/'.$media->id.'/';
    }
    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'conversion/';
    }
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'/responsive/';
    }
}