<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Manager $manager
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="managers view content">
            <h3><?= h($manager->nazwa) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nazwa') ?></th>
                    <td><?= h($manager->nazwa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Adres Ulica') ?></th>
                    <td><?= h($manager->adres_ulica) ?></td>
                </tr>
                <tr>
                    <th><?= __('Adres Miasto') ?></th>
                    <td><?= h($manager->adres_miasto) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefon') ?></th>
                    <td><?= h($manager->telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nr Uprawnien') ?></th>
                    <td><?= h($manager->nr_uprawnien) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Powiązane wieże') ?></h4>
                <?php if (!empty($manager->towers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nr Stacji') ?></th>
                            <th><?= __('Miejscowość') ?></th>
                            <th><?= __('Adres Masztu') ?></th>
                            <th><?= __('Decyzja Pnb') ?></th>
                            <th><?= __('Nazwa Budowy') ?></th>
                            <th><?= __('Wyskość') ?></th>
                            <th><?= __('Odstepstwa Od Projektu') ?></th>
                            <th><?= __('Inwestor') ?></th>
                            <th><?= __('Kierownik') ?></th>
                            <th><?= __('Inspektor') ?></th>
                            <th><?= __('Przedstawiciel') ?></th>
                            <th class="actions"><?= __('Działania') ?></th>
                        </tr>
                        <?php foreach ($manager->towers as $towers) : ?>
                        <tr>
                            <td><?= h($towers->id) ?></td>
                            <td><?= h($towers->nr_stacji) ?></td>
                            <td><?= h($towers->miejscowosc) ?></td>
                            <td><?= h($towers->adres_masztu) ?></td>
                            <td><?= h($towers->decyzja_pnb) ?></td>
                            <td><?= h($towers->nazwa_budowy) ?></td>
                            <td><?= h($towers->wyskosc) ?></td>
                            <td><?= h($towers->odstepstwa_od_projektu) ?></td>
                            <td><?= h($towers->investor_id) ?></td>
                            <td><?= h($towers->manager_id) ?></td>
                            <td><?= h($towers->inspector_id) ?></td>
                            <td><?= h($towers->representative_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Zobacz'), ['controller' => 'Towers', 'action' => 'view', $towers->id]) ?>
                                <?= $this->Html->link(__('Edytuj'), ['controller' => 'Towers', 'action' => 'edit', $towers->id]) ?>
                                <?= $this->Form->postLink(__('Usuń'), ['controller' => 'Towers', 'action' => 'delete', $towers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $towers->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
