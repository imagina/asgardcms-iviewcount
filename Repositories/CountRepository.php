<?php

namespace Modules\Iviewcounts\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface CountRepository extends BaseRepository
{

    /**
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false);

    /**
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false);

    /**
     * @param $entity
     * @param $entity_id
     * @return mixed
     */
    public function getByEntity($entity, $entity_id);
}
