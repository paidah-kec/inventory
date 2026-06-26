<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user dengan role admin
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Buat user biasa
        $this->user = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_get_all_items_success()
    {
        $token = $this->user->createToken('api-token')->plainTextToken;

        // DI SINI: Ditambahkan v1 sesuai rute proyekmu
        $response = $this->getJson('/api/v1/items', [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data',
                     'message'
                 ]);
    }

    public function test_user_cannot_delete_item()
    {
        $category = Category::factory()->create();
        $item = \App\Models\Item::factory()->create(['category_id' => $category->id]);
        
        $token = $this->user->createToken('api-token')->plainTextToken;

        // DI SINI: Ditambahkan v1 sesuai rute proyekmu
        $response = $this->deleteJson("/api/v1/items/{$item->id}", [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_delete_item()
    {
        $category = Category::factory()->create();
        $item = \App\Models\Item::factory()->create(['category_id' => $category->id]);
        
        $token = $this->admin->createToken('api-token')->plainTextToken;

        // DI SINI: Ditambahkan v1 sesuai rute proyekmu
        $response = $this->deleteJson("/api/v1/items/{$item->id}", [], [
            'Authorization' => 'Bearer ' . $token
        ]);

        // Catatan: Jika saat sukses hapus di ItemController rolenya mengembalikan status 204 (No Content), 
        // ganti assertStatus(200) di bawah ini menjadi assertStatus(204).
        $response->assertStatus(204); 
    }
}
