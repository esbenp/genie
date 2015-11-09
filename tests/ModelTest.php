<?php

use Mockery as m;
use Optimus\Database\Eloquent\Model;

class ModelTest extends TestCase
{

    public function testScopeWhereArray()
    {
        $model = new Model();
        $query = m::mock('\Illuminate\Database\Eloquent\QueryBuilder');
        $query->shouldReceive('where')->times(2);

        $model->scopeWhereArray($query, [
            'key1' => 'value1',
            'key2' => 'value2'
        ]);
    }
}
