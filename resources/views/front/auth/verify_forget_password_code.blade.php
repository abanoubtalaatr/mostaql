@extends('layouts.forgot_password')
@section('content')
@livewire('front.verify-forget-password-code',compact('user'))
@endsection
