<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Review')

@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection
    <div class="pb-5 row justify-content-center mt-4 pt-5">
        <div class="col-8">
            <div class="row mb-3">
                <div class="col-9">
                    <div class="table-container">
                        <table class="custom-table ">
                            <thead class="small">
                                <tr>
                                    <th class="cell-middle text-uppercase">From</th>
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
                </div>
                <div class="col-3">
                    <div class="table-container">
                        <table class="custom-table ">
                            <thead class="small">
                                <tr>
                                    <th class="cell-short text-uppercase">Posted time</th>
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
            </div>
            <div class="row mb-3">
                <div class="col-9">
                    <div class="table-container">
                        <table class="custom-table ">
                            <thead class="small">
                                <tr>
                                    <th class="cell-middle text-uppercase">Spot</th>
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
                </div>
                <div class="col-3">
                    <div class="table-container">
                        <table class="custom-table ">
                            <thead class="small">
                                <tr>
                                    <th class="cell-short text-uppercase">Rating</th>
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
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="table-container">
                        <table class="custom-table ">
                            <thead class="small">
                                <tr>
                                    <th class="cell-long text-uppercase">Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, omnis? Saepe numquam similique nobis amet! Numquam ea qui culpa voluptas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, nemo?
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">       
            <div class="col align-center mb-0">
                <a href="{{ route('profile.reviews')}}">
                    <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to all Reviews</button>
                </a>
            </div>
        </div>
    </div>        
</div>
@endsection