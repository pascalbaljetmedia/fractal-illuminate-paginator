# Fractal Illuminate paginator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pbmedia/fractal-illuminate-paginator.svg?style=flat-square)](https://packagist.org/packages/pbmedia/fractal-illuminate-paginator)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/pascalbaljetmedia/fractal-illuminate-paginator/master.svg?style=flat-square)](https://travis-ci.org/pascalbaljetmedia/fractal-illuminate-paginator)
[![Quality Score](https://img.shields.io/scrutinizer/g/pascalbaljetmedia/fractal-illuminate-paginator.svg?style=flat-square)](https://scrutinizer-ci.com/g/pascalbaljetmedia/fractal-illuminate-paginator)
[![Total Downloads](https://img.shields.io/packagist/dt/pbmedia/fractal-illuminate-paginator.svg?style=flat-square)](https://packagist.org/packages/pbmedia/fractal-illuminate-paginator)

The Fractal package serializes the paginator different than the Illuminate paginator. This trait brings the serialization of the Illuminate paginator back to a Fractal serializer. Extend your serializer of choice, use this trait and you're done!

## Installation

You can install the package via composer:

``` bash
composer require pbmedia/fractal-illuminate-paginator
```

## Usage

Create your own ```Serializer``` and use the trait from this package:

```php
<?php

namespace Pbmedia\App\Serializers;

use League\Fractal\Serializer\DataArraySerializer as BaseSerializer;
use Pbmedia\Serializers\FractalIlluminatePaginatorTrait;

class DataArraySerializer extends BaseSerializer
{
    use FractalIlluminatePaginatorTrait;
}

```

Without the trait, the pagination results will be like this:

```
{
	data: [{
		id: 1,
		...
	}, {
		id: 2,
		...
	}, ...],
	meta: {
		pagination: {
			total: 33,
			count: 15,
			per_page: 15,
			current_page: 1,
			total_pages: 3,
			links: {
				next: "http://project.dev/api/v1/company?page=2"
			}
		}
	}
}
```

With the trait, the pagination results will be like this, just as you would convert a ```Illuminate\Pagination\LengthAwarePaginator``` to JSON.

```
{
	data: [{
		id: 1,
	  	...
	}, {
		id: 2,
	  	...
	}, ...],
	meta: {
		pagination: {
			total: 33,
			per_page: 15,
			current_page: 1,
			last_page: 3,
			next_page_url: "http://project.dev/api/v1/company?page=2",
			prev_page_url: null,
			from: 1,
			to: 15
		}
	}
}
```

## Security

If you discover any security related issues, please email pascal@pascalbaljetmedia.com instead of using the issue tracker.

## Credits

- [Pascal Baljet](https://github.com/pascalbaljet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
