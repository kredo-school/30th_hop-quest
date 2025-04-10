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
                    <th rowspan="2"></th>
                    <th class="align-middle">Title</th>
                    <th class="align-middle">User name</th>
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
                @forelse($posts as $post)
                    <tr>
                        {{-- <td>{{$user->id}}</td> --}}
                        <td >
                            <a href="#" class="text-decoration-none text-dark fw-bold">
                            @if($post->main_image)
                                <img src="{{ $post->main_image }}" alt="" class="img-md d-block mx-auto">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                            @endif
                            </a>
                        </td>
                        <td>
                            <a href="#" class="text-decoration-none text-dark" >{{ $post->name }}</a>
                        </td>
                        <td class="align-middle">
                            <a href="{{route('profile.businesses', $post->user->id)}}" class="text-decoration-none text-dark">{{$post->user->name}}</a>
                        </td>
                        {{-- <td>
                            {{ $user->email }}
                        </td> --}}
                        <td>
                            @if($post->updated_at)
                                {{date('M d, Y H:i:s', strtotime($post->updated_at))}}
                            @else
                                {{date('M d, Y H:i:s', strtotime($post->created_at))}}
                            @endif
                        </td>
                        
                        <td>
                            {{-- status --}}
                            @if($post->trashed())
                                <i class="fa-solid fa-circle color-red"></i> Invisible
                            @else
                                <i class="fa-solid fa-circle color-green"></i> Visible
                            @endif
                        </td>
                        <td>
                            @if($post->id != Auth::user()->id)
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown"> 
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($post->trashed())
                                        {{-- activate --}}
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-post{{$post->id}}">
                                            <i class="fa-solid fa-eye"></i> Activate {{$post->name}}
                                        </button>
                                    @else
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-post{{ $post->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> Deactivate {{$post->name}}
                                        </button>
                                    @endif
                                </div>                         
                            </div>
                            @include('admin.posts.post_status')
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
        <div class="d-flex justify-content-end mb-5">
            {{ $posts->links() }}
        </div>
    </div>
    </div>
    @endsection