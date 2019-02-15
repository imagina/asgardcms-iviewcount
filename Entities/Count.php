<?php

namespace Modules\Iviewcounts\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;

class Count extends Model
{
      use PresentableTrait, NamespacedEntity;

    protected $table = 'iviewcounts__counts';

    protected $fillable = ['entity', 'entity_id','value'];

    protected $presenter="";

}
