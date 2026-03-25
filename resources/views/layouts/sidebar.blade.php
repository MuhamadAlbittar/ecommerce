       <div class="sidebar">
               <div class="collapse-sidebar d-none d-lg-block"><span><i class="fa-solid fa-chevron-left"></i></span></div>
               <div class="sidebar-header">
                   <div class="lg-logo"><a href="{{ route('dashboard') }}"><img src="{{ asset('adminPanal/images/logo.png') }}" alt="logo large"></a></div>
                   <div class="sm-logo"><a href="{{ route('dashboard') }}"><img src="{{ asset('adminPanal/images/sm-logo.png') }}" alt="logo small"></a></div>
               </div>
               <div class="sidebar-body  custom-scrollbar">
                    <ul class="sidebar-menu">
                        <li class="sidebar-label">Menu</li>
                        <li><a href="index.html" class="text-black sidebar-link active"><i class="fa-solid fa-house"></i><p>Dashboard</p></a></li>
                         @if (auth()->user()->role !== 'customer')
                        <li><a href="{{ route('sellers.index') }}" class="text-black sidebar-link">
                            <i class="fa-regular fa-user"></i><p>sellers</p></a></li>
                        @endif




                        @if(auth()->user()->role === 'seller')
                        <li><a href="user-list.html" class="text-black sidebar-link"><i class="fa-regular fa-user"></i><p>Customers</p></a></li>

                        <li><a href="{{ route('vendors.index') }}" class="text-black sidebar-link">
                            <i class="fa-regular fa-store"></i><p>vendors</p></a></li>
                        <li><a href="#" class="text-black sidebar-link submenu-parent"><i class="fa-solid fa-list"></i><p>Category <i class="fa-solid fa-angle-down right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('categories.create') }}" class="submenu-link">Add</a></li>
                                <li><a href="{{ route('categories.index') }}" class="submenu-link">List</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="text-black sidebar-link submenu-parent"><i class="fa-brands fa-microsoft"></i><p>Products <i class="fa-solid fa-angle-down right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('products.create') }}" class="submenu-link">Add</a></li>
                                <li><a href="{{ route('products.index') }}" class="submenu-link">List</a></li>
                            </ul>
                        </li>
                        <li><a href="#" class="text-black sidebar-link submenu-parent"><i class="fa-solid fa-bucket"></i><p>Order <i class="fa-solid fa-angle-down right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('orders.index') }}" class="submenu-link">List</a></li>
                                <li><a href="{{ route('orders.show', 1) }}" class="submenu-link">Details</a></li>
                                <li><a href="{{ route('orders.Invoice', 1) }}" class="submenu-link">Invoice</a></li>{{--{{ route('orders.invoice', 1) }}--}}
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="text-black sidebar-link submenu-parent">
                                <i class="fa-solid fa-credit-card"></i>
                                <p>Payment Methods <i class="fa-solid fa-angle-down right-icon"></i></p>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('payment-methods.create') }}" class="submenu-link">Add</a></li>
                                <li><a href="{{ route('payment-methods.index') }}" class="submenu-link">List</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="text-black sidebar-link submenu-parent">
                                <i class="fa-solid fa-truck-fast"></i>
                                <p>Shipping Methods <i class="fa-solid fa-angle-down right-icon"></i></p>
                            </a>

                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('shipping-methods.create') }}" class="submenu-link">Add</a></li>
                                <li><a href="{{ route('shipping-methods.index') }}" class="submenu-link">List</a></li>
                            </ul>
                        </li>
                        @endif


                        <li><a href="#" class="text-black sidebar-link"><i class="fa-regular fa-message"></i><p>Message</p></a></li>
                        <li><a href="{{ route('support.index') }}" class="text-black sidebar-link"><i class="fa-solid fa-phone"></i><p>Help & Support</p></a></li>
                    </ul>
               </div>
        </div>
