<h1>Wybierz dane do generacji dokumentów</h1>
<div class="column-responsive column-80">
        <div class="managers form content">
            <?= $this->Form->create(null, ['type' => 'post', 'url'=>['action'=>'generate']]) ?>
            <fieldset>
                <?php
                   echo $this->Form->control('tower_id', ['label' => 'Wieza', 'options' => $towers, 'required', 'empty' => 'wybierz wieżę']);
                   echo $this->Form->control('template_id', ['label' => 'Pismo', 'options' => $templates, 'required', 'empty' => 'wybierz pismo']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Generuj') ) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>