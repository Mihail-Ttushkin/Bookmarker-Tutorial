<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Создать закладку'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Список пользователей'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Список тегов'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Создать тег'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookmarks index large-9 medium-8 columns content">
    <h3><?= __('Список закладок пользователя: ').$this->Html->link($this->request->session()->read('Auth.User.email'), ['controller' => 'Users', 'action' => 'view', $this->request->session()->read('Auth.User.id')]) ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title', 'Название') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'Создана') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Изменена') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookmarks as $bookmark): ?>
            <tr>
                <td><?= $this->Number->format($bookmark->id) ?></td>
                <td><?= h($bookmark->title) ?></td>
                <td><?= h($bookmark->created) ?></td>
                <td><?= h($bookmark->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Смотреть'), ['action' => 'view', $bookmark->id]) ?>
                    <?= $this->Html->link(__('Править'), ['action' => 'edit', $bookmark->id]) ?>
                    <?= $this->Form->postLink(__('Удалить'), ['action' => 'delete', $bookmark->id], ['confirm' => __('Вы уверены, что хотите удалить # {0}?', $bookmark->id)]) ?>
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
