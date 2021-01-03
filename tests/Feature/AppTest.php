<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testShowAllAppsSuccessfully()
    {
        $response = $this->json('GET','api/apps');
        $response->assertStatus(200);
    }
    public function testShowCertainAppWithCommentsSuccessfully()
    {
        $response = $this->json('GET','api/app/2');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'app' => [
                   'id',
                   'name',
                   'category',
                   'rating',
                   'reviews',
                   'size',
                   'installs',
                   'type',
                   'price',
                   'content_range',
                   'genres',
                   'last_update',
                   'current_version',
                   'android_version',
                   'created_at',
                   'updated_at'
                ] ,
                'comments'
            ])
            ->assertJsonCount(13,'comments');
    }
    public function testShowAllCategoriesSuccessfully()
    {
        $response = $this->json('GET','api/categories');
        $response->assertStatus(200);
    }
    public function testShowAllGenresSuccessfully()
    {
        $response = $this->json('GET','api/categories');
        $response->assertStatus(200);
    }
    public function testShowCertainCategoryFailure()
    {
        $response = $this->json('GET','api/categories/EDUCATION');
        $response->assertStatus(404);
    }
    public function testShowCertainCategorySuccessfully()
    {
        $response = $this->json('GET','api/category/EDUCATION');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
    public function testShowCertainGenreFailure()
    {
        $response = $this->json('GET', 'api/genres/Action');
        $response->assertStatus(404);
    }
    public function testShowCertainGenreSuccessfully()
    {
        $response = $this->json('GET','api/genre/Action');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
    public function testShowAppsByRatingSuccessfully()
    {
        $from = 3;
        $to = 4;
        $response = $this->json('GET','api/rating?from='.$from.'&to='.$to);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
    public function testShowBySearchSuccessfully()
    {
        $response = $this->json('GET','api/search?search=10');
        $response->assertStatus(200);
    }
    public function testPostCommentFailure()
    {
        $response = $this->json('POST','api/comment/10916',[
            'review' => 'AB',
            'sentiment' => '',
            'sentiment_polarity' => '',
            'sentiment_subjectivity' => ''
        ]);
        $response->assertStatus(400);
    }
    public function testPostCommentSuccessfully()
    {
        $response = $this->json('POST','api/comment/10916',[
            'review' => 'Awesome',
            'sentiment' => '1',
            'sentiment_polarity' => '1',
            'sentiment_subjectivity' => '1'
        ]);
        $response->assertStatus(201);
    }
    public function testShowFreeAppsSuccessfully()
    {
        $response = $this->json('GET','api/apps/free');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
    public function testShowPaidAppsSuccessfully()
    {
        $response = $this->json('GET','api/apps/paid');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
}
