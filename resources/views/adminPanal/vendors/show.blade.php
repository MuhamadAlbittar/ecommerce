@extends('layouts.app')
@section('content')
 <div class="main-content">
                <div class="product-section px-0 px-md-0 px-lg-3 mt-150">
                    <div class="container">
                           <h1 class="mb-5">{{ $vendor->name . " " ."Store"}}</h1>
                            <div class="d-flex align-items-center gap-5 flex-row mb-5">
                                   <div class="mb-3"><img src="{{ $vendor->getFirstMediaUrl('vendor-logo') }}" alt="Vendor Image" class="img-fluid" width="100"></div>
                                    <div class="d-flex align-items-center flex-column">
                                        <div class="mb-3">Email: <label for="email" class="form-label">{{ $vendor->email }}</label></div>
                                        <div class="mb-3">Phone: <label for="phone" class="form-label">{{ $vendor->phone }}</label></div>
                                    </div>
                            </div>
                            <h1>Users for this Vendor</h1>
                            @can('updateUser', $vendor)
                            <div class="table-responsive">
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    Add User
                                </button>
                            @endcan
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3">ID</th>
                                        <th scope="col" class="py-3">Image</th>
                                        <th scope="col" class="py-3">Name</th>
                                        <th scope="col" class="py-3">Email</th>
                                        <th scope="col" class="py-3">Phone</th>
                                        <th scope="col" class="py-3">role</th>
                                        <th scope="col" class="py-3">permissions</th>
                                            @can('updateUser', $vendor)
                                        <th scope="col" class="py-3">Actions</th>
                                            @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendor->users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><img src="{{ $user->getFirstMediaUrl('user-logo') }}" alt="User Image" class="img-fluid" width="100"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->pivot->role }}</td>
                                       <td>
                                        @if($user->pivot->permissions)
                                            <ul class="list-disc ps-3">
                                                @foreach($user->pivot->permissions as $permission)
                                                    <li>{{ $permission }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        </td>
                                         @can('updateUser', $vendor)
                                        <td>

                                           <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                <i class="fa-solid fa-edit" style="color:green"></i>
                                            </button>

                                            <!-- Edit User Modal -->
                                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form action="{{ route('vendors.users.update', [$vendor->id, $user->id]) }}" method="POST" class="modal-content">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <!-- USER NAME (readonly) -->
                                                        <div class="mb-3">
                                                            <label>User</label>
                                                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                                        </div>

                                                        <!-- ROLE -->
                                                        <div class="mb-3">
                                                            <label>Role</label>
                                                            <select name="role" class="form-control">
                                                                <option value="manager" {{ $user->pivot->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                                                <option value="staff" {{ $user->pivot->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                                            </select>
                                                        </div>

                                                        <!-- PERMISSIONS -->
                                                        @php
                                                            $permissions = $user->pivot->permissions ?? [];
                                                        @endphp

                                                        <div>
                                                            <label>Permissions</label><br>

                                                            <input type="checkbox" name="permissions[]" value="add_categories"
                                                                {{ in_array('add_categories', $permissions) ? 'checked' : '' }}>
                                                            Add Categories<br>

                                                            <input type="checkbox" name="permissions[]" value="edit_categories"
                                                                {{ in_array('edit_categories', $permissions) ? 'checked' : '' }}>
                                                            Edit Categories<br>

                                                            <input type="checkbox" name="permissions[]" value="delete_categories"
                                                                {{ in_array('delete_categories', $permissions) ? 'checked' : '' }}>
                                                            Delete Categories<br>

                                                            <input type="checkbox" name="permissions[]" value="add_products"
                                                                {{ in_array('add_products', $permissions) ? 'checked' : '' }}>
                                                            Add Products<br>

                                                            <input type="checkbox" name="permissions[]" value="edit_products"
                                                                {{ in_array('edit_products', $permissions) ? 'checked' : '' }}>
                                                            Edit Products<br>

                                                            <input type="checkbox" name="permissions[]" value="delete_products"
                                                                {{ in_array('delete_products', $permissions) ? 'checked' : '' }}>
                                                            Delete Products<br>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>

                                                </form>
                                            </div>
                                            </div>

                                            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this vendor?')"><i class="fa-solid fa-trash" style="color:red"></i></button>
                                            </form>

                                        </td>
                                         @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Add User Modal --}}
                        <div class="modal fade" id="addUserModal" tabindex="-1">
                        <div class="modal-dialog">
                        <form action="{{ route('vendors.users.store', $vendor->id) }}" method="POST" class="modal-content">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <!-- USER -->
                                <div class="mb-3">
                                    <label>User</label>
                                    <select name="user_id" class="form-control" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- ROLE -->
                                <div class="mb-3">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="manager">Manager</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>

                                <!-- PERMISSIONS -->
                                <div>
                                    <label>Permissions</label><br>
                                    <input type="checkbox" name="permissions[]" value="add_categories"> Add Categories<br>
                                    <input type="checkbox" name="permissions[]" value="edit_categories"> Edit Categories<br>
                                    <input type="checkbox" name="permissions[]" value="delete_categories"> Delete Categories<br>
                                    <input type="checkbox" name="permissions[]" value="add_products"> Add Products<br>
                                    <input type="checkbox" name="permissions[]" value="edit_products"> Edit Products<br>
                                    <input type="checkbox" name="permissions[]" value="delete_products"> Delete Products<br>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>

                            </form>
                            </div>
                    </div>
                    </div>
                </div>
           </div>

@endsection
