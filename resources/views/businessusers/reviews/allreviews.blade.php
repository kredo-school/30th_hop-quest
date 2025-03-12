<div class="bg-blue">
@extends('layouts.app')

@section('title', 'All Reviews')

@section('content')

<link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"  /> 
    <div class="pb-5 row justify-content-center mt-4">
        <div class="col-8">
            <div class="row">
                <h4 class="mb-3 poppins-regular">All Reviews</h4>
            </div>
            <table class="table border bg-white table-hover align-middle text-secondary">
                <thead class="table-success text-secondary small">
                    <tr>
                        <th></th>
                        <th style="width:100px">From</th>
                        <th style="width:150px">Spot</th>
                        <th style="width:150px">Rating</th>
                        <th class="overflow-hidden">Comments</th>
                        <th>Posted at</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><a href="{{ route('show.review')}}" class="text-decoration-none text-dark">Romeo</a></td>
                        <td>Hop Cafe</td>
                        <td>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                        </td>
                        <td class="overflow-hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
                        <td>2025/03/10/21:10</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Juliet</td>
                        <td>Hop Pub</td>
                        <td>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                        </td>
                        <td >Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
                        <td>2025/03/10/21:10</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Romeo</td>
                        <td>Hop Cafe</td>
                        <td>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                        </td>
                        <td class="overflow-hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
                        <td>2025/03/10/21:10</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Juliet</td>
                        <td>Hop Pub</td>
                        <td>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-solid fa-star color-yellow"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                            <i class="fa-regular fa-star color-navy"></i>
                        </td>
                        <td >Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
                        <td>2025/03/10/21:10</td>
                    </tr>
                </tbody>
            </table> 
            <div class="row mt-5">       
                <div class="col align-center mb-0">
                    <a href="{{route('home')}}">
                        <button class="btn btn-green w-25 position-absolute start-50 translate-middle mt-1">BACK</button>
                    </a>
                </div>
            </div>
        </div>

    </div>        

</div>
@endsection