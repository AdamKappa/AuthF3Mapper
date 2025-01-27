
    <div class="exit-container">
        <form method="post" action="<?= ($BASE) ?>/logout">
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    </div>
    <?php if ($message): ?>
        <div class="alert alert-success"><?= ($message) ?></div>
    <?php endif; ?>
    <div class="welcome-container">
        <p>Welcome <?= ($username) ?>. You are an <?= ($accessLevel) ?>.</p>
        <p><a href="<?= ($BASE) ?>/editpage">Go to edit page</a></p>
    </div>
