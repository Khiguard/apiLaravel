

Framework : laravel

Seeder add with Faker

API: http://apilaravel/api/customers

+--------+-----------+-------------------------+------------------+------------------------------------------------------------
| Domain | Method    | URI                     | Name             | Action                                                     | Middleware                               |
|        | GET|HEAD  | /                       |                  | Closure                                                    | web                                      |
|        | POST      | api/customers            | customer.store   | App\Http\Controllers\CustomerController@store              | api                                      |
|        | GET|HEAD  | api/customers/{customer} | customer.show    | App\Http\Controllers\CustomerController@show               | api                                      |
|        | PUT|PATCH | api/customers/{customer} | customer.update  | App\Http\Controllers\CustomerController@update             | api                                      |
|        | DELETE    | api/customers/{customer} | customer.destroy | App\Http\Controllers\CustomerController@destroy                                   |
+--------+-----------+-------------------------+------------------+------------------------------------------------------------

Filter
http://apilaravel/api/customers?filter[name]=name&filter[Fname]=fname

Use "Postman" for testing API