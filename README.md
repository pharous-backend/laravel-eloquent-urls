<p align="center"><a href="https://pharous.com" target="_blank"><img src="https://www.pharous.com/assets/site/img/logo.svg" width="470"></a></p>

<p align="center">
<a href="https://github.com/pharous-backend/laravel-eloquent-urls" target="_blank"><img src="http://img.shields.io/badge/source-pharous_backend/laravel--eloquent--urls-blue.svg?style=flat-square" alt="Source"></a> <a href="https://packagist.org/packages/pharous/laravel-eloquent-urls" target="_blank"><img src="https://img.shields.io/packagist/v/pharous/laravel-eloquent-urls?style=flat-square" alt="Packagist Version"></a><br>
<a href="https://laravel.com" target="_blank"><img src="https://img.shields.io/badge/Laravel->=6.0-red.svg?style=flat-square" alt="Laravel"></a> <img src="https://img.shields.io/packagist/dt/pharous/laravel-eloquent-urls?style=flat-square" alt="Packagist Downloads"> <img src="http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Source">
</p>


#### Laravel - Model's Multi URLs.

###### 



## Install

Install the latest version using [Composer](https://getcomposer.org/):

```bash
$ composer require pharous-backend/laravel-eloquent-urls
```

```bash
$ php artisan vendor:publish --tag=laravel-eloquent-urls
$ php artisan migrate
```



## Usage
- [Install](#install)
- [Usage](#usage)
    - [Including it in a Model](#including-it-in-a-model)
    - [How to use](#how-to-use)
- [License](#license)




<a name="INC"></a>

#### Including it in a Model
```php
// An example
// Using HasURLs in User Model
...
use Pharous\Laravel\Eloquent\URL\HasURLs;

class User extends Model
{
    use HasURLs;
    
    protected $URLsAttibutes = ['facebook'];
    ...
}
```



<a name="HTU"></a>

#### How to use

```php
$user = User::find(1); 		                                // Model
$user->facebook = 'https://www.facebook.com/MoamenEltouny';     // Set Facebook URL
$user->facebook->click();                                       // Increment clicks count
echo $user->facebook->url;                                      // Display Facebook URL
```



## License

[MIT license](LICENSE.md) 