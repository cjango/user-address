<?php

namespace Jason\Address\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderScope implements Scope
{

    /**
     * 把约束加到 Eloquent 查询构造中。
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy('def', 'desc')->orderBy('id', 'desc');
    }

}
