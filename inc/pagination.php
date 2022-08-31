<nav >
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item ">
            <a <?= $activPrec ? "aria-disabled='true'" : " href=" .$routeController->getRoute("category")."?genre=".$_GET["genre"]."&currentPage=Prec,".$currentPage ?> class="page-link <?= $activPrec ? "disabled" : "" ?>">Prec</a>
        </li>
        <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item ">
                <a <?= $activPage ? "aria-disabled='true'" : " href=" .$routeController->getRoute("category")."?genre=".$_GET["genre"]."&currentPage=".$page ?> class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a href="<?= $routeController->getRoute("category")."?genre=".$_GET["genre"]."&currentPage=Suiv,".$currentPage ?>" class="page-link">Suiv</a>
        </li>
    </ul>
</nav>