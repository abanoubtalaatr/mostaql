@extends('layouts.front')
@section('content')
    @livewire('user.proposal.show',['proposal'=> $proposal])
@endsection
