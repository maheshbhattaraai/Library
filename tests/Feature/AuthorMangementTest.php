<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorMangementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_author_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->post('/authors', [
            'name' => 'Mahesh',
            'dob' => '2020/10/12',
        ]);
        $authors = Author::all();
        $this->assertEquals(1, $authors->count());
        $this->assertInstanceOf(Carbon::class, $authors->first()->dob);
        $this->assertEquals('12/10/2020', $authors->first()->dob->format('d/m/Y'));
    }
}
