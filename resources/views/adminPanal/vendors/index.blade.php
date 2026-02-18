@extends('layouts.app')
    @section('content')
{{-- {{ dd($vendor->users) }} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="card shadow-sm border-0 border-radius-12">
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-3">
                            <!-- Title -->
                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                <h5 class="fw-bold text-start text-md-start">Vendors List</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3">ID</th>
                                        <th scope="col" class="py-3">Name</th>
                                        <th scope="col" class="py-3">Email</th>
                                        <th scope="col" class="py-3">Phone</th>
                                        <th scope="col" class="py-3">Join Date</th>
                                        <th scope="col" class="py-3">Status</th>
                                        <th scope="col" class="py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $vendor)
                                    <tr>
                                        <td>#{{ $vendor->id }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>@foreach($vendor->users as $user)
                                                {{ $user->email }}<br>
                                            @endforeach</td>
                                        <td>{{ $vendor->phone }}</td>
                                        <td>{{ $vendor->created_at->format('d M, Y g:i A') }}</td>
                                        <td>{{ $vendor->status }}</td>
                                        <td class="d-flex">
                                            <a href="#" class="btn btn-sm"><i class="fa-solid fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            <div class="dropdown">
                                                <a class="nav-link px-3 pt-1 pb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item py-2" href="#">Block</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- pagination -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div>
                    <p class="mt-4 mt-sm-4 mt-md-4 mt-lg-1 text-center text-md-start">Showing 1 - 20 of 121</p>
                    </div>
                    <ul class="pagination">
                    <li><a href="#" class="pagination-link disabled" tabindex="-1">&lt;</a></li>
                    <li><a href="#" class="pagination-link active">1</a></li>
                    <li><a href="#" class="pagination-link">2</a></li>
                    <li><a href="#" class="pagination-link">3</a></li>
                    <li><a href="#" class="pagination-link">4</a></li>
                    <li><a href="#" class="pagination-link">&gt;</a></li>
                    </ul>
                </div>
            <!-- end pagination -->
            </div>
        </div>
    </div>
    @endsection
