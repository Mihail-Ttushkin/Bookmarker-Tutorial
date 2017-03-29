<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Form->postLink(
                __('Удалить'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Вы уверены, что хотите удалить пользователя # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Список пользователей'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Список закладок'), ['controller' => 'Bookmarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Создать закладку'), ['controller' => 'Bookmarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password', [
                'label' => 'Пароль',
                'value' => false
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Изменить')) ?>
    <?= $this->Form->end() ?>
</div>
