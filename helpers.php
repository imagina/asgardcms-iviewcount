<?php


if(!function_exists('viewCount')){
    function viewCount($entity,$entity_id){
        $response=0;
        $model=app('Modules\Iviewcounts\Repositories\CountRepository');
        $query=$model->getByEntity($entity,$entity_id);

        if(isset($query)&&!empty($query)){
         $response=json_decode(json_encode(new \Modules\Iviewcounts\Transformer\ViewCountTransformer($query)))->value;
        }

        return $response;
    }
}