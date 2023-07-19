@extends('Layout\AdminLayout')

@section('title')
Lalaey Upload
@endsection

@section('mainContent')
<div>
    <form action="/lalaey" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="Name">
        <select name="Lang">
            <option value="FA">FA</option>
            <option value="EN">EN</option>
        </select>
        <select name="Type">
            <option value="Happy">Happy</option>
            <option value="Sad">Sad</option>
        </select>
        <input type="text" name="Description">
        Choose Lalaey: <input type="file" name="Audio">
        <button type="submit">Submit</button>
    </form>
</div>
@endsection
