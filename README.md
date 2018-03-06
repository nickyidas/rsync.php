Deployer *by PHP-CLI*
=====================

Code deployment tool based on RSYNC running by PHP-CLI script

[![Latest Stable Version](https://poser.pugx.org/yidas/deployer-php-cli/v/stable?format=flat-square)](https://packagist.org/packages/yidas/deployer-php-cli)
[![Latest Unstable Version](https://poser.pugx.org/yidas/deployer-php-cli/v/unstable?format=flat-square)](https://packagist.org/packages/yidas/deployer-php-cli)
[![License](https://poser.pugx.org/yidas/deployer-php-cli/license?format=flat-square)](https://packagist.org/packages/yidas/deployer-php-cli)

FEATURES
--------

- *Deploy to **multiple** servers by **projects/groups***

- ***Git support** for source project*

- ***Composer support** for source project*

- ***Filter** for excluding specified files support*

Helping developers to deploy codes from local instance to remote instances.

---

DEMONSTRATION
-------------

Deploy local project to remote servers by just executing the deployer in command after installation:

```
$ deployer
```
Or you can call the origin bootstrap:
```
$ ./deployer.php
$ php ./deployer.php
```

The result could like be:
```
$ deployer

Successful Excuted Task: Git
Successful Excuted Task: Composer
Successful Excuted Task: Deploy to 127.0.0.1
Successful Excuted Task: Deploy
```

---

INSTALLATION
------------

### Download

You could choose a install way between Composer or Wget:

#### Composer Installation

```
composer create-project yidas/deployer-php-cli
```

#### Wget Installation

You could see [Release](https://github.com/yidas/deployer-php-cli/releases) for picking up the package with version, for example:
    
```
$ wget https://github.com/yidas/deployer-php-cli/archive/master.tar.gz -O deployer-php-cli.tar.gz
```

After download, uncompress the package:

```
$ tar -zxvf deployer-php-cli.tar.gz
```

### Make Command

To make a command for deployer, `cd` into the folder, then create `deployer.php` a symbol link to bin folder: 

```
$ sudo ln -s $(pwd -L)/deployer.php /usr/bin/deployer
```

> you could check `deployer.php` file is executable, if not you can modify excuted property by `chmod +x`.

After all, you could start to set up the `config.inc.php` for deployer, and enjoy to use:

```
$ deployer
```

---

CONFIGURATION
-------------

### Project Setting:

You need to set up the projects configuration such as servers, source and destination in `config.inc.php` file:

```php
<?php

return [
    'default' => [
        'servers' => [
            '127.0.0.1',
        ],
        'user' => [
            'local' => '',
            'remote' => '',
        ],
        'source' => '/var/www/html/project',
        'destination' => '/var/www/html/test/',
        'exclude' => [
            'web/upload',
            'runtime/log',
        ],
        'git' => [
            'enabled' => true,
            'checkout' => true,
            'branch' => 'master',
        ],
        'composer' => [
            'enabled' => true,
            'command' => 'composer update',
        ],
        'rsync' => [
            'params' => '-av --delete',
            'sleepSeconds' => 0,
        ],
        'commands' => [
            'before' => [
                '',
            ],
        ],
        'verbose' => false,
    ]
];
```

### Config Options

|Key|Type|Description|
|:-|:-|:-|
|**servers**|array|Distant server host list|
|**user**|array\|string|Local/Remote server user, auto detect current user if empty|
|**source**|string|Local directory for deploy, use `/` as end means `*` |
|**destination**|string|Remote path for synchronism|
|**exclude**|array|Excluded files based on sourceFile path|
|verbose|bool|Enable verbose with more infomation or not|

#### Git

|Key|Type|Description|
|:-|:-|:-|
|enabled|bool|Enable git or not|
|checkout|bool|Execute git checkout -- . before git pull  |
|branch|string|Branch name for git pull, pull default branch if empty  |

#### Composer

|Key|Type|Description|
|:-|:-|:-|
|enabled|bool|Enable Composer or not|
|command|string|Update command likes `composer update`|

#### Rsync

|Key|Type|Description|
|:-|:-|:-|
|params|string|Addition params of rsync command|
|sleepSeconds|int|Seconds waiting of each rsync connections|

#### Commands

|Key|Type|Description|
|:-|:-|:-|
|init|array|Addition commands trigger at initialization|
|before|array|Addition commands trigger before deploying|
|after|array|Addition commands trigger after deploying|

### Example

* Copy `project` directory form `/var/www/html/` to destination under `/var/www/html/test/`:

```php
'source' => '/var/www/html/project',
'destination' => '/var/www/html/test/',
```

* Copy all files (`*`) form `/var/www/html/project/` to destination under `/var/www/html/test/`:

```php
'source' => '/var/www/html/project/',
'destination' => '/var/www/html/test/',
```

---

USAGE
-----

```
$ deployer                    // Deploy default project
$ deployer default            // Deploy default project
$ deployer my_project         // Deploy the project named `my_project` by key
$ deployer deafult config     // Show configuration of default project
```

---

ADDITION
--------

### Rsync without Password:  

You can put your local user's SSH public key to destination server user for authorization.
```
.ssh/id_rsa.pub >> .ssh/authorized_keys
```

### Save Binary Encode File:  
  
While excuting script, if you get the error like `Exception: Zend Extension ./deployer does not exist`, you may save the script file with binary encode, which could done by using `vim`:

```
:set ff=unix
```



