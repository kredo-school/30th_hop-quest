<div class="bg-yellow">
@extends('layouts.app')

@section('title', 'Admin: Applied Users')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="">
    <table class="table border bg-white table-hover align-middle text-secondary">
        <thead class="table-primary text-secondary text-uppercase small">
            <tr>
                <th class="align-middle">ID</th>
                <th></th>
                <th class="align-middle">User Name</th>
                {{-- <th>Email</th> --}}
                <th>
                    <form method="GET" action="" class="d-inline-block ms-2">
                        <select name="sort" onchange="this.form.submit()" class="bg-skyblue-thead mt-3 text-sm">
                            <option value="" disabled>APPLIED AT</option>
                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </form>
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($applied_users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-sm d-block mx-auto">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('profile.businesses', $user->id)}}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                    </td>
                    {{-- <td>
                        {{ $user->email }}
                    </td> --}}
                    <td>
                        {{date('M d, Y H:i:s', strtotime($user->updated_at))}}
                    </td>
                    @if($user->official_certification == 2)
                        <td>
                            <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-sm btn-green w-100">Approve</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                                @csrf
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn btn-sm btn-red w-100">Reject</button>
                            </form>
                        </td>
                    @elseif($user->official_certification == 3)
                        <td>
                            <button class="btn btn-sm btn-outline-green w-100 mb-3">Approved</button>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                                @csrf
                                <input type="hidden" name="action" value="revoke">
                                <button type="submit" class="btn btn-sm btn-navy w-100 ">Revoke</button>
                            </form>
                        </td>
                    @endif
                    <td>
                        {{-- status --}}
                        @if($user->trashed())
                            <i class="fa-regular fa-circle"></i> Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i> Active
                        @endif
                    </td>
                    <td>
                        @if($user->id != Auth::user()->id)
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown"> 
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if($user->trashed())
                                    {{-- activate --}}
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user{{$user->id}}">
                                        <i class="fa-solid fa-user-check"></i> Activate {{$user->name}}
                                    </button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user{{ $user->id }}">
                                        <i class="fa-solid fa-user-slash"></i> Deactivate {{$user->name}}
                                    </button>
                                @endif
                            </div>                         
                        </div>
                        @include('admin.users.status')
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">No users found.</td>
                </tr>

            @endforelse
        </tbody>
    </table>
    {{ $applied_users->links() }}
</div>
</div>
@endsection