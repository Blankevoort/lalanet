@extends('Layout\AdminLayout')

@section('title')
Lalaeys
@endsection

@section('mainContent')
@foreach ($lalaeys as $lalaey)
<audio controls>
    <source src="{{ asset('storage/Lalaeys/' . $lalaey->Audio_Path) }}">
    Your browser does not support the audio element.
</audio>
<h1>Name: <a href="/lalaey/{{ $lalaey->id }}">{{ $lalaey->Name }}</a></h1>
<p>Lang: {{ $lalaey->Lang }}</p>
<p>Type: {{ $lalaey->Type }}</p>
<p>Description: {{ $lalaey->Description }}</p>
<a href="lalaey/{{ $lalaey->id }}/edit">Edit This Lalaey</a>
<form action="/lalaey/{{ $lalaey->id }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit">Delete</button>
</form>
@endforeach
@endsection
