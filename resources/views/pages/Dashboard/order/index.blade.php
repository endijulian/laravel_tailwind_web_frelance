@extends('layouts.app')

@section('title', 'My Orders')

@section('content')


<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    My Orders
                </h2>
                <p class="text-sm text-gray-400">
                    {{ auth()->user()->order_freelancer->count(); }} Total Orders
                </p>
            </div>
            <div class="col-span-4 lg:text-right">

            </div>
        </div>
    </div>
    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                    <table class="w-full" aria-label="Table">
                        <thead>
                            <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                <th class="py-4" scope="">Buyers Name</th>
                                <th class="py-4" scope="">Service Details</th>
                                <th class="py-4" scope="">Expires</th>
                                <th class="py-4" scope="">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">

                            @forelse ($orders as $order)

                            <tr class="text-gray-700 border-b">
                                <td class="px-1 py-5 text-sm w-2/8">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-10 h-10 mr-3 rounded-full md:block">

                                            @if ($order->user_buyer->detail_user->photo != null)
                                                <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($order->user_buyer->detail_user->photo) }}" alt="" loading="lazy" />
                                            @else
                                                <p>No Image</p>
                                            @endif

                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-medium text-black">{{ $order->user_buyer->name ?? '' }}</p>
                                            <p class="text-sm text-gray-400">{{ $order->user_buyer->detail_user->role ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-2/6 px-1 py-5">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-10 h-10 mr-3 rounded-full md:block">

                                            @if ($order->service->thumbnail_service[0]->thumbnail != null)
                                                <img class="object-cover w-full h-full rounded" src="{{ Storage::url($order->service->thumbnail_service[0]->thumbnail) }}" alt="" loading="lazy" />
                                            @else
                                                <p>No Image</p>
                                            @endif

                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-medium text-black">
                                                {{ $order->service->title ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-1 py-5 text-xs text-red-500">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline mb-1">
                                        <path d="M7.0002 12.8332C10.2219 12.8332 12.8335 10.2215 12.8335 6.99984C12.8335 3.77818 10.2219 1.1665 7.0002 1.1665C3.77854 1.1665 1.16687 3.77818 1.16687 6.99984C1.16687 10.2215 3.77854 12.8332 7.0002 12.8332Z" stroke="#F26E6E" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7 3.5V7L9.33333 8.16667" stroke="#F26E6E" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    {{ (strtotime($order->expired) - strtotime(date('Y-m-d'))) / 86400 }} days left
                                </td>

                                <td class="px-1 py-5 text-sm">

                                    @if ($order->order_status_id == '1')
                                        <a href="{{ route('member.order.show', $order->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-email">
                                            Details</a>
                                        <a href="{{ route('member.order.edit', $order->id) }}" class="px-4 py-2 mt-2 text-center text-green-500 rounded-xl bg-serv-email">
                                            Approved
                                        </a>
                                    @elseif ($order->order_status_id == '2')
                                        <a href="{{ route('member.order.show', $order->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-email">
                                            Details</a>
                                        <a href="{{ route('member.order.edit', $order->id) }}" class="px-4 py-2 mt-2 text-center text-white rounded-xl bg-serv-email">
                                            Submit
                                        </a>
                                    @elseif ($order->order_status_id == '3')
                                        <a href="{{ route('member.order.show', $order->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-email">
                                            Details
                                        </a>

                                        <p class="px-4 py-2 mt-1 text-left text-red-500">Rejected</p>

                                    @elseif ($order->order_status_id == '4')

                                        <a href="{{ route('member.accept.order', $order->id) }}" class="px-4 py-2 mt-1 mr-2 text-center text-white rounded-xl bg-serv-button">
                                            Accept
                                        </a>

                                        <a href="{{ route('member.reject.order', $order->id) }}" class="px-4 py-2 mt-2 text-center bg-white rounded-xl">
                                            Reject
                                        </a>
                                    @endif

                                </td>

                            </tr>

                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </section>
</main>

@endsection
