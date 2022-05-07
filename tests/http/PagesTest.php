<?php

namespace CodeIgniter;

use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;

class FooTest extends CIUnitTestCase
{
    use DatabaseTestTrait, FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testPage()
    {
        $values = [
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ];

        $filesize = filesize('./tests/http/init.pdf');
        $fp = fopen('./tests/http/init.pdf', 'rb');
        $binary = fread($fp, $filesize);

        $this->withSession($values);
        // default
        $this->get('/')->assertOK();
        $this->get('/profile')->assertOK();
        // index
        $this->get('/book')->assertOK();
        $this->get('/ebook')->assertOK();
        $this->get('/borrow-book')->assertOK();
        $this->get('/user')->assertOK();
        // datatable
        $this->get('/book/json')->assertOK();
        $this->get('/ebook/json')->assertOK();
        $this->get('/borrow-book/json')->assertOK();
        $this->get('/user/json')->assertOK();
        // add
        $this->post('/book', [
            'name' => 'test 1',
            'description' => 'this description',
            'name_publisher' => 'james',
            'year_publisher' => '2021',
            'author' => 'ferdiansyah',
        ])->assertOK();
        $this->post('/borrow-book', [
            'book_id' => '1',
            'start' => date("Y-m-d H:i:s"),
            'end' => date("Y-m-d H:i:s")
        ])->assertOK();
        $this->post('/user', [
            'username' => 'ferdiansyah',
            'email' => 'ferdi@gmail.com',
            'password' => 'people-test',
            'role' => 'admin'
        ])->assertOK();

        $this->post('/ebook', [
            'title' => 'hello world',
            'file' => $binary
        ])->assertOK();


        // update
        $this->post('/book', [
            'id' => '1',
            'name' => 'test 1',
            'description' => 'this description update',
            'name_publisher' => 'james',
            'year_publisher' => '2021',
            'author' => 'ferdiansyah',
        ])->assertOK();
        $this->post('/borrow-book', [
            'id' => '1',
            'book_id' => '1',
            'start' => date("Y-m-d H:i:s"),
            'end' => date("Y-m-d H:i:s")
        ])->assertOK();
        $this->post('/user', [
            'id' => '3',
            'username' => 'ferdiansyah',
            'email' => 'ferdi@gmail.com',
            'password' => 'people-tested',
            'role' => 'admin'
        ])->assertOK();
        $this->post('/ebook', [
            'id' => '1',
            'title' => 'hello world 1',
            'file' => $binary
        ])->assertOK();

        fclose($fp);
    }
}
