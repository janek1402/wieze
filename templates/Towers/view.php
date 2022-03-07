<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tower $tower
 */

use PhpOffice\PhpWord\Style;

?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="towers view content">
            <h3>Informacje o stacji</h3>
            <table>
                <tr>
                    <th><?= __('Nr Stacji') ?></th>
                    <td><b><?= h($tower->nr_stacji) ?></b></td>
                </tr>
                <tr>
                    <th><?= __('Miejscowość') ?></th>
                    <td><?= h($tower->miejscowosc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inwestor') ?></th>
                    <td><?= $tower->has('investor') ? $this->Html->link($tower->investor->nazwa, ['controller' => 'Investors', 'action' => 'view', $tower->investor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Kierownik') ?></th>
                    <td><?= $tower->has('manager') ? $this->Html->link($tower->manager->nazwa, ['controller' => 'Managers', 'action' => 'view', $tower->manager->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Inspektor') ?></th>
                    <td><?= $tower->has('inspector') ? $this->Html->link($tower->inspector->nazwa, ['controller' => 'Inspectors', 'action' => 'view', $tower->inspector->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Przedstawiciel') ?></th>
                    <td><?= $tower->has('representative') ? $this->Html->link($tower->representative->nazwa, ['controller' => 'Representatives', 'action' => 'view', $tower->representative->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Wysokość') ?></th>
                    <td><?= $this->Number->format($tower->wyskosc) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Adres Masztu') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tower->adres_masztu)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Decyzja Pnb') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tower->decyzja_pnb)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Nazwa Budowy') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tower->nazwa_budowy)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Odstępstwa Od Projektu') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tower->odstepstwa_od_projektu)); ?>
                </blockquote>
            </div>
            <br>
            <div class="text">
                <strong><?= __('Kliknij aby przejść do dokumentacji') ?></strong>
                <br>
                <br>
                <?= $this->Html->link('Dokumentacja', ['controller' => 'documents', 'action' => 'showTower', $tower['id']], ['class' => 'button', 'style' => 'color: white; width: 100%']) ?>
            </div>
            <br>
            <br>
            <br>
            <div>
            <?= $this->Html->link('Dodaj', ['controller' => 'uploads', 'action' => 'index'], ['class' => 'button', 'style' => 'float: right']) ?>
                <h3>Załączone zdjęcia</h3>
            </div>
            <hr>
            <?php foreach ($stages as $stage_id => $stage) :  ?>
                <div>
                    <span class="big-font-h4"><?= $stage ?></span>
                </div>
                <?php if (count($images[$stage_id]) > 0) : ?>
                    <?= $this->Form->create(null, ['url' => ['action' => 'deleteImages'], 'type' => 'post', 'onsubmit' => 'return potwierdz()']) ?>
                    <?= $this->Form->hidden('tower_id', ['value' => $tower['id']]); ?>
                    <?= $this->Form->hidden('stage_id', ['value' => $stage_id]); ?>
                    <div>
                        <?= $this->Html->link('Pobierz wszystkie', ['controller' => 'towers', 'action' => 'getImages', $tower['id'], $stage_id], ['class' => 'button', 'style' => 'float: right; position: relative; left: 1.5rem']) ?>
                        <?= $this->Form->button('Usuń zaznaczone', ['class' => 'button', 'style' => 'float: right']) ?>
                    </div>
                    <div class="grid">
                        <?php foreach ($images[$stage_id] as $image) : ?>
                            <div class="gallery-item">
                                <?= $this->Html->image("../docs/" . $tower['id'] . "/$stage_id/tumb/$image", ['class' => "single-image"]); ?>
                                <?= $this->Form->checkbox('todelete[]', ['value' => $image, 'hiddenField' => false]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?= $this->Form->end() ?>
                <?php endif; ?>
                <hr>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<script>
    function potwierdz() {
        return confirm(`Czy napewno chcesz usunąć te zdjęcia?`);
    }
</script>