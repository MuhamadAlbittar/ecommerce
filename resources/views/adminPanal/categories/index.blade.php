@extends('layouts.app')
    @section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                {{-- @if(auth()->user()->canDo('add_category')) --}}
                    <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#addModal">
                      Add Category
                    </button>
                {{-- @endif --}}

                {{-- for notifications --}}
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">

                    @foreach(auth()->user()->notifications()->latest()->take(5)->get() as $notification)

                        <li>
                            <a href="{{ route('notifications.read', $notification->id) }}"
                            class="dropdown-item {{ $notification->read_at ? '' : 'fw-bold bg-light' }}">

                                @if($notification->data['type'] === 'approved')
                                    <i class="fas fa-check-circle text-success"></i>
                                @elseif($notification->data['type'] === 'rejected')
                                    <i class="fas fa-times-circle text-danger"></i>
                                @endif

                                {{ $notification->data['message'] }}

                                <br>
                                <small class="text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>

                            </a>
                        </li>

                    @endforeach

                    </ul>
                </li>
                {{-- for errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <div class="card shadow-sm border-0 border-radius-12">
                    <div class="card-body p-4">

                        <div class="row align-items-center mb-3">
                            <!-- Title -->
                            <div class="col-12 col-md-auto mb-0 mb-md-0 d-flex">
                                <h5 class="fw-bold text-start text-md-start">Categories List</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Parent</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        @if (auth()->user()->role === 'admin')
                                        <th>Approval</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($categories as $category)
                                    <tr class="align-content-center">
                                        <!-- Image -->
                                        <td><img src="{{ $category->getFirstMediaUrl('category-logo') }}" class="img-fluid" width="100"></td>

                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent?->name ?? 'Main Category' }}</td>
                                        <td>{{ $category->description }}</td>
                                         <!-- الحالة -->
                                        <td>
                                                @switch($category->approval_status)
                                                    @case('pending')
                                                    <span class="badge bg-warning">pending</span>
                                                    @break
                                                    @case('approved')
                                                        <span class="badge bg-success">Approved</span>
                                                        @break
                                                    @case('rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                        @break
                                                @endswitch
                                        </td>

                                        <!-- الأزرار -->
                                        @if (auth()->user()->role === 'admin')
                                        <td>
                                                @if($category->approval_status === 'pending')
                                                    <!-- موافقة -->
                                                    <form action="{{ route('categories.changeStatus', $category->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    <!-- رفض -->
                                                    <form action="{{ route('categories.changeStatus', $category->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                         <input type="hidden" name="status" value="rejected">
                                                        <button class="btn btn-danger btn-sm">Reject</button>
                                                    </form>
                                                @else
                                                <span class="text-muted">No Actions</span>
                                                @endif
                                        </td>
                                        @endif


                                        <td>
                                            @if ($category->added_by === auth()->id()|| auth()->user()->role === 'admin')
                                            <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                                <i class="fa-solid fa-edit" style="color:green"></i>
                                            </button>
                                            @else
                                            <button disabled class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                                <i class="fa-solid fa-edit" style="color:rgb(43, 42, 42)"></i>
                                            </button>
                                            @endif
                                            {{-- edit modal --}}
                                            <div class="modal fade" id="editModal{{ $category->id }}">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5>Edit Category</h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <input type="text" name="name" class="form-control mb-2" placeholder="Name" value="{{ old('name', $category->name) }}">

                                                            <select name="parent_id" class="form-control mb-2">
                                                                <option value="">Main</option>
                                                                @foreach($categories as $p)
                                                                    @if($p->id != $category->id)
                                                                    <option value="{{ $p->id }}" {{ $p->id == $category->parent_id ? 'selected' : '' }}>
                                                                        {{ $p->name }}
                                                                    </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                            <textarea name="description" class="form-control mb-2" placeholder="Description">{{ old('description', $category->description) }}</textarea>

                                                            <select name="status" class="form-control mb-2">
                                                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                            </select>

                                                            @if($category->getFirstMediaUrl('category-logo'))
                                                                <div class="mb-2">
                                                                    <img src="{{ $category->getFirstMediaUrl('category-logo') }}" alt="Category Image" width="100">
                                                                </div>
                                                            @endif
                                                            <input type="file" name="image" class="form-control">

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary">Update</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>


                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" >
                                                @csrf @method('DELETE')
                                                @if ($category->added_by === auth()->id()|| auth()->user()->role === 'admin')
                                                <button class="btn btn-sm"><i class="fa-solid fa-trash" style="color:red"></i></button>
                                                @else
                                                <button disabled class="btn btn-sm"><i class="fa-solid fa-trash" style="color:rgb(43, 42, 42)"></i></button>

                                                @endif
                                            </form>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Add Category</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="text" name="name" class="form-control mb-2" placeholder="Name">

                <select name="parent_id" class="form-control mb-2">
                    <option value="">Main</option>
                    @foreach($categories as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>

                <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

                <select name="status" class="form-control mb-2">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

                <input type="file" name="image" class="form-control">

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">Save</button>
            </div>

        </form>
    </div>
</div>

@endsection
