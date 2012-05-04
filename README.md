DynamoDB example - Defeat BOSS
==============================

Game example using Amazon Dynamo DB.
This example was built during the Amazon DynamoDB JumpStart Program Hackathon.

Requirements
------------

 * PHP >= 5.2.0
 * extensions: json, curl


Install
-------

1. Download the source code:

    ```
    $ git clone git://github.com/ttsuruoka/dynamodb-example-defeat-boss.git
    $ cd dynamodb-example-defeat-boss
    $ git submodule update --init
    ```

2. Set up your core.php and aws_key.php:

    ```
    $ cd app/config/
    $ cp core_production.php core.php
    $ cp aws_key_example.php aws_key.php
    ```

2. Edit your AWS_ACCESS_KEY_ID/AWS_SECRET_ACCESS_KEY to use the Amazon Web Services.

3. Get the temporary credentials using AWS Security Token Service:

    ```
    $ cd dynamodb-example-defeat-boss
    $ ./script/sts-get-key
    ```

    *Note:* The temporary credentials expire every hour in this example.

4. Create your Amazon DynamoDB table:

    ```
    $ cd dynamodb-example-defeat-boss
    $ ./script/dynamodb-create-table
    ```
    
    This script creates the following table:
    ```
    TableName   | Primary Key Type | Hash Key        | Range Key            | Provisioned Throughput
    -----------------------------------------------------------------------------------------------------
    boss_damage | Hash and Range   | boss_id(String) | date_damaged(Number) | Read/Write capacity units:5
    ```
 
5. Edit your httpd.conf:

    ```
    # dynamodb-example-defeat-boss
    <VirtualHost *:80>
        ServerName dynamodb-example-defeat-boss.example.com
        DocumentRoot /home/example/dynamodb-example-defeat-boss/app/webroot
        <Directory /home/example/dynamodb-example-defeat-boss/app/webroot>
            Order Allow,Deny
            Allow from all
            Options FollowSymlinks
            AllowOverride All
        </Directory>
    </VirtualHost>
    ```

6. Restart your httpd service and you can access your dynamodb-example-defeat-boss.

License
-------

The MIT License

Copyright (c) 2012 Tatsuya Tsuruoka and Barusu team

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

