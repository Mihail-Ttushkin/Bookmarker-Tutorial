<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Список моих закладок'), ['controller' => 'Bookmarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Создать закладку'), ['controller' => 'Bookmarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'Зарегистрирован') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Изменен') ?></th>
                <th scope="col" class="actions"><?= __('Деиствие') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?php if($this->request->session()->read('Auth.User.id') == $user->id): ?>
                    <?= $this->Html->link(__('Смотреть'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Изменить'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Удалить'), ['action' => 'delete', $user->id], ['confirm' => __('Вы уверенны, что хотите удалить пользователя # {0}?', $user->id)]) ?>
                    <?php endif ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('первая')) ?>
            <?= $this->Paginator->prev('< ' . __('предыдущая')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('следующая') . ' >') ?>
            <?= $this->Paginator->last(__('последняя') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Страница {{page}} из {{pages}}. Показано записей: {{current}}, всего записей: {{count}}')]) ?></p>
    </div>
</div>
