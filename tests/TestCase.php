<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function returnresults() {
        $this->visit('/samandar')
            ->see('Laravel 5')
            ->dontSee('Rails');
    }
}
