cocuou premeir tempalte

<?php if ($pizzas) : ?>

    <?php foreach ($pizzas as $pizza) : ?>
        <a href="?type=home&action=show&id=<?= $pizza['id'] ?>"> <?= $pizza['name'] ?></a>
    <?php endforeach ?>
<?php else : ?>
    pas de pizza
<?php endif; ?>