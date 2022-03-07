<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\File;

/**
 * Templates Controller
 *
 * @property \App\Model\Table\TemplatesTable $Templates
 * @method \App\Model\Entity\Template[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TemplatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $templates = $this->paginate($this->Templates);

        $this->set(compact('templates'));
    }

    /**
     * View method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $template = $this->Templates->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('template'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $template = $this->Templates->newEmptyEntity();
        $this->Authorization->authorize($template);
        if ($this->request->is('post')) {
            $template = $this->Templates->patchEntity($template, $this->request->getData());
            if ($result = $this->Templates->save($template)) {
                $id = $result->id;
                $attachment = $this->getRequest()->getData("file");
                $tmp_name = $attachment->getStream()->getMetadata('uri');
                $filename = WWW_ROOT . "files/pismo_$id.docx";
                $attachment->moveTo($filename);
                $this->Flash->success(__('The template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The template could not be saved. Please, try again.'));
        }
        $this->set(compact('template'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $template = $this->Templates->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($template);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $template = $this->Templates->patchEntity($template, $this->request->getData());
            if ($this->Templates->save($template)) {
                $attachment = $this->getRequest()->getData("file");
                $error = $attachment->getError();
                if (!$error) {
                    $tmp_name = $attachment->getStream()->getMetadata('uri');
                    $filename = WWW_ROOT . "files/pismo_$id.docx";
                    $attachment->moveTo($filename);
                }
                $this->Flash->success(__('The template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The template could not be saved. Please, try again.'));
        }
        $this->set(compact('template'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $template = $this->Templates->get($id);
        $this->Authorization->authorize($template);
        if ($this->Templates->delete($template)) {
            $filename = WWW_ROOT . "files/pismo_$id.docx";
            unlink($filename);
            $this->Flash->success(__('The template has been deleted.'));
        } else {
            $this->Flash->error(__('The template could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
