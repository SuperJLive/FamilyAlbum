<?php

namespace App\Media;

interface MediaHandlerInterface
{
    public function __construct(string $sourceFilePath);

    //only compress,do not change media size;
    public function compress():void;

}
