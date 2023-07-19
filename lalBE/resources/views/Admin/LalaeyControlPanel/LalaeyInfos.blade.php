@extends('Layout\AdminLayout')

@section('title')
Lalaeys
@endsection

@section('mainContent')
<audio controls>
    <source src="{{ asset('storage/Lalaeys/' . $lalaey->Audio_Path) }}">
    Your browser does not support the audio element.
</audio>
<h1>Name: <a href="/lalaey/{{ $lalaey->id }}">{{ $lalaey->Name }}</a></h1>
<p>Lang: {{ $lalaey->Lang }}</p>
<p>Type: {{ $lalaey->Type }}</p>
<p>Description: {{ $lalaey->Description }}</p>
@endsection
