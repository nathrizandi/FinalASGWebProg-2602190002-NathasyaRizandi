@extends('layout.navbar')

@section('title', 'Request')
@section('activeRequest', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-weight: bold">{{ $user->name }}</h5>
                            <p class="card-text">Hobbies: {{ $user->hobbies_field }}</p>
                            <div class="d-flex justify-content-between">
                                <form method="POST" action="{{ route('friend.store') }}" class="mb-2 w-50 me-2">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $user->request_id }}">
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-outline-success w-100">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('friend-request.destroy', $user->request_id) }}" class="w-50 ms-2">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">Decline</button>
                                </form>
                            </div>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
