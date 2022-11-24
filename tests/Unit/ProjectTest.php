<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase, WithoutMiddleware;
    
    public function test_it_has_a_path()
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }
}
