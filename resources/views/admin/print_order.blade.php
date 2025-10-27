<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: #fff;
            padding: 20px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
        }
        
        .invoice-header {
            border-bottom: 3px solid {{ $setting->theme_one ?? '#007bff' }};
            padding-bottom: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-logo {
            max-height: 50px;
            width: auto;
            margin-bottom: 10px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .company-details {
            font-size: 11px;
            color: #666;
            line-height: 1.3;
        }
        
        .invoice-info {
            text-align: right;
            flex: 1;
        }
        
        .invoice-number {
            font-size: 28px;
            font-weight: bold;
            color: {{ $setting->theme_one ?? '#007bff' }};
            margin-bottom: 10px;
        }
        
        .invoice-date {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .info-section {
            border: 1px solid #ddd;
            padding: 15px;
            background: #f9f9f9;
        }
        
        .info-title {
            font-size: 13px;
            font-weight: bold;
            color: {{ $setting->theme_one ?? '#007bff' }};
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid {{ $setting->theme_one ?? '#007bff' }};
            padding-bottom: 5px;
        }
        
        .info-content {
            font-size: 11px;
            line-height: 1.4;
        }
        
        .info-content strong {
            font-weight: 600;
            color: #333;
        }
        
        .products-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: {{ $setting->theme_one ?? '#007bff' }};
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid {{ $setting->theme_one ?? '#007bff' }};
        }
        
        .products-table th {
            background: {{ $setting->theme_one ?? '#007bff' }};
            color: #fff;
            padding: 12px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .products-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
        }
        
        .products-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        .product-name {
            font-weight: 600;
            color: #333;
        }
        
        .variant-info {
            font-size: 10px;
            color: #666;
            margin-top: 2px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .totals-section {
            margin-top: 30px;
            border-top: 2px solid {{ $setting->theme_one ?? '#007bff' }};
            padding-top: 20px;
        }
        
        .totals-table {
            width: 100%;
            max-width: 300px;
            margin-left: auto;
        }
        
        .totals-table td {
            padding: 8px 12px;
            font-size: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        .total-label {
            font-weight: 600;
            color: #333;
        }
        
        .total-value {
            text-align: right;
            font-weight: 600;
            color: #333;
        }
        
        .grand-total {
            background: #f8f9fa;
            color: #333;
            font-weight: bold;
            font-size: 14px;
            border: 2px solid {{ $setting->theme_one ?? '#007bff' }};
        }
        
        .grand-total td {
            border: none;
            padding: 12px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-success {
            background: #28a745;
            color: #fff;
        }
        
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        
        .status-danger {
            background: #dc3545;
            color: #fff;
        }
        
        .primary-color {
            color: {{ $setting->theme_one ?? '#007bff' }};
        }
        
        .secondary-color {
            color: #6c757d;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            .invoice-container {
                max-width: none;
            }
            
            .print-button {
                display: none !important;
            }
            
            /* Ensure colors are preserved in print */
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: {{ $setting->theme_one ?? '#007bff' }};
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            z-index: 1000;
        }
        
        .print-button:hover {
            background: {{ $setting->theme_two ?? '#0056b3' }};
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <button class="print-button" onclick="window.print()">
        <i class="fas fa-print"></i> Print Invoice
    </button>
    
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="company-info">
                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->website_name }}" class="company-logo">
                <div class="company-details">
                    @if($setting->address)
                    {{ $setting->address }}<br>
                    @endif
                    @if($setting->phone)
                    Phone: {{ $setting->phone }}<br>
                    @endif
                    @if($setting->email)
                    Email: {{ $setting->email }}
                    @endif
                </div>
            </div>
            <div class="invoice-info">
                <div class="invoice-number">INVOICE #{{ $order->order_id }}</div>
                <div class="invoice-date">
                    <strong>Invoice Date:</strong> {{ $order->created_at->format('d/m/Y') }}
                </div>
            </div>
        </div>

        @php
            $orderAddress = $order->orderAddress;
        @endphp

        <!-- Billing and Shipping Information -->
        <div class="info-grid">
            <div class="info-section">
                <div class="info-title">Bill To</div>
                <div class="info-content">
                    <strong>{{ $orderAddress->billing_name }}</strong><br>
                    @if ($orderAddress->billing_email)
                    {{ $orderAddress->billing_email }}<br>
                    @endif
                    @if ($orderAddress->billing_phone)
                    {{ $orderAddress->billing_phone }}<br>
                    @endif
                    {{ $orderAddress->billing_address }},<br>
                    {{ $orderAddress->billing_city }}, {{ $orderAddress->billing_state }}, {{ $orderAddress->billing_country }}
                </div>
            </div>
            
            <div class="info-section">
                <div class="info-title">Ship To</div>
                <div class="info-content">
                    <strong>{{ $orderAddress->shipping_name }}</strong><br>
                    @if ($orderAddress->shipping_email)
                    {{ $orderAddress->shipping_email }}<br>
                    @endif
                    @if ($orderAddress->shipping_phone)
                    {{ $orderAddress->shipping_phone }}<br>
                    @endif
                    {{ $orderAddress->shipping_address }},<br>
                    {{ $orderAddress->shipping_city }}, {{ $orderAddress->shipping_state }}, {{ $orderAddress->shipping_country }}
                </div>
            </div>
        </div>

        <!-- Order Information -->
        <div class="info-grid">
            <div class="info-section">
                <div class="info-title">Payment Information</div>
                <div class="info-content">
                    <strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}<br>
                    <strong>Status:</strong> 
                    @if ($order->payment_status == 1)
                        <span class="status-badge status-success">Paid</span>
                    @else
                        <span class="status-badge status-pending">Pending</span>
                    @endif
                    @if($order->transection_id)
                    <br><strong>Transaction ID:</strong> {{ $order->transection_id }}
                    @endif
                </div>
            </div>
            
            <div class="info-section">
                <div class="info-title">Order Information</div>
                <div class="info-content">
                    <strong>Order Date:</strong> {{ $order->created_at->format('d F, Y') }}<br>
                    <strong>Shipping Method:</strong> {{ $order->shipping_method }}<br>
                    <strong>Order Status:</strong>
                    @if ($order->order_status == 1)
                        <span class="status-badge status-success">In Progress</span>
                    @elseif ($order->order_status == 2)
                        <span class="status-badge status-success">Delivered</span>
                    @elseif ($order->order_status == 3)
                        <span class="status-badge status-success">Completed</span>
                    @elseif ($order->order_status == 4)
                        <span class="status-badge status-danger">Declined</span>
                    @else
                        <span class="status-badge status-pending">Pending</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="products-section">
            <div class="section-title">Order Items</div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="35%">Product</th>
                        <th width="15%">Variant</th>
                        @if ($setting->enable_multivendor == 1)
                        <th width="15%">Shop</th>
                        @endif
                        <th width="10%" class="text-center">Unit Price</th>
                        <th width="8%" class="text-center">Qty</th>
                        <th width="12%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subTotal = 0;
                    @endphp
                    @foreach ($order->orderProducts as $index => $orderProduct)
                        @php
                            $variantPrice = 0;
                            $totalVariant = $orderProduct->orderProductVariants->count();
                        @endphp
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>
                                <div class="product-name">{{ $orderProduct->product_name }}</div>
                                @if($orderProduct->orderProductVariants->count() > 0)
                                <div class="variant-info">
                                    @foreach ($orderProduct->orderProductVariants as $indx => $variant)
                                        {{ $variant->variant_name.': '.$variant->variant_value }}{{ $totalVariant == ++$indx ? '' : ', ' }}
                                        @if($indx < $totalVariant)<br>@endif
                                        @php
                                            $variantPrice += $variant->variant_price;
                                        @endphp
                                    @endforeach
                                </div>
                                @endif
                            </td>
                            <td>
                                @if($orderProduct->orderProductVariants->count() > 0)
                                    @foreach ($orderProduct->orderProductVariants as $indx => $variant)
                                        {{ $variant->variant_name.': '.$variant->variant_value }}{{ $totalVariant == ++$indx ? '' : ', ' }}
                                        @if($indx < $totalVariant)<br>@endif
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            @if ($setting->enable_multivendor == 1)
                            <td>
                                @if ($orderProduct->seller)
                                    {{ $orderProduct->seller->shop_name }}
                                @else
                                    -
                                @endif
                            </td>
                            @endif
                            <td class="text-center">{{ $setting->currency_icon }}{{ number_format($orderProduct->unit_price, 2) }}</td>
                            <td class="text-center">{{ $orderProduct->qty }}</td>
                            @php
                                $total = ($orderProduct->unit_price * $orderProduct->qty);
                                $subTotal += $total;
                            @endphp
                            <td class="text-right">{{ $setting->currency_icon }}{{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals Section -->
        <div class="totals-section">
            <table class="totals-table">
                @php
                    $sub_total = $order->total_amount;
                    $sub_total = $sub_total - $order->shipping_cost;
                    $sub_total = $sub_total + $order->coupon_coast;
                @endphp
                <tr>
                    <td class="total-label">Subtotal</td>
                    <td class="total-value">{{ $setting->currency_icon }}{{ number_format($sub_total, 2) }}</td>
                </tr>
                @if($order->coupon_coast > 0)
                <tr>
                    <td class="total-label">Discount (-)</td>
                    <td class="total-value">{{ $setting->currency_icon }}{{ number_format($order->coupon_coast, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="total-label">Shipping</td>
                    <td class="total-value">{{ $setting->currency_icon }}{{ number_format($order->shipping_cost, 2) }}</td>
                </tr>
                <tr class="grand-total">
                    <td class="total-label">TOTAL</td>
                    <td class="total-value">{{ $setting->currency_icon }}{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>

        @if ($order->additional_info)
        <div style="margin-top: 30px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">
            <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Additional Information:</div>
            <div style="font-size: 11px; line-height: 1.4;">{!! clean(nl2br($order->additional_info)) !!}</div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for your business!</p>
            <p>For any questions regarding this invoice, please contact us.</p>
        </div>
    </div>
    
    <script>
        // Auto-trigger print dialog when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500); // Small delay to ensure page is fully loaded
        };
    </script>
</body>
</html>
