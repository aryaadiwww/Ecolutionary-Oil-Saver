@extends('admin.template.index')

@section('content')
    <div class="container">
        <h2>Manage Reward Requests</h2>

        @if ($requests->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>No. Handphone</th>
                        <th>Reward</th>
                        <th>Points</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->user->name }}</td>
                            <td>{{ $request->user->tlp }}</td>
                            <td>{{ $request->reward->name }}</td>
                            <td>{{ $request->reward->points }}</td>
                            <td class="form-reward">
                                <form method="POST" action="{{ route('admin.reward-requests.update', $request->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn-approve">Approve</button>
                                </form>

                                <form method="POST" action="{{ route('admin.reward-requests.update', $request->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="btn-reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No pending reward requests found.</p>
        @endif
    </div>
@endsection
