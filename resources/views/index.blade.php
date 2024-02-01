@extends('layouts.app')

@section('content')
<div class="exchange-all">
@foreach($data as $item)

        <div>From: {{ $item['from'] }} to: {{ $item['to'] }} rate: {{ $item['rate'] }}</div>
@endforeach
</div>
@endsection

