<?php

namespace App\Http\Controllers;

use App\Http\Requests\DissmantlingStoreRequest;
use App\Http\Requests\DissmantlingUpdateRequest;
use App\Models\Dissmantling;
use App\Models\Motor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class DissmantlingController extends Controller
{
    public function index(Request $request): Response
    {
        $dissmantlings = Dissmantling::with('motor')->latest()->get();

        return inertia::render('index', [
            'data' => $dissmantlings,
            'edit' => "dissmantling.edit",
            'to' => 'dissmantling',
            'title' => "Dissmantling"
        ]);
    }

    public function create()
    {
        $motors = Motor::with('series')->orderBy('hp')->get();

        return inertia::render('Dissmantling/create', [
            'data' => $motors,
            'title' => 'Create Dissmantling',
            'to' => 'dissmantling',

        ]);
    }

    public function store(DissmantlingStoreRequest $request)
    {
        $issmantling = new Dissmantling;
        $issmantling->sernum = $request['sernum'];
        $issmantling->motor_id = $request['motor_id'];
        $issmantling->tgl = $request['tgl'];
        $issmantling->slug = $request['sernum'] . $request['tgl'];
        $issmantling->spk = $request['spk'];
        $issmantling->keterangan = $request['keterangan'];

        $issmantling->save();
        return redirect()->route('dissmantling');
    }

    public function show(Request $request, Dissmantling $dissmantling): Response
    {
        return view('dissmantling.show', compact('dissmantling'));
    }

    public function edit(Request $request, Dissmantling $dissmantling)
    {
        // dd($dissmantling);
        $motors = Motor::with('series')->orderBy('hp')->get();

        return inertia::render('Dissmantling/edit', [
            'data' => $dissmantling,
            'datas' => $motors,
            'title' => "Edit Assembling $dissmantling->sernum",
            'to' => 'dissmantling',

        ]);
    }

    public function update(DissmantlingUpdateRequest $request, Dissmantling $dissmantlings)
    {
        $dissmantling = $dissmantlings->where('spk', $request['spk'])->first();
        $dissmantling->sernum = $request['sernum'];
        $dissmantling->motor_id = $request['motor_id'];
        $dissmantling->tgl = $request['tgl'];
        $dissmantling->spk = $request['spk'];
        $dissmantling->keterangan = $request['keterangan'];
        $dissmantling->slug = $request['sernum'] . $request['tgl'];

        $dissmantling->save();

        return redirect()->route('dissmantling');
    }

    public function destroy(Request $request, Dissmantling $dissmantling)
    {
        $dissmantling->delete();

        return redirect()->route('dissmantling');
    }
}
