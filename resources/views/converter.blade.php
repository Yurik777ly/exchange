@extends('layouts.app')

@section('content')
    <div class="exchange-all">
        {{ json_encode($data) }}
    </div>
@endsection
