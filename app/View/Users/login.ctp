<?php
    echo $this->Html->css(array('login'), 'stylesheet', array('inline' => false));
?>
<div id="login_content">
    <br>
    <span id="auth_window">
        <div class="users form">
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User', array('action' => 'login')); ?>
            <fieldset>
            <?php
        echo $this->Form->input('username');
                echo $this->Form->input('password');
            ?>
            </fieldset>
        <?php
            echo $this->Form->end(__('Login'));
        ?>
        Not yet a user? <?php echo $this->Html->link('Register', array('controller' => 'Users', 'action' => "add")); ?> now!
        </div>
    <br style="clear:both">
</div>
