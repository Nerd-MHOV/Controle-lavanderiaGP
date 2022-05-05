<?php $this->layout("theme/_theme"); ?>

<div class="page">
    <h1>Ooops, erro <?= $error; ?></h1>
    <?php if ($error == 401): ?>
    <p>Desculpe por isso, mas você não tem permissão para acessar essa página, por favor entre em contato conosco.</p>
    <?php else: ?>
    <p>Desculpe por isso, caso o problema persista, por favor entre em contato conosco.</p>
    <?php endif; ?>
    <p><a class="btn btn-blue" href="<?= $router->route("web.login"); ?>" title="<?= site("name"); ?>">VOLTAR!</a></p>
</div>