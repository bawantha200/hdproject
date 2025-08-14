@extends('admin.layouts.master')
@section('content')
<main class="pt-10">
    <div class="container mx-auto">
        <section class="my-account">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h2>
            <div class="flex flex-col lg:flex-row gap-8">
               
                
                <!-- Orders Section -->
                <div class="lg">
                    <div class="bg-white rounded-lg shadow">
                        <!-- Filter Section -->
                        <div class="p-4 border-b">
                            <form method="GET" action="">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                                            <option value="">All Statuses</option>
                                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                            <option value="ordered" {{ request('status') == 'ordered' ? 'selected' : '' }}>Ordered</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Order No, Name or Phone" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div class="flex items-end gap-2">
                                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md w-full">
                                            Filter
                                        </button>
                                        <a href="{{ route('user.account.orders') }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md w-full text-center">
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Orders Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">OrderNo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Phone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Subtotal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tax</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Order Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Items</th>
                                        <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ '1' . str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">LKR {{ number_format($order->subtotal, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">LKR {{ number_format($order->tax, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">LKR {{ number_format($order->total, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status == 'delivered')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Canceled</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Ordered</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ $order->days }}
                                        </td>
                                        <!-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="" class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td> -->
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                            No orders found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                            {{ $orders->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection