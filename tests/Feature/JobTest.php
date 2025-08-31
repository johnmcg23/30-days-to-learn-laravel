<?php

namespace Tests\Feature;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Job;
use Tests\TestCase;

it('belongs to an employer', function () {
    // AAA Pattern: Arrange, Act, Assert

    // Arrange: Set up the necessary data
    // Create an Employer instance
    $employer = Employer::factory()->create();

    // Create a Job instance linked to the Employer
    $job = Job::factory()->create([
        "employer_id" => $employer->id
    ]);

    // Act and Assert: Perform the action and verify the result
    // Confirm that the job's employer relationship matches the created Employer
    expect($job->employer->is($employer))->toBeTrue();
});


class JobTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

}
