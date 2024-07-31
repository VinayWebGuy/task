@extends('layouts.main')
@section('title', 'Temporary Data')
@section('temp-data', 'active')
@section('content')
    <h2 class="title">Temporary Data</h2>
    @if (Session::has('success'))
        <div class="success">{{ Session::get('success') }}</div>
    @endif
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>Password</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Session::get('formData', []) as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['mobile'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td>{{ $item['password'] }}</td>
                    <td><img src="{{ asset($item['image']) }}" alt="Image" width="50"></td>
                    <td>
                        <div class="row">
                            <a class="button" href="{{ route('edit.data', ['id' => $item['id']]) }}">Edit</a>
                            <form action="{{ route('delete.data', ['id' => $item['id']]) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (Session::has('formData') && count(Session::get('formData')) > 0)
        <form action="{{ route('final.submit') }}" method="post">
            @csrf
            <button type="submit">Final Submit</button>
        </form>
    @endif
@endsection
