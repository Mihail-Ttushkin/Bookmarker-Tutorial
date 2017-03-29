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
<div class="tags index large-9 medium-8 columns content">
    <h3><?= __('Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title', 'Название') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created', 'Создан') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Изменен') ?></th>
                <th scope="col" class="actions"><?= __('Действия') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Number->format($tag->id) ?></td>
                <td><?= h($tag->title) ?></td>
                <td><?= h($tag->created) ?></td>
                <td><?= h($tag->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tag->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tag->id], ['confirm' => __('Вы уверенны, что хотите удалить тег # {0}?', $tag->id)]) ?>
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
