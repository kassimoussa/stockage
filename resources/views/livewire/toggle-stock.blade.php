<div>
    <x-loading-indicator />

    <div class="d-flex justify-content-between ">
        <h3 class="over-title ">Stock du site {{ $site }} </h3>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a role="button" wire:click="focus('1')" type="button" class="btn  {{ $tab1 }} fw-bold">Materiels </a>
            <a role="button" wire:click="focus('2')" type="button" class="btn  {{ $tab2 }} fw-bold">Categories</a>
            <a role="button" wire:click="focus('3')" type="button" class="btn  {{ $tab3 }} fw-bold">Marques </a>
            <a role="button" wire:click="focus('4')" type="button" class="btn  {{ $tab4}} fw-bold">Models </a>
            <a role="button" wire:click="focus('5')" type="button" class="btn  {{ $tab5}} fw-bold">Sorties </a>
        </div>
    </div>



    @if ($ftab == 1)
    <livewire:materiels-management :site="$site" />
    @elseif ($ftab == 2)
    <livewire:categories-management :site="$site" />
    @elseif ($ftab == 3)
    <livewire:marques-management :site="$site" />
    @elseif ($ftab == 4)
    <livewire:models-management :site="$site" />
    @elseif ($ftab == 5)
    <livewire:gestion-sorties :site="$site" />
    @endif



</div>