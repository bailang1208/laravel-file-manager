<?php

namespace FeiLongCui\LaravelFileManager\Handlers;

class ConfigHandler
{
    public function userField()
    {
        return auth()->user()->id;
    }
}
