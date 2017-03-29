<div class="users form large-9 medium-8 columns content">
    <h1>Форма входа</h1>
    <?php if($this->request->session()->read('Auth.User')): ?>
        <fieldset>
            <legend><?= __('Вы уже авторизованы и можете пользоваться системой.') ?></legend>
        <fieldset>
    <?php else: ?>
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Пожалуйста, авторизируйтесь. Если у вас нет аккаунта, то пройдите ').$this->Html->link(__('регистрацию.'), ['controller' => 'Users', 'action' => 'add']) ?></legend>
                <?= $this->Form->control('email') ?>
                <?= $this->Form->control('password', [
                    'label' => 'Пароль'
                ]) ?>
        </fieldset>
        <?= $this->Form->button('Войти') ?>
        <?= $this->Form->end() ?>
    <?php endif ?>
</div>