@extends('backend.master')

@section('title')
    Dashboard 
@endsection

@section('content')

    @role('user')
            <h1>Hello User</h1>
    @endrole 

    @role('super-admin')
            <h1>Hello Super Admin</h1>
    @endrole 


@endsection
