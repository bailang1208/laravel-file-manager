<?php

namespace FeiLongCui\LaravelFileManger\Controllers;

use Intervention\Image\Facades\Image;
use FeiLongCui\LaravelFileManger\Events\ImageIsResizing;
use FeiLongCui\LaravelFileManger\Events\ImageWasResized;

class ResizeController extends LfmController
{
    /**
     * Dipsplay image for resizing.
     *
     * @return mixed
     */
    public function getResize()
    {
        $ratio = 1.0;
        $image = request('img');

        $original_image = Image::make($this->lfm->setName($image)->path('absolute'));
        $original_width = $original_image->width();
        $original_height = $original_image->height();

        $scaled = false;

        // FIXME size should be configurable
        if ($original_width > 600) {
            $ratio = 600 / $original_width;
            $width = $original_width * $ratio;
            $height = $original_height * $ratio;
            $scaled = true;
        } else {
            $width = $original_width;
            $height = $original_height;
        }

        if ($height > 400) {
            $ratio = 400 / $original_height;
            $width = $original_width * $ratio;
            $height = $original_height * $ratio;
            $scaled = true;
        }

        return view('laravel-filemanager::resize')
            ->with('img', $this->lfm->pretty($image))
            ->with('height', number_format($height, 0))
            ->with('width', $width)
            ->with('original_height', $original_height)
            ->with('original_width', $original_width)
            ->with('scaled', $scaled)
            ->with('ratio', $ratio);
    }

    public function performResize()
    {
        $dataX = request('dataX');
        $dataY = request('dataY');
        $height = request('dataHeight');
        $width = request('dataWidth');
        $image_path = $this->lfm->setName(request('img'))->path('absolute');

        event(new ImageIsResizing($image_path));
        Image::make($image_path)->resize($width, $height)->save();
        event(new ImageWasResized($image_path));

        return parent::$success_response;
    }
}