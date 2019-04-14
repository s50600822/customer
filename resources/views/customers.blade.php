@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th># of Orders</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $customer)
            <tr>
                <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                <td>{{ $customer_with_order_count[$customer->id] }}</td>
                <td><a href="/customers/{{ $customer->id }}">detail</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
