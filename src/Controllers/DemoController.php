<?php

namespace FeiLongCui\LaravelFileManager\Controllers;

/**
 * Class DemoController.
 */
class DemoController extends LfmController
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('laravel-file-manager::demo');
    }
}
