<?php

namespace Modules\Iviewcounts\Repositories\Cache;

use Modules\Iviewcounts\Repositories\CountRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCountDecorator extends BaseCacheDecorator implements CountRepository
{
    public function __construct(CountRepository $count)
    {
        parent::__construct();
        $this->entityName = 'iviewcounts.counts';
        $this->repository = $count;
    }
}
