<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 */
$user = $auth->user();
?>

<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none logo">
                <h5 class="m-0">Кинопоиск <span class="badge bg-warning warn__badge">Lite</span></h5>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="/" class="nav-link px-2 text-secondary d-flex align-items-center column-gap-2">
                        <span>Главная</span>
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center text-end">
                <?php if ($auth->check() && $user !== null) { ?>
                    <div class="d-flex align-items-center column-gap-4">
                        <p class="m-0"><?= htmlspecialchars($user->name()) ?></p>
                        <form action="/logout" method="post">
                            <button class="btn btn-danger d-flex align-items-center column-gap-2">
                                <span>Выйти</span>
                            </button>
                        </form>
                    </div>
                <?php } else { ?>
                    <a href="/login" type="button" class="btn btn-outline-light me-2 d-flex align-items-center column-gap-2">
                        <span>Войти</span>
                    </a>
                    <a href="/register" type="button" class="btn btn-warning d-flex align-items-center column-gap-2">
                        <span>Создать аккаунт</span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
