<form class="form-inline ml-auto" action="{{ route('search', ['st' => 'agriculture', 'keyword' => null]) }}">
    <ul class="navbar-nav">
        <li>
            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
        </li>
    </ul>
    <div class="search-element">
        <input class="form-control" name="st" type="hidden" value="agriculture">
        <input class="form-control" type="search" name="q" placeholder="Search" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        <div class="search-backdrop"></div>
    </div>
</form>