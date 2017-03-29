<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Изменить данные пользователя'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Удалить пользователя'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('Список пользователей'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Список закладок'), ['controller' => 'Bookmarks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Добавить закладку'), ['controller' => 'Bookmarks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Пароль') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Зарегистрирован') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Изменен') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Закладки пользователя:') ?></h4>
        <?php if (!empty($user->bookmarks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Название') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Создана') ?></th>
                <th scope="col"><?= __('Изменена') ?></th>
                <th scope="col" class="actions"><?= __('Действия') ?></th>
            </tr>
            <?php foreach ($user->bookmarks as $bookmarks): ?>
            <tr>
                <td><?= h($bookmarks->id) ?></td>
                <td><?= h($bookmarks->title) ?></td>
                <td><?= h($bookmarks->url) ?></td>
                <td><?= h($bookmarks->created) ?></td>
                <td><?= h($bookmarks->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Смотр'), ['controller' => 'Bookmarks', 'action' => 'view', $bookmarks->id]) ?>
                    <?= $this->Html->link(__('Править'), ['controller' => 'Bookmarks', 'action' => 'edit', $bookmarks->id]) ?>
                    <?= $this->Form->postLink(__('Удалить'), ['controller' => 'Bookmarks', 'action' => 'delete', $bookmarks->id], ['confirm' => __('Вы уверены, что хотите удалить закладку # {0}?', $bookmarks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
