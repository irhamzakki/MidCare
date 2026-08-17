<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\PasienController;
use Illuminate\View\View;
use Tests\TestCase;

class PasienControllerTest extends TestCase
{
    public function test_admin_can_view_pasien_index(): void
    {
        $controller = new PasienController();

        $response = $controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('Admin.Pasien.Pasien', $response->getName());
        $this->assertArrayHasKey('pasiens', $response->getData());
    }
}
