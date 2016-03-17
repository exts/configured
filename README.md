# Exts\Configured

This is a library created for loading different types of config files into arrays and being able to easily manage
the configuration data using either dot notation or directly accessing the array data.

## Installation

`composer require exts/configured:1.*`

## Example
```php
    use Exts\Configured\ConfigLoader;
    use Exts\Configured\Loader\YAML;
    
    $config = new ConfigLoader(new Yaml(__DIR__ . '/config'));
    
    // load data directly from file using dot notation
    // database = filename 'database.yml'
    //
    // yaml data example:
    // -------------------
    //  user: 'example'
    //  pass: 'examplepwd'
    //  host: '127.0.0.1'
    //  tble: 'example_table'
    // -------------------
    
    $dbUser = $config->get('database.user', 'root');
    $dbPass = $config->get('database.pass', 'pass');
    $dbTble = $config->get('database.tble', 'example');
    $dbHost = $config->get('database.host', 'localhost');
    
    var_dump($dbUser, $dbPass, $dbTble, $dbHost);
    
    // you can also load the data as an array object
    // this takes a filename directly you can include or exclude the extension 'yml' as an example
    $db = $config->getArrayObject('database');
    
    // you can access the array data directly like so:
    $dbUser = $db['user'] ?? 'root';
    
    // you can access the data using dot notation lets say our data looked like laravel for example:
    // ---------------------
    // default: 'mysql'
    // connections:
    //   mysql:
    //     driver: 'mysql'
    //     host: 'localhost'
    //     database: ''
    //     username: ''
    //     password: ''
    //     charset: 'utf8'
    //     collation: 'utf8_unicode_ci'
    //     prefix: ''
    // ---------------------
    // Then we could do something like:
    
    $dbUser = $db->get('connections.mysql.username', 'root');
    
    // We can also edit or add mysql data directly using dot notation like so:
    $db->set('connections.mysql.username', 'example_user');
    var_dump($db['connections']['mysql']['username']);
    
    // Which I think is pretty cool_
    
```

## Saving an `ConfigArray` object using `ConfigStorage` *(since v1.1)*

```php
    use Exts\Configured\ConfigArray;
    use Exts\Configured\ConfigStorage;
    use Exts\Configured\Storage\YAML;
    
    $saveFile = 'example.yml';
    $saveDirectory = __DIR__ . '/config/';
    
    $exampleArrayObject = new ConfigArray(['example', 'data']);
    
    $exampleStorage = new ConfigStorage(new YAML($saveDirectory));
    $exampleStorage->store($saveFile, (array) $exampleArrayObject);
```

## Custom Loaders

Custom loaders are pretty simple, just create a class that implements the `LoaderInterface` and call it a day :), will
write an example w/ tests later if you'd like.