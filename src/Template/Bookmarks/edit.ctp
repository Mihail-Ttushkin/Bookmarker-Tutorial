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
                ['action' => 'delete', $bookmark->id],
                ['confirm' => __('Вы уверены, что хотите удалить закладку # {0}?', $bookmark->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Список моих закладок'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Список пользователей'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Список тегов'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Создать тег'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookmarks form large-9 medium-8 columns content">
    <?= $this->Form->create($bookmark) ?>
    <fieldset>
        <legend><?= __('Редактировать закладку') ?></legend>
        <?php
            echo $this->Form->input('title', [
                'label' => 'Название'
            ]);
            echo $this->Form->input('description', [
                'label' => 'Описание'
            ]);
            echo $this->Form->input('url', [
                'label' => 'URL'
            ]);
            echo $this->Form->control('tag_string', [
                'type' => 'text',
                'label' => 'Теги'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Сохранить')) ?>
    <?= $this->Form->end() ?>
</div>
