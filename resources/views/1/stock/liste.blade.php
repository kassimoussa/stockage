@extends('1.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')

<div class="conainer">

    <livewire:toggle-stock :site="$site" />

</div>

    
    <script>
        function addInput() {
            $(document).ready(function() {
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML =
                `<div class='input-group'>
                    <a class='input-group-text icon remove_button' onclick='removeInput()'>
                        <i class='fa fa-minus' aria-hidden='true'></i>
                        </a>
                    <input type='text' class='form-control' name='nom_materiel[]'' placeholder='Nom du matériel' required >
                    <input type='number' class='form-control' name='quantite[]' placeholder='Quantité' required >
                    <input type="file" name="filename[]" class="form-control" accept="image/*">
                </div>`; 
                var x = 1; //Initial field counter is 1

                //Once add button is clicked

                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }


                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        }
    </script>

@endsection
