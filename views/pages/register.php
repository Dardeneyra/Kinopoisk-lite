<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>


<?php $view->component('start') ?>
<h1>Register page</h1>

<form action="/register" method="post">
    <p>email</p>
    <div>
    <input type="text" name="email">
    </div>
    <div>
    <?php if($session->has('email')) { ?>
        <ul>
            <?php foreach($session->get('email') as $error) { ?>
                <li style="color: red"><?php echo $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    </div>
    <p>password</p>
    <div>
    <input type="password" name="password">
    </div>
    <div>
    <?php if($session->has('password')) { ?>
        <ul>
            <?php foreach($session->get('password') as $error) { ?>
                <li style="color: red"><?php echo $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    </div>
    <div>
        <button>Register</button>
    </div>
</form>
<?php $view->component('end') ?>