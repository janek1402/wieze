<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Managers Controller
 *
 * @property \App\Model\Table\ManagersTable $Managers
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManagersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $managers = $this->paginate($this->Managers);

        $this->set(compact('managers'));
    }

    /**
     * View method
     *
     * @param string|null $id Manager id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manager = $this->Managers->get($id, [
            'contain' => ['Towers'],
        ]);
        $this->Authorization->authorize($manager);

        $this->set(compact('manager'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manager = $this->Managers->newEmptyEntity();
        $this->Authorization->authorize($manager);
        if ($this->request->is('post')) {
            $manager = $this->Managers->patchEntity($manager, $this->request->getData());
            if ($this->Managers->save($manager)) {
                $this->Flash->success(__('The manager has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manager could not be saved. Please, try again.'));
        }
        $this->set(compact('manager'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Manager id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manager = $this->Managers->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($manager);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manager = $this->Managers->patchEntity($manager, $this->request->getData());
            if ($this->Managers->save($manager)) {
                $this->Flash->success(__('The manager has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manager could not be saved. Please, try again.'));
        }
        $this->set(compact('manager'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Manager id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manager = $this->Managers->get($id);
        $this->Authorization->authorize($manager);
        if ($this->Managers->delete($manager)) {
            $this->Flash->success(__('The manager has been deleted.'));
        } else {
            $this->Flash->error(__('The manager could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
