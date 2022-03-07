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
                <h3>Edycja informacji o stacji</h3>
                <?php
                    echo $this->Form->control('nr_stacji');
                    echo $this->Form->control('miejscowosc', ['label'=>'Miejscowość']);
                    echo $this->Form->control('adres_masztu');
                    echo $this->Form->control('decyzja_pnb');
                    echo $this->Form->control('nazwa_budowy');
                    echo $this->Form->control('wyskosc', ['label'=>'Wysokość']);
                    echo $this->Form->control('odstepstwa_od_projektu', ['label'=>'Odstępstwa Od Projektu']);
                    echo $this->Form->control('investor_id', ['options' => $investors, 'label'=>'Inwestor']);
                    echo $this->Form->control('manager_id', ['options' => $managers, 'label'=>'Kierownik']);
                    echo $this->Form->control('inspector_id', ['options' => $inspectors, 'label'=>'Inspektor']);
                    echo $this->Form->control('representative_id', ['options' => $representatives, 'label'=>'Przedstawiciel']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Zatwierdź')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
