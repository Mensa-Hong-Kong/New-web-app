# Laravel deployer #  
git ignored vendor  
please run on laravel folder: composer install  

## LaravelCollective library ##  
Collective\FormBuilder::getAppendage()  
row ~138  
from:  
    $method = Arr::get($options, 'method', 'post');  
to:  
    $method = Arr::get($options, 'method', 'post');  
    $attributes['data-method'] = $method;  

# ionic deployer #  
please run on ionic folder and mensa-app folder: npm install  
