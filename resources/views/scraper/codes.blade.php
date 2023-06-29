@extends('layout.app')
@section('content')
<div>
    <h1>{{$mot}}</h1>
    @foreach($codes as $i => $code)
        <h3>Numéro {{$i + 1}}</h3>
        <p>{{$code}}</p>
    @endforeach
</div>
@endsection