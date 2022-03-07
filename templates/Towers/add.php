<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tower $tower
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="towers form content">
            <?= $this->Form->create($tower) ?>
            <fieldset>
                <h3>Dodawanie stacji</h3>
                <?php
                    echo $this->Form->control('nr_stacji');
                    echo $this->Form->control('miejscowosc', ['label'=>'Miejscowość']);
                    echo $this->Form->control('adres_masztu');
                    echo $this->Form->control('decyzja_pnb');
                    echo $this->Form->control('nazwa_budowy');
                    echo $this->Form->control('wyskosc', ['label'=>'Wysokosc']);
                    echo $this->Form->control('odstepstwa_od_projektu', ['label'=>'Odstępstwa Od Projektu']);
                    echo $this->Form->control('investor_id', ['options' => $investors, 'label'=>'Inwestor', 'empty' => 'wybierz inwestora']);
                    echo $this->Form->control('manager_id', ['options' => $managers, 'label'=>'Kierownik', 'empty' => 'wybierz kierownika']);
                    echo $this->Form->control('inspector_id', ['options' => $inspectors, 'label'=>'Inspektor', 'empty' => 'wybierz inspektora']);
                    echo $this->Form->control('representative_id', ['options' => $representatives, 'label'=>'Przedstawiciel', 'empty' => 'wybierz przedstawiciela']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
