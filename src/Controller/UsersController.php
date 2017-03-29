<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'add']);
    }
    
     public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        // Доступ к index всегда разрешен.
        if (in_array($action, ['index'])) {
            return true;
        }
        // Все другие действия требуют идентификатор id.
        if (!$this->request->getParam('pass.0')) {
            return false;
        }

        // Проверяем, что запрашиваемые данные принадлежат текущему пользователю.
        $id = $this->request->getParam('pass.0');
        $user_log = $this->Users->get($id);
        if ($user_log->id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bookmarks']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // если пользователь авторизован, то не даем ему возможности вновь зарегистрироваться
        if($this -> Auth -> user()) {
            $this->Flash->error(__('Чтобы зарегистрировать еще одного пользователя - выйдите из системы.'));
            return $this->redirect(['controller' => 'Bookmarks', 'action' => 'index']);
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Регистрация прошла успешно.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Пользователь не может быть сохранен. Пожалуйста, попробуйте еще раз.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Информация о пользователе успешно изменена.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Информация о пользователе не обновлена. Попробуйте выполнить операцию еще раз.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Пользователь удален.'));
        } else {
            $this->Flash->error(__('Пользователь не может быть удален. Попробуйте выполнить операцию еще раз.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Имя пользователя или пароль введены не корректно.');
        }
    }
    
    public function logout()
    {
        $this->Flash->success('Вы успешно вышли.');
        return $this->redirect($this->Auth->logout());
    }
}
