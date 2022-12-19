<div class="py-4 px-3 ">
    <x-loading-indicator />
    <div class="d-flex justify-content-between  mb-4">
        <h3 class="over-title mb-2">Sorties des materiels du site {{ $site }}<span class="text-bold" id="title"> </span>
        </h3>

        <select wire:model="annee" id="list" class="  form-group float-end mb-2 ">
                <option disabled="disabled">Choisir une année</option>
                <option selected="true" value="all" @if ($annee == "all") selected="selected" @endif>Tout
                </option>
                <option value="2022" @if ('2022' == $annee) selected="selected" @endif>2022 </option>
                <option value="2023" @if ('2023' == $annee) selected="selected" @endif>2023 </option>
                <option value="2024" @if ('2024' == $annee) selected="selected" @endif>2024 </option>

        </select>

    </div>

    <div class="card ">
        <div class="card-header">
            <ul class="nav nav-tabs nav-justified card-header-tabs" id="sorties" role="tablist">
                <x-month-header :moisc="$mois" moisl="janvier" :cnts="$cnts[1]" i="01" />
                <x-month-header :moisc="$mois" moisl="février" :cnts="$cnts[2]" i="02" />
                <x-month-header :moisc="$mois" moisl="mars" :cnts="$cnts[3]" i="03" />
                <x-month-header :moisc="$mois" moisl="avril" :cnts="$cnts[4]" i="04" />
                <x-month-header :moisc="$mois" moisl="mai" :cnts="$cnts[5]" i="05" />
                <x-month-header :moisc="$mois" moisl="juin" :cnts="$cnts[6]" i="06" />
                <x-month-header :moisc="$mois" moisl="juillet" :cnts="$cnts[7]" i="07" />
                <x-month-header :moisc="$mois" moisl="aôut" :cnts="$cnts[8]" i="08" />
                <x-month-header :moisc="$mois" moisl="septembre" :cnts="$cnts[9]" i="09" />
                <x-month-header :moisc="$mois" moisl="octobre" :cnts="$cnts[10]" i="10" />
                <x-month-header :moisc="$mois" moisl="novembre" :cnts="$cnts[11]" i="11" />
                <x-month-header :moisc="$mois" moisl="décembre" :cnts="$cnts[12]" i="12" />
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="janvier" :results="$results[1]" type="sortie" i="01"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="février" :results="$results[2]" type="sortie" i="02"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="mars" :results="$results[3]" type="sortie" i="03"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="avril" :results="$results[4]" type="sortie" i="04"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="mai" :results="$results[5]" type="sortie" i="0"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="juin" :results="$results[6]" type="sortie" i="06"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="juillet" :results="$results[7]" type="sortie" i="07"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="aôut" :results="$results[8]" type="sortie" i="08"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="septembre" :results="$results[6]" type="sortie" i="09"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="octobre" :results="$results[10]" type="sortie" i="10"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="novembre" :results="$results[1]" type="sortie" i="11"/>
            </div>
            <div class="tab-content my-2">
                <x-month-table :moisc="$mois" moisl="décembre" :results="$results[12]" type="sortie" i="12"/>
            </div>
        </div>
    </div>
    
</div>
