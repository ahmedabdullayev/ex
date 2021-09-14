<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
    public function testCategories()
    {
        $this->get('/categories');

        $this->assertEquals(200, $this->response->status()
        );
    }
    public function testPostCategory(){
        $this->post('/category', ['name'=>'TestingCategory']);

        $this->assertResponseStatus(200);
    }
    public function testPost(){
        $this->post('/post/create', ['content'=>'Lorem Lorem Lorem Lorem', 'category_id'=>'1']);

        $this->assertResponseStatus(200);
    }

}
