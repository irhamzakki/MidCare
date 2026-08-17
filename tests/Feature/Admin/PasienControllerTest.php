<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\PasienController;
use Tests\TestCase;

class PasienControllerTest extends TestCase
{
    public function test_controller_exposes_index_action(): void
    {
        $this->assertTrue(method_exists(PasienController::class, 'index'));
    }
}
