@extends('Layout\AdminLayout')

@section('title')
Lalaey Edit
@endsection

@section('mainContent')
<div>
    <form action="/lalaey/{{ $lalaey->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="Name" value="{{ $lalaey->Name }}">
        <select name="Lang" value="{{ $lalaey->Lang }}">
            <option value="FA">FA</option>
            <option value="EN">EN</option>
        </select>
        <select name="Type" value="{{ $lalaey->Type }}">
            <option value="Happy">Happy</option>
            <option value="Sad">Sad</option>
        </select>
        <input type="text" name="Description" value="{{ $lalaey->Description }}" />
        Choose Lalaey: <input type="file" name="Audio">
        <button type="submit">Submit</button>
    </form>
</div>
@endsection
