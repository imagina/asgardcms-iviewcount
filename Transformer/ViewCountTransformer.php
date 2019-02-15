<?php

namespace Modules\Iviewcounts\Transformer;

use Illuminate\Http\Resources\Json\Resource;

class ViewCountTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [
            'value' => $this->when($this->value, $this->value),
        ];

        return $data;

    }
}