<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Dissmantling;
use App\Models\Motor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DissmantlingController
 */
final class DissmantlingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $dissmantlings = Dissmantling::factory()->count(3)->create();

        $response = $this->get(route('dissmantling.index'));

        $response->assertOk();
        $response->assertViewIs('dissmantling.index');
        $response->assertViewHas('dissmantlings');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('dissmantling.create'));

        $response->assertOk();
        $response->assertViewIs('dissmantling.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DissmantlingController::class,
            'store',
            \App\Http\Requests\DissmantlingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $motor = Motor::factory()->create();
        $sernum = $this->faker->word();
        $tgl = $this->faker->date();

        $response = $this->post(route('dissmantling.store'), [
            'motor_id' => $motor->id,
            'sernum' => $sernum,
            'tgl' => $tgl,
        ]);

        $dissmantlings = Dissmantling::query()
            ->where('motor_id', $motor->id)
            ->where('sernum', $sernum)
            ->where('tgl', $tgl)
            ->get();
        $this->assertCount(1, $dissmantlings);
        $dissmantling = $dissmantlings->first();

        $response->assertRedirect(route('dissmantling.index'));
        $response->assertSessionHas('dissmantling.id', $dissmantling->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $dissmantling = Dissmantling::factory()->create();

        $response = $this->get(route('dissmantling.show', $dissmantling));

        $response->assertOk();
        $response->assertViewIs('dissmantling.show');
        $response->assertViewHas('dissmantling');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $dissmantling = Dissmantling::factory()->create();

        $response = $this->get(route('dissmantling.edit', $dissmantling));

        $response->assertOk();
        $response->assertViewIs('dissmantling.edit');
        $response->assertViewHas('dissmantling');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DissmantlingController::class,
            'update',
            \App\Http\Requests\DissmantlingUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $dissmantling = Dissmantling::factory()->create();
        $motor = Motor::factory()->create();
        $sernum = $this->faker->word();
        $tgl = $this->faker->date();

        $response = $this->put(route('dissmantling.update', $dissmantling), [
            'motor_id' => $motor->id,
            'sernum' => $sernum,
            'tgl' => $tgl,
        ]);

        $dissmantling->refresh();

        $response->assertRedirect(route('dissmantling.index'));
        $response->assertSessionHas('dissmantling.id', $dissmantling->id);

        $this->assertEquals($motor->id, $dissmantling->motor_id);
        $this->assertEquals($sernum, $dissmantling->sernum);
        $this->assertEquals(Carbon::parse($tgl), $dissmantling->tgl);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $dissmantling = Dissmantling::factory()->create();

        $response = $this->delete(route('dissmantling.destroy', $dissmantling));

        $response->assertRedirect(route('dissmantling.index'));

        $this->assertSoftDeleted($dissmantling);
    }
}
