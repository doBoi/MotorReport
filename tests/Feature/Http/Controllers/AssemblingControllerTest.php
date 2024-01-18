<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Assembling;
use App\Models\Motor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AssemblingController
 */
final class AssemblingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $assemblings = Assembling::factory()->count(3)->create();

        $response = $this->get(route('assembling.index'));

        $response->assertOk();
        $response->assertViewIs('assembling.index');
        $response->assertViewHas('assemblings');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('assembling.create'));

        $response->assertOk();
        $response->assertViewIs('assembling.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssemblingController::class,
            'store',
            \App\Http\Requests\AssemblingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $motor = Motor::factory()->create();
        $sernum = $this->faker->word();
        $tgl = $this->faker->date();

        $response = $this->post(route('assembling.store'), [
            'motor_id' => $motor->id,
            'sernum' => $sernum,
            'tgl' => $tgl,
        ]);

        $assemblings = Assembling::query()
            ->where('motor_id', $motor->id)
            ->where('sernum', $sernum)
            ->where('tgl', $tgl)
            ->get();
        $this->assertCount(1, $assemblings);
        $assembling = $assemblings->first();

        $response->assertRedirect(route('assembling.index'));
        $response->assertSessionHas('assembling.id', $assembling->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $assembling = Assembling::factory()->create();

        $response = $this->get(route('assembling.show', $assembling));

        $response->assertOk();
        $response->assertViewIs('assembling.show');
        $response->assertViewHas('assembling');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $assembling = Assembling::factory()->create();

        $response = $this->get(route('assembling.edit', $assembling));

        $response->assertOk();
        $response->assertViewIs('assembling.edit');
        $response->assertViewHas('assembling');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssemblingController::class,
            'update',
            \App\Http\Requests\AssemblingUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $assembling = Assembling::factory()->create();
        $motor = Motor::factory()->create();
        $sernum = $this->faker->word();
        $tgl = $this->faker->date();

        $response = $this->put(route('assembling.update', $assembling), [
            'motor_id' => $motor->id,
            'sernum' => $sernum,
            'tgl' => $tgl,
        ]);

        $assembling->refresh();

        $response->assertRedirect(route('assembling.index'));
        $response->assertSessionHas('assembling.id', $assembling->id);

        $this->assertEquals($motor->id, $assembling->motor_id);
        $this->assertEquals($sernum, $assembling->sernum);
        $this->assertEquals(Carbon::parse($tgl), $assembling->tgl);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $assembling = Assembling::factory()->create();

        $response = $this->delete(route('assembling.destroy', $assembling));

        $response->assertRedirect(route('assembling.index'));

        $this->assertSoftDeleted($assembling);
    }
}
