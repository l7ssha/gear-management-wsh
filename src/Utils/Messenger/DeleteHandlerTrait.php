<?php

namespace App\Utils\Messenger;

trait DeleteHandlerTrait
{
    protected function isDeleteAction(): bool
    {
        return true;
    }
}
