<?php

use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer as BaseSerializer;
use Pbmedia\Serializers\FractalIlluminatePaginatorTrait;

class DataArraySerializer extends BaseSerializer
{
    use FractalIlluminatePaginatorTrait;
}

class FractalIlluminatePaginatorTest extends PHPUnit_Framework_TestCase
{
    public function testSerializerWithTrait()
    {
        $items = ['item1', 'item2', 'item3', 'item4', 'item5'];

        $collection = new LengthAwarePaginator(array_slice($items, 0, 2), count($items), 2);
        $paginator  = new IlluminatePaginatorAdapter($collection);

        $manager = new Manager;
        $manager->setSerializer(new DataArraySerializer);

        $resource = new Collection($collection, function ($item) {
            return $item;
        });

        $resource->setPaginator($paginator);

        $result = $manager->createData($resource)->toArray();

        $this->assertEquals([
            'total'         => 5,
            'per_page'      => 2,
            'current_page'  => 1,
            'last_page'     => 3,
            'next_page_url' => '/?page=2',
            'prev_page_url' => null,
            'from'          => 1,
            'to'            => 2,
        ], $result['meta']['pagination']);

    }
}
