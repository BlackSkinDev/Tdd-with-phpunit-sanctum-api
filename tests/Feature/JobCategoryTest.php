<?php

namespace Tests\Feature;

use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobCategoryTest extends TestCase
{
    use RefreshDatabase;

    // create job category
    public function test_if_category_can_be_created(){
        $this->withExceptionHandling();

        Sanctum::actingAs(User::factory()->create());
        $title = 'Engineering';
        $payload = ['title'=>$title];
        $headers = [
          'Accept'=>'application/json'
        ];

        $response = $this->post('api/job-categories',$payload,$headers);
        $response->assertJson([
           'status'=>true,
           'message'=>'Job category created',
           'data' =>[
                'id'=>1,
                'title'=>$title
           ]
        ]);
        $response->assertStatus(201);
        JobCategory::factory(10)->create();

        $this->assertDatabaseCount('job_categories',11);
    }

    public function test_if_validation_error_is_returned(){
        $this->withExceptionHandling();

        Sanctum::actingAs(User::factory()->create());

        $title = '';
        //$payload = ['title'=>$title];
        $headers = [
            'Accept'=>'application/json'
        ];

        $response = $this->post('api/job-categories');
        $response->assertStatus(400);
        $response->assertJson([
           'errors'=>[
               'The title field is required.'
           ]
        ]);



    }

    public function test_if_job_categories_can_be_fetched(){
        //$this->withExceptionHandling();
        $jobCategory = JobCategory::factory()->create();
        $headers = [
            'Accept'=>'application/json'
        ];
        $response = $this->get('api/job-categories',$headers);
        $response->assertStatus(200);
        $response->assertJson([
                'data'=>[
                    [
                        'id'=>$jobCategory->id,
                        'title'=>$jobCategory->title,
                        'user_id'=>$jobCategory->user_id,
                   ]
                ]
        ]);

    }



}
