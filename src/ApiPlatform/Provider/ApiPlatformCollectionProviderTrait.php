<?php

namespace App\ApiPlatform\Provider;

use ApiPlatform\Doctrine\Orm\AbstractPaginator;
use ApiPlatform\Doctrine\Orm\Paginator;
use Closure;

trait ApiPlatformCollectionProviderTrait
{
    protected function getCollectionProvider(Paginator $paginator, Closure $callback): AbstractPaginator
    {
        return new CollectionPaginatorWrapper($paginator, $callback, $this);
    }
}
