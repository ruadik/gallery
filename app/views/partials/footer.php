<footer class="section hero is-light">
    <div class="container">
        <div class="content has-text-centered">
            <div class="tabs">
                <ul>
                    <li class="is-active"><a>Главная</a></li>
                        <?php foreach (getAllcategories() as $category): ?>
                            <li>
                                <a class="navbar-item"  href="/category/<?= $category['id']?>">
                                    <?= $category['title']?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                </ul>
            </div>
            <p>
                <strong>Ali</strong> - Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit expedita consequatur, et. Unde, nulla, dicta.
            </p>
            <p class="is-size-7">
                All rights reserved. 2019
            </p>
        </div>
    </div>
</footer>
