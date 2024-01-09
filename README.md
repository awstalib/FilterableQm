# FilterableQm Laravel Package

FilterableQm is a Laravel package that provides traits for filtering and paginating Eloquent models seamlessly. It includes the `FilterableQm` trait for filtering models and the `PaginateQm` trait for easy pagination.

## Installation

You can install the package via Composer. Run the following command:

```bash
composer require awstalib/filterable-qm 
 ```
## Usage
FilterableQm Trait
In your Eloquent model, use the FilterableQm trait:

```bash
use Awstalib\FilterableQm\FilterableQm;

class YourModel extends Model
{
    use FilterableQm;

    // Your model logic here
}

```
Use the applyFilters method on your model's query builder:
```bash
$filteredData = YourModel::query()->applyFilters($filters)->get();
```
PaginateQm Trait
In your Eloquent model, use the PaginateQm trait:

```bash
use Awstalib\FilterableQm\PaginateQm;

class YourModel extends Model
{
    use PaginateQm;

    // Your model logic here
}
```


Utilize the paginateModel method in your controller:

```bash
use Awstalib\FilterableQm\ApiResponse;

public function index(Request $request)
{
    $data = $this->paginateModel(new YourModel(), $request, false);
    return ApiResponse::success($data['data'], 'Data retrieved successfully', null, $data['count']);
}
```
## Version History

### 1.0.0 (January 7, 2024)

- Initial release.
- Added `FilterableQm` and `PaginateQm` traits.
- Basic filtering and pagination functionality.



## Contributing

Feel free to contribute to this project by forking it and creating a pull request.

## License

This package is open-source and available under the MIT License.