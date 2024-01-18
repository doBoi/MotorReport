<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssemblingStoreRequest;
use App\Http\Requests\AssemblingUpdateRequest;
use App\Models\Assembling;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class AssemblingController extends Controller
{
    public function index()
    {
        $assemblings = Assembling::with('motor')->latest()->get();
        return inertia::render('index', [
            'data' => $assemblings,
            'edit' => "assembling.edit",
            'to' => 'assembling',
            'title' => "Assembling"
        ]);
    }

    public function create()
    {

        $motors = Motor::with('series')->orderBy('hp')->get();

        return inertia::render('Assembling/create', [
            'data' => $motors,
            'title' => 'Create Assembling',
            'to' => 'assembling',
        ]);
    }

    public function store(AssemblingStoreRequest $request)
    {
        $Assembling = new Assembling;
        $Assembling->sernum = $request['sernum'];
        $Assembling->motor_id = $request['motor_id'];
        $Assembling->tgl = $request['tgl'];
        $Assembling->slug = $request['sernum'] . $request['tgl'];
        $Assembling->spk = $request['spk'];
        $Assembling->keterangan = $request['keterangan'];

        $Assembling->save();

        return redirect()->route('assembling');
    }

    public function show(Request $request, Assembling $assembling)
    {
        return view('assembling.show', compact('assembling'));
    }

    public function edit(Assembling $assembling)
    {
        $motors = Motor::with('series')->orderBy('hp')->get();

        return inertia::render('Assembling/edit', [
            'data' => $assembling,
            'datas' => $motors,
            'title' => "Edit Assembling $assembling->sernum",
            'to' => 'assembling'
        ]);
    }

    public function update(AssemblingUpdateRequest $request, Assembling $assemblings)
    {
        // dd(Assembling::where('spk', $request['spk'])->get());
        $assembling = $assemblings->where('spk', $request['spk'])->first();
        $assembling->sernum = $request['sernum'];
        $assembling->motor_id = $request['motor_id'];
        $assembling->tgl = $request['tgl'];
        $assembling->slug = $request['sernum'] . $request['tgl'];
        $assembling->spk = $request['spk'];
        $assembling->keterangan = $request['keterangan'];

        $assembling->save();

        return redirect()->route('assembling');
    }

    public function destroy(Request $request, Assembling $assembling)
    {
        $assembling->delete();

        return redirect()->route('assembling');
    }
}
