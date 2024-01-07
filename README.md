# FilterableQm Laravel Package

FilterableQm is a Laravel package that provides traits for filtering and paginating Eloquent models seamlessly. It includes the `FilterableQm` trait for filtering models and the `PaginateQm` trait for easy pagination.

## Installation

You can install the package via Composer. Run the following command:

```bash
composer require awstalib/filterable-qm
Usage

FilterableQm Trait
In your Eloquent model, use the FilterableQm trait:
php
Copy code
use Awstalib\FilterableQm\FilterableQm;

class YourModel extends Model
{
    use FilterableQm;

    // Your model logic here
}
Use the applyFilters method on your model's query builder:
php
Copy code
$filteredData = YourModel::query()->applyFilters($filters)->get();
PaginateQm Trait
In your Eloquent model, use the PaginateQm trait:
php
Copy code
use Awstalib\FilterableQm\PaginateQm;s

class YourModel extends Model
{
    use PaginateQm;

    // Your model logic here
}
Utilize the paginateModel method in your controller:
php
Copy code
use Awstalib\FilterableQm\ApiResponse;

public function index(Request $request)
{
    $data = $this->paginateModel(new YourModel(), $request, false);
    return ApiResponse::success($data['data'], 'Data retrieved successfully', null, $data['count']);
}
Version History

1.0.0 (January 1, 2024)
Initial release.
Added FilterableQm and PaginateQm traits.
Basic filtering and pagination functionality.
1.1.0 (February 1, 2024)
Renamed traits to follow Laravel naming conventions.
Updated documentation in README.md.
Contributing

Feel free to contribute to this project by forking it and creating a pull request.

License

This package is open-source and available under the MIT License.