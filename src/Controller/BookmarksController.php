<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 */
class BookmarksController extends AppController
{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        // Доступ к действиям add и index всегда разрешен.
        if (in_array($action, ['index', 'add', 'tags'])) {
            return true;
        }
        // Все другие действия требуют идентификатор id.
        if (!$this->request->getParam('pass.0')) {
            return false;
        }

        // Проверяем, что закладка принадлежит текущему пользователю.
        $id = $this->request->getParam('pass.0');
        $bookmark = $this->Bookmarks->get($id);
        if ($bookmark->user_id == $user['id']) {
            return true;
        }
        return parent::isAuthorized($user);
    }
    
    public function index()
    {
        $this->paginate = [
            'conditions' => [
                'Bookmarks.user_id' => $this->Auth->user('id'),
            ]
        ];
        $this->set('bookmarks', $this->paginate($this->Bookmarks));
        $this->set('_serialize', ['bookmarks']);
    }

    public function tags()
    {
        //Ключ 'pass' поддерживается в CakePHP и содержит 
        //все элементы URL пути, переданные в запросе (request)
        $tags = $this->request->params['pass'];

        // Используем BookmarksTable для поиска закладок по тэгам.
        $bookmarks = $this->Bookmarks->find('tagged', [
            'tags' => $tags
        ]);

        // Формируем переменные, передаваемые в шаблон представления.
        $this->set([
            'bookmarks' => $bookmarks,
            'tags' => $tags
        ]);
    }

    
    public function view($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Users', 'Tags']
        ]);

        $this->set('bookmark', $bookmark);
        $this->set('_serialize', ['bookmark']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmark = $this->Bookmarks->newEntity();
        if ($this->request->is('post')) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            $bookmark->user_id = $this->Auth->user('id');
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success('Закладка успешно сохранена.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Не удалось сохранить закладку. Пожалуйста, попробуйте еще раз.');
        }
        $tags = $this->Bookmarks->Tags->find('list');
        $this->set(compact('bookmark', 'tags'));
        $this->set('_serialize', ['bookmark']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
        'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            $bookmark->user_id = $this->Auth->user('id');
            //debug($bookmark);
            //exit;
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success('Закладка успешно сохранена.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Не удалось изменить закладку. Пожалуйста, попробуйте еще раз.');
        }
        $tags = $this->Bookmarks->Tags->find('list');
        $this->set(compact('bookmark', 'tags'));
        $this->set('_serialize', ['bookmark']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('Закладка успешно удалена.'));
        } else {
            $this->Flash->error(__('Закладка не удалена. Попробуйте выполнить операцию еще раз.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
