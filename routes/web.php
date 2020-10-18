<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/cdv', function() {
  /////  return ['name' => 'cdv', 'base' => 'classic'];
//});

Route::get('/cdv', function() {
    return view('cdv', ['name' => 'Cezary', 'surname' => 'Glaz', 'city' => 'Poznań']);
});

Route::get('/pages/{x}', function($x){
    $pages = [
        'about' => 'Strona CDV',
        'contact' => 'Poznań ul.Staszica',
        'home' => 'Strona domowa'
    ];
    return $pages[$x];
});

Route::get('/address/{city?}/{street?}/{zipCode?}', function(String $city = 'brak danych', String $street= 'brak danych', int $zipCode = null){
    
    if(is_null($zipCode)) {
        $zipCode = 'brak';
    } else {

    $zipCode = substr($zipCode,0,2).'-'.substr($zipCode,2,3);
    }

    echo <<<ADDRESS
        Kod pocztowy: $zipCode,
        Miasto: $city<br>
        Ulica: $street
        <hr>
ADDRESS;
})->name('address');

//Route::redirect('/adres', '/address');

Route::redirect('/adres/{city?}/{street?}/{zipcode?}','/address/{city?}/{street?}/{zipcode?}');


Route::prefix('admin')->group(function(){
    
    Route::get('/home/{name}', function(String $name){
        echo "Witaj $name na stronie administracyjnej";
    });

    Route::get('users', function(){
        echo '<h3>Użytkownicy systemu</h3>';
    });
});