YiiCms 企业站管理系统，基于 yii2 basic 开发
===============================


页面前台样式基于bootStrap 3.0 开发，管理后台样式是 adminLTE，权限部分使用 yii2-admin,大部分都是拿来主义，不想重复造轮...
第三方包依赖管理使用 composer
YiiCms gitHub 地址：https://github.com/yongshengli/yiicms/

yiicms 主要功能：
1. 新闻管理
2. 产品管理
3. 下载管理
4. 图片管理
5. 后台权限rbac
6. 前台菜单自定义、后台菜单自定义
7. 多模板多主题
8. 内容批量操作
9. 多语言支持
10. 友情链接

YiiCms版权
----------

http://git.oschina.net/templi/yiicms/blob/master/LICENSE.md

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/            contains modules  
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      yiicms.sql          sql file
      composer.json       
    

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.5.0.


INSTALLATION
------------

~~~
1. php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
   php composer.phar create-project --prefer-dist --stability=dev sheng/yiicms yiicms

2. import yiicms.sql

3. Database config

4. 配置 ngixn 虚拟机或者apache虚拟机 网站根目录指向 yiicms/web/

5. 不能将yiicms/web作为根目录时，可将yiicms/web 目录下的文件全部移动到 yiicms下，否则跳过此步骤

~~~

### Database

Edit the file `config/db.php` with real data, for example:

```php
//demo file config/db.php.default 文件
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yiicms',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',
];
```



**NOTES:**
~~~
配置完成后可通过如下地址访问前台/后台

http://domain.com/ 前台
http://domain.com/backend.html 后台


~~~

YiiCms使用手册
-------------

http://www.zbeijing.com.cn/news/list/10.html




关于route规则（url美化）配置
-----------------------------
请参考yii2用户指南
http://www.yiiframework.com/doc-2.0/guide-runtime-routing.html#using-pretty-urls

中文权威指南
http://www.yiichina.com/doc/guide/2.0/rest-routing




TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
composer exec codecept run
``` 

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

5. (Optional) Create `yii2_basic_tests` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   composer exec codecept run

   # run acceptance tests
   composer exec codecept run acceptance

   # run only unit and functional tests
   composer exec codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
composer exec codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
composer exec codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
composer exec codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.