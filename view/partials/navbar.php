<!--Navigation Bar 
  Used library: urlIs()
-->

<nav>

  <a href="/" class="<?= urlIs('/') ? 'active' : ''; ?>">All</a>
  <a href="/books" class="<?= urlIs('/books') ? 'active' : ''; ?>">Books</a>
  <a href="/stationary" class="<?= urlIs('/stationary') ? 'active' : ''; ?>">Stationary</a>
</nav>

<br> <br> <br><br><br>