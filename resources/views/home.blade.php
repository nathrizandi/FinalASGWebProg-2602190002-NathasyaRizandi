@extends('layout.navbar')

@section('title', 'Home')
@section('activeHome', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0" style="font-weight: bold">Welcome, {{ Auth::user()->name }}!</h5>
        
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#notifications">
            See New Notification Here
        </button>
    </div>
    <div id="notifications" class="collapse mt-3">
        <div class="alert alert-info">
            <ul class="list-unstyled mb-0">
                @forelse (Auth::user()->notifications as $notification)
                    <li class="d-flex justify-content-between align-items-center">
                        {{ $notification->data['message'] }}
                        <a href="{{ route('notifications.destroy', $notification->id) }}" class="btn btn-danger btn-sm ms-2"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                            <i class="fas fa-times"></i> <!-- Close icon -->
                        </a>
    
                        <form id="delete-form-{{ $notification->id }}"
                            action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                @empty
                    <li>No new notifications</li>
                @endforelse
            </ul>
        </div>
    </div>
    
    

        <div class="row mt-4 mb-3">
            <!-- Search Form -->
            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="hobby" class="form-control" placeholder="Search friend by hobby"
                            value="{{ request('hobby') }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <button type="submit" class="btn btn-outline-secondary w-100">Search</button>
                    </div>
                </div>
            </form>            

            <h1 class="mb-3" style="font-weight: bold">Casual Friends</h1>
            @foreach ($dataUser as $user)
                <div class="col-md-3 mb-3">
                    <div class="card h-80 shadow-sm">
                        <img src="{{ asset($user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <hr>
                            <h5 class="card-title" style="font-weight: bold">{{ $user->name }}</h5>
                            <p class="card-text">Hobbies: {{ $user->hobbies_field }}</p>
                            <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-outline-success btn-sm w-30">
                                    <i class="fa fa-thumbs-up"></i>
                                </button>
                            </form>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
