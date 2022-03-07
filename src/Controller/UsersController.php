<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $current_user = $this->request->getAttribute('identity');
        $isAdmin = $current_user['role'] == 'admin';

        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $password = trim($this->request->getData('password'));
            $rep_password = trim($this->request->getData('rep_password'));

            if ($isAdmin and $current_user['id'] !== $user['id']) {
                $role = trim($this->request->getData('role'));
                $user['role'] = $role;
            }

            if (($password !== '') and ($password === $rep_password)) {
                $user['password'] = $password;
            } else {
                if ($password !== '') {
                    $this->Flash->error(__('Passwords are empty or not equal'));
                    $this->set(compact('user', 'isAdmin'));
                    return;
                }
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                if($isAdmin){
                    return $this->redirect(['action' => 'index']);
                }else{
                    return $this->redirect(['controller' => 'pages', 'action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
                $this->set(compact('user', 'isAdmin'));
                return;
            }
        }

        $this->set(compact('user', 'isAdmin'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->addUnauthenticatedActions(['login', 'logout']); //
    }

    public function login()
    {
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Pages',
            'action' => 'index',
        ]);

        $this->viewBuilder()->setLayout('error');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Niepoprawny email lub hasło'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
    }
}
