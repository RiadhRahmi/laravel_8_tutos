<?php

namespace App\Articles;

use Illuminate\Database\Eloquent\Collection;

interface ArticlesRepository
{
    public function search($query = ''): Collection;
}
