@extends('admin.template.index')

@section('content')
    <div class="container">
        <h2>Daftar Member</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. Handphone</th>
                    <th>Email</th>
                    <th>Poin</th>
                    <th>Dibuat tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->tlp }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->points }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination Links --}}
        <div class="pagination">
            {{ $data->links() }}
        </div>
    </div>
@endsection
