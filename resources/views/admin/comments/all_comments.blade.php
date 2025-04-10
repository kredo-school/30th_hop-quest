<div class="bg-blue">
    @extends('layouts.app')
    
    @section('title', 'Admin: Users')
    
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endsection
    
    
    @section('content')
    <div class="">
        <table class="table border bg-white table-hover align-middle text-secondary mt-5">
            <thead class="table-primary text-secondary text-uppercase small">
                <tr>
                    {{-- <th class="align-middle">ID</th> --}}
                    <th ></th>
                    <th class="align-middle">user name</th>
                    <th class="align-middle">comment</th>
                    {{-- <th>Email</th> --}}
                    <th rowspan="2">
                        <form method="GET" action="" class="d-inline-block ms-2">
                            <label for="sort" class=""></label>
                            <select name="sort" id="sort" onchange="this.form.submit()" class="bg-skyblue-thead mt-3 text-sm">
                                <option value="" disabled selected>POSTED AT</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>FROM LATEST</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>FROM OLDEST</option>
                            </select>
                        </form>
                    </th>
                    <th rowspan="2" class="align-middle">status</th>
                    <th rowspan="2"></th>
                </tr>
    
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        {{-- <td>{{$user->id}}</td> --}}
                        <td >
                            <a href="{{route('profile.businesses', $comment['user_id'])}}" class="text-decoration-none text-dark fw-bold">
                            {{-- @if($comment['user_avatar'])
                                <img src="{{ $comment['user_avatar'] }}" alt="" class="rounded-circle avatar-sm d-block mx-auto">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                            @endif --}}
                            </a>
                        </td>
                        <td>
                            <a href="#" class="text-decoration-none text-dark" >{{ $comment['user_name'] }}</a>
                        </td>
                        <td class="align-middle">
                            <a href="{{route('profile.businesses', $comment['user_id'])}}" class="text-decoration-none text-dark">{{$comment['content']}}</a>
                        </td>
                        {{-- <td>
                            {{ $user->email }}
                        </td> --}}
                        <td>
                            {{date('M d, Y H:i:s', strtotime($comment['created_at']))}}

                        </td>
                        
                        <td>
                            {{-- status --}}
                            @if($comment['is_trashed'])
                                <i class="fa-solid fa-circle color-red"></i> Invisible
                            @else
                                <i class="fa-solid fa-circle color-green"></i> Visible
                            @endif
                        </td>
                        <td>
                            @if($comment['user_id'] != Auth::user()->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown"> 
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($comment['is_trashed'])
                                        {{-- activate --}}
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-comment{{$comment['id']}}">
                                            <i class="fa-solid fa-eye"></i> Activate 
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-comment{{$comment['id']}}">
                                            <i class="fa-solid fa-eye-slash"></i> Deactivate 
                                        </button>
                                    @endif
                                </div>                         
                            </div>
                            @include('admin.comments.comment_status')
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">No comments found.</td>
                    </tr>
    
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end mb-5">
            {{ $comments->links() }}
        </div>
    </div>
    </div>
    @endsection