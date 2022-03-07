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
            <h3>Edytuj dane</h3>
                <?php
                echo $this->Form->control('email', ['disabled' => true]);
                echo $this->Form->control('password', ['value' => '', 'label'=>'Hasło']);
                echo $this->Form->control('rep_password', ['value' => '', 'label' => 'Powtórz hasło', 'type' => 'password']);
                if ($isAdmin) {
                    echo $this->Form->control('role', ['required', 'options' => [
                        'admin' => 'admin',
                        'pracownik_biurowy' => 'pracownik_biurowy',
                        'pracownik_polowy' => 'pracownik_polowy'
                    ]]);
                }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Zatwierdź')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>