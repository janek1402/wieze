<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Investors Controller
 *
 * @property \App\Model\Table\InvestorsTable $Investors
 * @method \App\Model\Entity\Investor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InvestorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $investors = $this->paginate($this->Investors);

        $this->set(compact('investors'));
    }

    /**
     * View method
     *
     * @param string|null $id Investor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $investor = $this->Investors->get($id, [
            'contain' => ['Towers'],
        ]);
        $this->Authorization->authorize($investor);

        $this->set(compact('investor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $investor = $this->Investors->newEmptyEntity();
        $this->Authorization->authorize($investor);
        if ($this->request->is('post')) {
            $investor = $this->Investors->patchEntity($investor, $this->request->getData());
            if ($this->Investors->save($investor)) {
                $this->Flash->success(__('The investor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The investor could not be saved. Please, try again.'));
        }
        $this->set(compact('investor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Investor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $investor = $this->Investors->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($investor);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $investor = $this->Investors->patchEntity($investor, $this->request->getData());
            if ($this->Investors->save($investor)) {
                $this->Flash->success(__('The investor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The investor could not be saved. Please, try again.'));
        }
        $this->set(compact('investor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Investor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $investor = $this->Investors->get($id);
        $this->Authorization->authorize($investor);
        if ($this->Investors->delete($investor)) {
            $this->Flash->success(__('The investor has been deleted.'));
        } else {
            $this->Flash->error(__('The investor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
