<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsTest extends TestCase
{
    use WithFaker, WithoutMiddleware, DatabaseMigrations;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $atributes = [
            'title' => fake()->sentence,
            'description' => fake()->paragraph
        ];

        $this->post('/projects', $atributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $atributes);

        $this->get('/projects')->assertSee($atributes['title']);
    }

    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();


        $project = Project::factory()->create();
        
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);

    }
    
    public function test_a_project_requires_a_title()
    {
        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('projects', $attributes)->assertSessionHasErrors('description');
    }
}
