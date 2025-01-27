<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ($pageTitle) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/src/pages/layout.css">
    <?php if ($pageCss): ?>
        <?= ($this->raw($pageCss))."
" ?>
    <?php endif; ?>
    <?php if ($pageJS): ?>
        <?= ($this->raw($pageJS))."
" ?>
    <?php endif; ?>    
</head>
<body>
    <header>
        <h1>F3 Website</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/signup">Sign up</a>
        </nav>
    </header>
    
    <main>
        <?= ($this->raw($pageContent))."
" ?>
    </main>

    <footer>
        <p>&copy; 2025 rotasquared</p>
    </footer>
</body>
</html>