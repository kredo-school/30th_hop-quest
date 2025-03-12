<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Review')

@section('content')

<link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"  /> 
    <div class="pb-5 row justify-content-center mt-4">
        <div class="col-8">
            <div class="row">
                <div class="col-9">
                    <table class="table border bg-white table-hover align-middle text-secondary">
                        <thead class="table-success text-secondary small">
                            <tr>
                                <th>From</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Romeo
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <table class="table border bg-white table-hover align-middle text-secondary">
                        <thead class="table-success text-secondary small">
                            <tr>
                                <th>Posted time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    2025/03/10/21:10
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <table class="table border bg-white table-hover align-middle text-secondary">
                        <thead class="table-success text-secondary small">
                            <tr>
                                <th>Spot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Hop Cafe
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-3">
                    <table class="table border bg-white table-hover align-middle text-secondary">
                        <thead class="table-success text-secondary small">
                            <tr>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa-solid fa-star color-yellow"></i>
                                    <i class="fa-solid fa-star color-yellow"></i>
                                    <i class="fa-solid fa-star color-yellow"></i>
                                    <i class="fa-solid fa-star color-yellow"></i>
                                    <i class="fa-regular fa-star color-navy"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table border bg-white table-hover align-middle text-secondary">
                        <thead class="table-success text-secondary small">
                            <tr>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum nostrum minima magni nemo distinctio explicabo pariatur! Veritatis quibusdam blanditiis reprehenderit?
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5">       
            <div class="col align-center mb-0">
                <a href="{{ route('profile.reviews')}}">
                    <button class="btn btn-green w-25 position-absolute start-50 translate-middle mt-1">BACK TO ALL REVIEWS</button>
                </a>
            </div>
        </div>
    </div>        
</div>
@endsection