@extends('layouts.app')

@section('content')
@foreach ($assemblings as $assembling )
<h2>{{ $assembling->sernum }}</h2>
<p>{{ $assembling->tgl }}</p>
<p>{{ $assembling->motor->hp }}</p>
<br>
@endforeach
@endsection
