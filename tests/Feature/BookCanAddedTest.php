<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookCanAddedTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response  = $this->post('/books', [
            'title' => "Demo",
            'author' => "Victor",
        ]);
        $response->assertOk();
        $this->assertEquals(1, Book::count());
    }
    /** @test */
    public function a_title_is_required()
    {
        $this->withExceptionHandling();
        $response  = $this->post('/books', [
            'title' => "",
            'author' => "Victor",
        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $this->withExceptionHandling();
        $response  = $this->post('/books', [
            'title' => "Demo",
            'author' => "",
        ]);
        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => "Demo",
            'author' => "dsdsdf",
        ]);
        $book = Book::first();
        $response  = $this->patch('/books/' . $book->id, [
            'title' => 'Updated',
            'author' => "Update Author",
        ]);
        $response->assertOk();
        $this->assertEquals('Updated', Book::find(1)->title);
        $this->assertEquals('Update Author', Book::find(1)->author);
    }

    /** @test */
    public function a_book_can_delete()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => "Demo",
            'author' => "dsdsdf",
        ]);
        $book = Book::first();
        $response = $this->delete('/books/' . $book->id);
        $response->assertOk();
        $this->assertEquals(0, Book::count());
    }
    /** @test */
    public function a_book_delete_not_found()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => "Demo",
            'author' => "dsdsdf",
        ]);
        $book = Book::first();
        $response = $this->delete('/books/' . $book->id);
        $response->assertOk();
        $newResponse = $this->delete('/books/' . $book->id);
        $newResponse->assertNotFound();
    }
}
