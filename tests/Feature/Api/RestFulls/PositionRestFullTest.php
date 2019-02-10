<?php

namespace Tests\Feature\Api\RestFulls;

class PositionRestFullTest
{

  protected $endpoint       = '/api/positions';
  protected $model          = \App\Repositories\Positions\Position::class;
  protected $table          = 'positions';
  protected $transform      =   [
        'id',
        'name',
        'status',
        'created_at'
  ];

    public function setUp(){
        parent::setUp();
        $this->geretateTestData();
    }

  protected function geretateTestData(){
        $this->assertTrue(true);
     parent::geretateTestData();
  }


}