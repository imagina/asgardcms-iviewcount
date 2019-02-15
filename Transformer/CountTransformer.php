<?php

namespace Modules\Iviewcounts\Transformer;

use Illuminate\Http\Resources\Json\Resource;

class CountTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [

            'id' => $this->when($this->id, $this->id),
            'entity' => $this->when($this->entity, $this->entity),
            'entity_id' => $this->when($this->entity_id, $this->entity_id),
            'value' => $this->when($this->value, $this->value),
            'updated_at' => $this->when($this->updated_at, $this->updated_at),

        ];

        return $data;

    }
}