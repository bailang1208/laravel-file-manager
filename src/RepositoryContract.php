<?php

namespace FeiLongCui\LaravelFileManger;

interface RepositoryContract
{
    public function rootPath();

    public function move($new_lfm_path);

    public function save($file);
}
