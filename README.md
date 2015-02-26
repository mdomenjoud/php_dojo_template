
# Install dependencies :

    If you don't have Composer installed globally, please install it. The line below will install the PEAR package locally :

```sh
php -r "readfile('https://getcomposer.org/installer');" | php
```

More informations about installation [here](https://getcomposer.org/doc/00-intro.md)

    Then install the dependencies :

```sh
php composer.phar install
```

    Check that everything woks fine :

```
./vendor/bin/phpunit
```

# Ready to start your Dojo

For example, you can try the [CoffeeMachine Dojo](http://simcap.github.io/coffeemachine/)
