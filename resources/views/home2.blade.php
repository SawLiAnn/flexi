@extends('layouts.customer')
@section('content')
Home. Company name is {{$subdomain}}
<a href="{{route('book.index')}}">elo</a>
{{-- <a href="{{ route('book.index') }}"><button>Book Now</button></a> --}}
@endsection