<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_dynamic_data_from_route(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Halo,')
            ->assertViewHas('courses')
            ->assertViewHas('name');
    }

    public function test_about_page_shows_dynamic_data_from_route(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertViewHas('stack')
            ->assertSee('Laravel');
    }

    public function test_contact_page_shows_dynamic_data_and_form(): void
    {
        $this->get('/contact')
            ->assertOk()
            ->assertViewHas('contacts')
            ->assertSee('name="_token"', false);
    }

    public function test_hello_route_accepts_alphabetic_parameter(): void
    {
        $this->get('/hello/budi')
            ->assertOk()
            ->assertSee('Budi');
    }

    public function test_hello_route_rejects_non_alphabetic_parameter(): void
    {
        $this->get('/hello/123')->assertNotFound();
    }

    public function test_contact_form_requires_all_fields(): void
    {
        $this->post('/contact', [])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_contact_form_stores_message(): void
    {
        $this->post('/contact', [
            'name'    => 'Budi',
            'email'   => 'budi@example.com',
            'message' => 'Halo, ini pesan percobaan untuk tugas.',
        ])->assertRedirect(route('contact'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('messages', ['email' => 'budi@example.com']);
        $this->assertSame(1, Message::count());
    }

    public function test_message_model_ignores_non_fillable_columns(): void
    {
        $message = Message::create([
            'name'       => 'Budi',
            'email'      => 'budi@example.com',
            'message'    => 'Pesan percobaan mass assignment.',
            'created_at' => '2000-01-01 00:00:00', // tidak ada di $fillable -> diabaikan
        ]);

        $this->assertNotSame('2000-01-01', $message->created_at->format('Y-m-d'));
    }
}
