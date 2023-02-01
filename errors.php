<?php if(count($errors) > 0): ?>
    <div class="error">
        <?php foreach ($error as $error): ?>
            <p><?php echo $error ?></p>
            <?php endforeach ?>
    </div>
<?php endif ?>