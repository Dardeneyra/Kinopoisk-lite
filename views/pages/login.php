<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>


<?php $view->component('start') ?>
<h1>Login page</h1>

<form action="/login" method="post">

    <?php if($session->has('error')) { ?>
        <p style="color: red;">
        <?php echo $session->getFlash('error'); ?>
        </p>
    <?php } ?>

    <p>email</p>
    <div>
    <input type="text" name="email">
    </div>
    <div>
    </div>
    <p>password</p>
    <div>
    <input type="password" name="password">
    </div>
    <div>
        <button>Login</button>
    </div>
</form>
<?php $view->component('end') ?>