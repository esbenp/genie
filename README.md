# Genie

[![Latest Version](https://img.shields.io/github/release/esbenp/genie.svg?style=flat-square)](https://github.com/esbenp/genie/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/esbenp/genie/master.svg?style=flat-square)](https://travis-ci.org/esbenp/genie)
[![Coverage Status](https://img.shields.io/coveralls/esbenp/genie.svg?style=flat-square)](https://coveralls.io/github/esbenp/genie)
[![Total Downloads](https://img.shields.io/packagist/dt/optimus/genie.svg?style=flat-square)](https://packagist.org/packages/optimus/genie)

## Introduction

A base repository class for Eloquent with convenience methods that cover most queries. Useful to abstract away
your persistence layer from your business code.

**Dedicated to Genie**

Dedicated to the World's best (and only) Genie in a bottle. [Congrats on the freedom my man](https://www.youtube.com/watch?v=SUfP6IGQD00).

## Installation

For Laravel 5.4 and above

```bash
composer require optimus/genie ~2.0
```

For Laravel 5.3 and below

```bash
composer require optimus/genie ~1.0
```

## Implementation

The examples will use a hypothetical Eloquent model named `User`.

```php
<?php

namespace App\Repositories;

use App\Models\User;
use Optimus\Genie\Repository;

class UserRepository extends Repository
{
    protected function getModel()
    {
        return new User;
    }
}
```

## Options

Genie is already integrated with [Optimus\Bruno](https://github.com/esbenp/bruno).
See Bruno documentation for more information.
The `$options` key given by all get-methods takes the following format:

Parameter | Value type | Description
--------- | ---------- | -----------
includes | array | Array of relationships to eager load
sort | array | Array of sorting rules, e.g. `[['key' => 'username', 'direction' => 'ASC']]`
filter_groups | array | See Bruno documentation
limit | int | Rows per page
page | int | The page to start from (use with limit)

*Note:* If you use the controller of Bruno it will automatically parse the request's
query string into the correct format.

## API

The examples will use a hypothetical Eloquent model named `User`.

### get (array $options = [])

Get all `User` rows

### getById ($id, array $options = [])

Get one `User` by primary key

### getRecent (array $options = [])

Get `User` rows ordered by `created_at` descending

### getRecentWhere (string $column, mixed $value, array $options = [])

Get `User` rows where `$column=$value`, ordered by `created_at` descending

### getWhere (string $column, mixed $value, array $options = [])

Get `User` rows where `$column=$value`

### getWhereArray (array $clauses, array $options = [])

Get `User` rows by multiple where clauses (`[$column1 => $value1, $column2 => $value2]`)

### getWhereIn (string $column, array $values, array $options = [])

Get `User` rows where `$column` can be any of the values given by `$values`

### getLatest (array $options = [])

Get the most recent `User`

### getLatestWhere (string $column, mixed $value, array $options = [])

Get the most recent `User` where `$column=$value`

### delete ($id)

Delete `User` rows by primary key

### deleteWhere ($column, $value)

Delete `User` rows where `$column=$value`

### deleteWhereArray (array $clauses)

Delete `User` rows by multiple where clauses (`[$column1 => $value1, $column2 => $value2]`)

## Standards

This package is compliant with [PSR-1], [PSR-2] and [PSR-4]. If you notice compliance oversights,
please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/esbenp/genie/blob/master/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](https://github.com/esbenp/genie/blob/master/LICENSE) for more information.
