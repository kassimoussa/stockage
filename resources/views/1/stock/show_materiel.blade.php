@extends('1.layout', ['page' => 'Page de materiel', 'pageSlug' => 'stocks'])
@section('content')

   <div class="">

   <livewire:stock-rentree :stock="$stock" />


    </div> 
@endsection