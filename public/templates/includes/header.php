<?php $auth = $request->auth; ?>
<div id="headerimg">
    <div id="headerimg__body">
        <div class="headerimg__text">
            Добро пожаловать в Чернигов!
        </div>
    </div>
    <img id="headerimg__img" src="<?= STATIC_IMG ?>/headers-che.jpg" alt="">
</div>
<div id="navbar">
    <div class="container">
        <div class="navbar__row">
            <div class="navbar__logo">
                <a href="/">
                    <img src="<?= STATIC_IMG ?>/pushka-white.png" alt="">
                </a>
            </div>

            <div class="navbar__body">
                <?php  if ($auth -> isAuth()): ?>
                <div class="navbar__user-links">
                    <div class="user-links">
                        <a href="/user/<?= $auth -> getUserData()['id']; ?>" class="user-links__user">
                            <?= $auth -> getUserData()['nickname'] ?>
                        </a>
                    </div>
                </div>
                <?php else: ?>
                <div class="navbar__auth-links">
                    <div class="auth-links">
                        <a href="/register" class="auth-links__link">
                            Регстрация
                        </a>
                        <a href="/login" class="auth-links__link">
                            Вход
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>