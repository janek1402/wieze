<h1>Dodaj zdjęcia z poszczególnych etapów budowy</h1>
<div class="column-responsive column-100">
    <div class="managers form content">
        <?= $this->Form->create(
            null,
            [
                'type' => 'file', 'url' => ['action' => 'index'],
                'onsubmit' => 'return potwierdz()'
            ]
        ) ?>
        <fieldset>
            <?php
            echo $this->Form->control('tower_id', ['label' => 'Wieża', 'options' => $towers, 'required', 'empty' => 'wybierz wieżę']);
            echo $this->Form->control('stage_id', ['label' => 'Etap budowy', 'options' => $stages, 'required', 'empty' => 'wybierz etap']);
            echo $this->Form->control('files[]', ['label' => 'Pliki', 'type' => 'file', 'required', 'multiple' => 'multiple', "accept" => "image/*"]);

            ?>
        </fieldset>
        <?= $this->Form->button(__('Dodaj')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    function potwierdz() {
        var wieza = $("#tower-id option:selected").text();
        var etap = $("#stage-id option:selected").text();
        var result = confirm(`Czy napewno chcesz dodać wybrane dokumenty do:\nWieża: ${wieza}\nEtap: ${etap}\n???`);
        if (result) {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                backdrop: 'static'
            })
            myModal.show();
        }

        return result;
    }
</script>
<div id="myModal" class="modal fade" role="dialog"">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                Proszę czekać zdjęcia są obrabiane...
            </div>
        </div>
    </div>
</div>