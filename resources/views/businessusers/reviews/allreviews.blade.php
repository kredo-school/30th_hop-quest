<div class="bg-blue">
@extends('layouts.app')

@section('title', 'All Reviews')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center mt-5 pb-5 ">
        <div class="col-8">
            <div class="row">
                <h4 class="mb-3 poppins-regular">All Reviews</h4>
            </div>
            <div class="table-container">
                <table class="custom-table text-secondary">
                    <thead>
                        <tr class="text-uppercase">
                            <th></th>
                            <th class="table-from">From</th>
                            <th class="table-spot">Spot</th>
                            <th class="table-rating">Rating</th>
                            <th class="">Comments</th>
                            <th class="table-time">Posted at</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td></td>
                            <td><a href="{{ route('show.review')}}" class="text-decoration-none text-secondary">Romeo</a></td>
                            <td>Hop Cafe</td>
                            <td>
                                <i class="fa-solid fa-star color-yellow"></i>
                                <i class="fa-solid fa-star color-yellow"></i>
                                <i class="fa-solid fa-star color-yellow"></i>
                                <i class="fa-solid fa-star color-yellow"></i>
                                <i class="fa-regular fa-star color-navy"></i>
                            </td>
                            <td class="table-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, ipsa autem! Nostrum debitis earum sunt repellendus accusamus ullam cumque necessitatibus. </td>
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
                            <td class="table-comment">Lorem ipsum dolor sit amet sit amet.  </td>
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
                            <td class="table-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
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
                            <td class="table-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, quis. Lorem ipsum dolor sit amet.  </td>
                            <td>2025/03/10/21:10</td>
                        </tr>
                    </tbody>
                </table> 
            </div>   
            <div class="row mt-5">       
                <div class="col align-center mb-0">
                    <a href="{{route('profile')}}">
                        <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to Profile</button>
                    </a>
                </div>
            </div>
        </div>

    </div>        

</div>
@endsection