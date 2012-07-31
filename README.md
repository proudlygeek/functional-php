FunctionalPHP (Yeah, need to find a better name)
================================================

A small PHP sets of functional methods inspired by [Underscore.js][1].

Example
-------

Given the following *list of objects*:

```php
$devs = array(
    array(
        'name' => "Gianpiero",
        'last' => "Fiorelli",
        'skills' => array('CSS', 'JavaScript', 'PHP', 'HTML')
    ),
    array(
        'name' => "Simone",
        'last' => "Di Maulo",
        'skills' => array('PHP', 'Ruby', 'CSS', 'MySQL')
    ),
    array(
        'name' => "Gianluca",
        'last' => "Bargelli",
        'skills' => array('Ruby', 'JavaScript', 'PHP', 'HTML', 'CSS')
    ),
    array(
        'name' => "Giulio",
        'last' => "De Donato",
        'skills' => array('CSS', 'JavaScript', 'PHP', 'HTML')
    ),
    array(
        'name' => "Erin",
        'last' => "Hima",
        'skills' => array('PHP', 'MySQL')
    ),
);
```

we want to *select all developers whose names begins with a 'g', does not know 'Ruby' and, finally, return a list
of their names*:

```php
$result = Core::chain($devs)
            ->select(function($el) { return strtolower(substr($el['name'], 0, 1)) == "g"; })
            ->reject(function($el) { return in_array("Ruby", $el['skills']); })
            ->pluck('name')
            ->value();
```

Which results in:

```php
array("Gianpiero", "Giulio");
```

Fork & Contributions
--------------------

Any contribution is *welcome*, just fork it and add some tests :)

[1]: http://underscorejs.org/