<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <ul class="navbar-nav me-auto">
    <a href="<?= base_url("/"); ?>" class="nav-link">Zlínský kraj</a> </li>
    <?php
        foreach($okresy as $okres) {
            echo "<li class='nav-item'>";
            echo "<a class='nav-link' href='".base_url("okres/".$okres->kod)."/perPage/10'>".$okres->nazev."</a>";
            echo "</li>";
                       
        }?>
        <li class="nav-item">
    </ul>
  </div>
</nav>