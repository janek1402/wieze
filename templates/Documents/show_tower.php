<div class="row">
    <div class="column-responsive column-100">
        <div class="documents form content clear">
            <?= $this->Html->link('Dodaj dokument', ['controller' => 'documents', 'action' => 'add', $tower['id']], ['class' => 'button', 'style' => 'float: right']) ?>
            <?= $this->Html->link('Pobierz wszystkie', ['controller' => 'documents', 'action' => 'getFiles', $tower['id']], ['class' => 'button', 'style' => 'float: right; position: relative; right: 1.5rem']) ?>
            <h3> Dokumentacja wieży: <?= $tower['nr_stacji'] ?> </h3>
            <div>
                <?php foreach ($documents as $document) : ?>
                    <hr>
                    <div class="doc-file">
                        <?= $this->Html->link($document['name'], '/docs/dodatki/' . $tower['id'] . '/' . $document['filename']) ?>
                        <?= $this->Html->link('Usuń', ['action' => 'delete', $document['id']], ['class' => 'button', 'style' => 'float: right'], ['onsubmit' => 'return potwierdz()']) ?> </form>
                    </div>
                <?php endforeach; ?>
                <hr>
            </div>
        </div>
    </div>
</div>
<script>
    function potwierdz() {
        return confirm(`Czy napewno chcesz usunąć te zdjęcia?`);
    }
</script>