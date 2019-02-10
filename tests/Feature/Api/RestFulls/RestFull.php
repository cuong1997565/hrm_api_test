<?php

namespace Tests\Feature\Api\RestFulls;

use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class RestFull extends TestCase {
    use DatabaseMigrations;

    /**
     * url endpoint
    */
    protected $endpoint;

    /**
     * model class
     * @var string
    */
    protected $model;
    /**
    * table
    * @var string
    */
    protected $table;

    /**
     * data transform
     * @var array
     */
    protected $transform;

    /**
     * create data for test by model factory & initDataNumber
     * @date   2018-10-16
     * @return [type]     [description]
    */
    protected function geretateTestData(){
        factory($this->model, $this->initDataNumber)->create();
    }

    public function setUp(){
        dd(1);
        parent::setUp();
        $this->geretateTestData();
    }

    /**
     * Listting api with pagination
     * should return 200
    */
    // public function testListting(){
    //     $params = [
    //         'limit' => 10
    //     ];
    //     $this->json('GET', $this->endpoint . '?' . http_build_query($params), [], $this->headers)
    //          ->seeStatusCode(200)
    //          ->seeJsonStructure([
    //             'name',
    //             'status',
    //             'data'  =>  [$this->transform],
    //             'meta'  => [
    //                     'pagination'
    //             ]
    //         ]);
    //     $this->assertCount(10, $this->response->getData()->data);
    // }



}