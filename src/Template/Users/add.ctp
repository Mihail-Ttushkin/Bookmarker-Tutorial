<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Войти'), ['action' => 'login']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Регистрация') ?></legend>
        <?php
            echo $this->Form->input('email', [
                'label' => 'Email'
            ]);
            echo $this->Form->input('password', [
                'label' => 'Пароль'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Зарегистрироваться')) ?>
    <?= $this->Form->end() ?>
</div>
