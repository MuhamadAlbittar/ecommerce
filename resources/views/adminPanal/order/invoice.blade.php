<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة الطلب #{{ $order->id }}</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet"
          href="{{ asset('adminPanal/icons/fontawesome/css/all.css') }}">

    <style>
        /* ===== متغيرات الألوان ===== */
        :root {
            --primary: #266663;
            --primary-light: #e8f5f4;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* ===== صفحة الطباعة تكون بيضاء فقط ===== */
        @media print {
            body { background: #fff !important; }
            .no-print { display: none !important; }
            .invoice-wrapper { box-shadow: none !important; margin: 0 !important; }
            @page { margin: 1.5cm; }
        }

        .invoice-wrapper {
            max-width: 860px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        /* ===== Header ===== */
        .invoice-header {
            background: var(--primary);
            color: #fff;
            padding: 40px;
        }

        .invoice-header .company-name {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .invoice-header .invoice-number {
            font-size: 14px;
            opacity: 0.85;
        }

        .invoice-badge {
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
        }

        /* ===== Status Badge ===== */
        .status-pending  { background:#fff8e1; color:#ca8a04; }
        .status-complete { background:#e8f5e9; color:#2e7d32; }

        /* ===== جدول المنتجات ===== */
        .products-table th {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            border: none;
            padding: 12px 16px;
        }

        .products-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .products-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== Footer ===== */
        .invoice-footer {
            background: var(--primary-light);
            border-top: 2px solid var(--primary);
            padding: 20px 40px;
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        .total-box {
            background: var(--primary);
            color: #fff;
            border-radius: 8px;
            padding: 16px 24px;
        }

        .print-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 28px;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(38,102,99,0.4);
            cursor: pointer;
            transition: all 0.2s;
            z-index: 999;
        }

        .print-btn:hover {
            background: #1a4e4b;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    {{-- زر الطباعة (يختفي عند الطباعة) --}}
    <div class="no-print">
        <div class="container-fluid py-3 px-4 bg-white border-bottom d-flex gap-2">
            <button onclick="window.print()" class="btn btn-sm text-white"
                    style="background:#266663;">
                <i class="fas fa-print me-1"></i> طباعة الفاتورة
            </button>
            <a href="{{ route('orders.show', $order->id) }}"
               class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-right me-1"></i> العودة للطلب
            </a>
            <a href="{{ route('orders.index') }}"
               class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-list me-1"></i> قائمة الطلبات
            </a>
        </div>
    </div>

    {{-- ===== الفاتورة ===== --}}
    <div class="invoice-wrapper">

        {{-- Header --}}
        <div class="invoice-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="company-name">
                        <i class="fas fa-store me-2"></i>
                        {{ config('app.name', 'متجرنا') }}
                    </div>
                    <div class="invoice-number mt-1">
                        <i class="fas fa-file-invoice me-1"></i>
                        فاتورة رقم: <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <span class="invoice-badge">
                        @if($order->status === 'completed')
                            <i class="fas fa-check-circle me-1"></i> مكتملة
                        @else
                            <i class="fas fa-clock me-1"></i> معلقة
                        @endif
                    </span>
                    <div class="mt-2 opacity-75 small">
                        <i class="fas fa-calendar me-1"></i>
                        تاريخ الإصدار: {{ $order->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-4">

            {{-- ===== معلومات العميل والطلب ===== --}}
            <div class="row g-4 mb-4">

                {{-- بيانات العميل --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-3" style="background:#f8f9fa;border-right:4px solid #266663;">
                        <div class="text-muted small fw-semibold mb-2">
                            <i class="fas fa-user me-1"></i> بيانات العميل
                        </div>
                        <div class="fw-bold">{{ $order->user->name ?? 'غير معروف' }}</div>
                        @if($order->user?->email)
                            <div class="small text-muted">{{ $order->user->email }}</div>
                        @endif
                        @if($order->user?->phone)
                            <div class="small text-muted">{{ $order->user->phone }}</div>
                        @endif
                        @if($order->user?->city)
                            <div class="small text-muted">
                                {{ $order->user->city }}
                                @if($order->user->country), {{ $order->user->country }}@endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- بيانات الفاتورة --}}
                <div class="col-md-6">
                    <div class="p-3 rounded-3" style="background:#f8f9fa;border-right:4px solid #266663;">
                        <div class="text-muted small fw-semibold mb-2">
                            <i class="fas fa-info-circle me-1"></i> تفاصيل الفاتورة
                        </div>
                        <table class="table table-sm table-borderless mb-0 small">
                            <tr>
                                <td class="text-muted ps-0">رقم الفاتورة:</td>
                                <td class="fw-semibold">
                                    #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted ps-0">تاريخ الطلب:</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted ps-0">طريقة الدفع:</td>
                                <td>
                                    {{ $order->payments->first()?->paymentMethod?->name ?? 'غير محدد' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted ps-0">الحالة:</td>
                                <td>
                                    <span class="badge {{ $order->status === 'completed' ? 'status-complete' : 'status-pending' }} px-2 py-1 rounded">
                                        {{ $order->status === 'completed' ? 'مكتمل' : 'معلق' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            {{-- ===== جدول المنتجات ===== --}}
            <div class="mb-4">
                <h6 class="fw-bold mb-3" style="color:#266663;">
                    <i class="fas fa-shopping-cart me-2"></i>تفاصيل المنتجات
                </h6>
                <div class="table-responsive">
                    <table class="table products-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المنتج</th>
                                <th>البائع</th>
                                <th class="text-center">الكمية</th>
                                <th class="text-center">سعر الوحدة</th>
                                <th class="text-center">المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $index => $item)
                                <tr>
                                    <td class="text-muted small">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $item->product->name ?? 'منتج محذوف' }}
                                        </div>
                                        @if($item->product?->sku)
                                            <small class="text-muted">
                                                SKU: {{ $item->product->sku }}
                                            </small>
                                        @endif
                                    </td>
                                    <td class="text-muted small">
                                        {{ $item->vendor->name ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">
                                        ${{ number_format($item->price_at_time / 100, 2) }}
                                    </td>
                                    <td class="text-center fw-semibold" style="color:#266663;">
                                        ${{ number_format(($item->price_at_time * $item->quantity) / 100, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===== ملخص المبالغ ===== --}}
            <div class="row justify-content-end mb-4">
                <div class="col-md-5">
                    <div class="total-box">
                        <div class="d-flex justify-content-between mb-2 opacity-75">
                            <span>عدد المنتجات</span>
                            <span>{{ $order->orderItems->count() }} منتج</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 opacity-75">
                            <span>المجموع الفرعي</span>
                            <span>
                                ${{ number_format($order->total_price / 100, 2) }}
                            </span>
                        </div>
                        <hr class="border-white opacity-25 my-2">
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>الإجمالي الكلي</span>
                            <span>${{ number_format($order->total_price / 100, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ملاحظات --}}
            <div class="p-3 rounded-3 small text-muted" style="background:#fffde7;border-right:3px solid #ffc107;">
                <i class="fas fa-info-circle me-1 text-warning"></i>
                شكراً لثقتكم في متجرنا. هذه الفاتورة وثيقة رسمية تؤكد تفاصيل طلبكم.
                للاستفسارات تواصلوا معنا عبر البريد الإلكتروني.
            </div>

        </div>
        {{-- نهاية الـ Body --}}

        {{-- Footer --}}
        <div class="invoice-footer">
            <i class="fas fa-store me-1"></i>
            {{ config('app.name') }} &mdash;
            جميع الحقوق محفوظة {{ date('Y') }} &mdash;
            <span>{{ config('app.url') }}</span>
        </div>

    </div>
    {{-- نهاية invoice-wrapper --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
