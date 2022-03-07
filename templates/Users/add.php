<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">

    <div class="column-responsive column-100">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <h3>Dodaj użytkownika</h3>
                <?php
                echo $this->Form->control('email', ['required']);
                echo $this->Form->control('password', ['required', 'label' => 'Hasło']);
                echo $this->Form->control('role', ['required', 'options' => [
                    'admin' => 'admin',
                    'pracownik_biurowy' => 'pracownik_biurowy',
                    'pracownik_polowy' => 'pracownik_polowy'
                ]]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Dodaj')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>