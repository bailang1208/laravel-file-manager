<?php

namespace FeiLongCui\LaravelFileManger\Handlers;

class ConfigHandler
{
    public function userField()
    {
        return auth()->user()->id;
    }
}
