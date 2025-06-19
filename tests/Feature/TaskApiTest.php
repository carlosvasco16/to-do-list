<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Task;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test_token')->plainTextToken;

        return ['Authorization' => 'Bearer ' . $token];
    }

    /** @test */
    public function user_can_create_task()
    {
        $headers = $this->authenticate();

        $response = $this->postJson('/api/tasks', [
            'title' => 'Nova tarefa',
            'description' => 'Descrição de teste'
        ], $headers);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Nova tarefa']);
    }

    /** @test */
    public function user_can_list_tasks()
    {
        $headers = $this->authenticate();
        $user = User::first();

        Task::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/tasks', $headers);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     ['id', 'title', 'description', 'status']
                 ]);
    }

    /** @test */
    public function user_can_update_task_status()
    {
        $headers = $this->authenticate();
        $user = User::first();

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->patchJson("/api/tasks/{$task->id}/status", [
            'status' => 'completed'
        ], $headers);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'completed']);
    }

    /** @test */
    public function user_can_delete_task()
    {
        $headers = $this->authenticate();
        $user = User::first();

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/tasks/{$task->id}", [], $headers);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Tarefa deletada com sucesso.']);
    }

    /** @test */
    public function user_can_filter_tasks_by_status()
    {
        $headers = $this->authenticate();
        $user = User::first();

        Task::factory()->create(['user_id' => $user->id, 'status' => 'pending']);
        Task::factory()->create(['user_id' => $user->id, 'status' => 'in_progress']);
        Task::factory()->create(['user_id' => $user->id, 'status' => 'completed']);
        Task::factory()->create(['user_id' => User::factory()->create()->id, 'status' => 'pending']);

        $response = $this->getJson('/api/tasks?status=pending', $headers);

        $response->assertStatus(200)
                ->assertJsonCount(1)
                ->assertJsonFragment(['status' => 'pending'])
                ->assertJsonStructure([
                    '*' => ['id', 'title', 'description', 'status', 'user_id'],
                ]);
    }

}

