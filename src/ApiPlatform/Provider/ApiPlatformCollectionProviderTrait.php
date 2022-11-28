<?php

namespace App\ApiPlatform\Provider;

use ApiPlatform\Doctrine\Orm\AbstractPaginator;
use ApiPlatform\Doctrine\Orm\Paginator;

trait ApiPlatformCollectionProviderTrait
{
    protected function getCollectionProvider(Paginator $paginator, \Closure $callback): AbstractPaginator
    {
        return new CollectionPaginatorWrapper($paginator, $callback, $this);
    }
}
