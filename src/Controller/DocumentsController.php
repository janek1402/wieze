<?php

declare(strict_types=1);

namespace App\Controller;

use App\MyHelpers\Functions;

/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $towers = $this->Documents->Towers->find('list', ['sort' => 'name ASC']);

        $this->set(compact('towers'));
    }

    public function toShowTower()
    {
        $this->Authorization->skipAuthorization();

        $tower_id = $this->request->getData('tower_id');

        return $this->redirect(
            ['action' => 'showTower', $tower_id]
        );
    }

    public function showTower($tower_id = null)
    {

        $this->Authorization->skipAuthorization();

        if ($tower_id == null) {
            $tower_id = $this->request->getData('tower_id');
        }

        $tower = $this->Documents->Towers->get($tower_id);
        $documents = $this->Documents->find('all')->where(['tower_id' => $tower_id])->order(['name' => 'ASC']);

        $this->set(compact('tower', 'documents'));
    }

    public function getFiles($tower_id)
    {
        $this->Authorization->skipAuthorization();

        $zipName = tempnam(WWW_ROOT . "docs/dodatki/", "zip");
        $imagesDirectory = WWW_ROOT . "docs/dodatki/$tower_id/";

        if (Functions::zipData($imagesDirectory, $zipName)) {
            $this->Flash->error('Dokumentacja tej wieży jest pusta');
        }

        header("Content-Type: application/zip");
        header('Content-Disposition: attachment; filename=dokumenty_wieza_' . $tower_id . ".zip");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipName));

        readfile($zipName);
        unlink($zipName);

        return $this->redirect(
            ['action' => 'showTower', $tower_id]
        );
    }

    /**
     * View method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => ['Towers'],
        ]);

        $this->set(compact('document'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($tower_id)
    {
        $document = $this->Documents->newEmptyEntity();
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            $name = $this->request->getData('name');
            $file = $this->request->getData('file');

            $document['name'] = $name;
            $document['tower_id'] = $tower_id;

            $directory = WWW_ROOT . "docs/dodatki/$tower_id/";
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $file = $this->getRequest()->getData("file");
            $client_file_name = $file->getClientFilename();

            $extension = Functions::getFileExtension($client_file_name);

            $filenameArray = Functions::createTempFileName($directory, 'doc', $extension);
            $filename = $filenameArray[0];
            $main_filename = $filenameArray[1];

            $file->moveTo($filename);

            $document['filename'] = $main_filename;

            if ($this->Documents->save($document)) {
                $this->Flash->success('Dokumenty zostały dodane.');

                return $this->redirect(['action' => 'showTower', $tower_id]);
            }
            $this->Flash->error(__('The document could not be saved. Please, try again.'));
        }
        $tower = $this->Documents->Towers->get($tower_id);
        $this->set(compact('document', 'tower'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $document = $this->Documents->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $document = $this->Documents->patchEntity($document, $this->request->getData());
            if ($this->Documents->save($document)) {
                $this->Flash->success(__('The document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The document could not be saved. Please, try again.'));
        }
        $towers = $this->Documents->Towers->find('list', ['limit' => 200]);
        $this->set(compact('document', 'towers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $document = $this->Documents->get($id);
        $this->Authorization->authorize($document);
        unlink(WWW_ROOT . '/docs/dodatki/' . $document['tower_id'] . '/' . $document['filename']);
        if ($this->Documents->delete($document)) {
            $this->Flash->success(__('Dokument został usunięty.'));
        } else {
            $this->Flash->error(__('The document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
