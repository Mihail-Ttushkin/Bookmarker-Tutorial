<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Создать тег'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Список закладок'), ['controller' => 'Bookmarks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Создать закладку'), ['controller' => 'Bookmarks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tags form large-9 medium-8 columns content">
    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('Добавить тег') ?></legend>
        <?php
            echo $this->Form->input('title', [
                'label' => 'Название'
            ]);
            echo $this->Form->input('bookmarks._ids', [
                'options' => $bookmarks,
                'label' => 'Для каких закладок'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Добавить')) ?>
    <?= $this->Form->end() ?>
</div>
