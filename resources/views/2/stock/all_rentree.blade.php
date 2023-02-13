@extends('2.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')
    <div class="">

        <livewire:stock-all-rentrees :site="$site" />

        

    </div>

    <style>
        .btn-default:hover {
            background-color: red !important;
            color: white;
        }

        .btn-primary {
            color: white;
        }

        .txt {
            width: 150px;
            background: lavender;
        }

        .iput {
            background: white !important;
        }

        .cbox {}
    </style>

    <script>
        $('#rentrees a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        });
    </script>
@endsection
