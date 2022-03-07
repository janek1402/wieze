<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Inspectors Controller
 *
 * @property \App\Model\Table\InspectorsTable $Inspectors
 * @method \App\Model\Entity\Inspector[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InspectorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $inspectors = $this->paginate($this->Inspectors);

        $this->set(compact('inspectors'));
    }

    /**
     * View method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inspector = $this->Inspectors->get($id, [
            'contain' => ['Towers'],
        ]);
        $this->Authorization->authorize($inspector);

        $this->set(compact('inspector'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inspector = $this->Inspectors->newEmptyEntity();
        $this->Authorization->authorize($inspector);
        if ($this->request->is('post')) {
            $inspector = $this->Inspectors->patchEntity($inspector, $this->request->getData());
            if ($this->Inspectors->save($inspector)) {
                $this->Flash->success(__('The inspector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inspector could not be saved. Please, try again.'));
        }
        $this->set(compact('inspector'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inspector = $this->Inspectors->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($inspector);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inspector = $this->Inspectors->patchEntity($inspector, $this->request->getData());
            if ($this->Inspectors->save($inspector)) {
                $this->Flash->success(__('The inspector has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The inspector could not be saved. Please, try again.'));
        }
        $this->set(compact('inspector'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Inspector id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inspector = $this->Inspectors->get($id);
        $this->Authorization->authorize($inspector);
        if ($this->Inspectors->delete($inspector)) {
            $this->Flash->success(__('The inspector has been deleted.'));
        } else {
            $this->Flash->error(__('The inspector could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
