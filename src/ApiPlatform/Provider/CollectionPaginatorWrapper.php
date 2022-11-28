<?php

namespace App\ApiPlatform\Provider;

use ApiPlatform\Doctrine\Orm\AbstractPaginator;
use ApiPlatform\Doctrine\Orm\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class CollectionPaginatorWrapper extends AbstractPaginator
{
    public function __construct(
        Paginator $paginator,
        private readonly \Closure $callback,
        private readonly object $callbackNewThis
    ) {
        parent::__construct(new DoctrinePaginator($paginator->getQuery()));
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->paginator->getIterator() as $item) {
            yield $this->callback->call($this->callbackNewThis, $item);
        }
    }
}
