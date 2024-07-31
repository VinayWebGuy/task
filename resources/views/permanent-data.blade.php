@extends('layouts.main')
@section('title', 'Permanent Data')
@section('permanent-data', 'active')
@section('content')
    <h2 class="title">Permanent Data</h2>
    @if (Session::has('success'))
        <div class="success">{{ Session::get('success') }}</div>
    @endif
    @if (count($data) > 0)
        <a class="button" href="{{ route('download.excel') }}" class="btn btn-primary">Download</a>
    @endif
    <form action="{{ route('upload.excel') }}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="group">
            <label for="file">Import Excel</label>
            <input type="file" name="file" id="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <!-- Data Table -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Date</th>
                <th>Role</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->password }}</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->mobile }}</td>
                    <td>{{ $d->date }}</td>
                    <td>{{ $d->role }}</td>
                    <td>
                        @if ($d->image)
                            <img src="{{ asset($d->image) }}" alt="Image" width="50">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
