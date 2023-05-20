@extends('layouts.front')
@section('content')
    @livewire('front.reset' ,['token'=>$token])
@endsection
