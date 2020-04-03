# A Command Line Interface Benchmark tool
================================================

Benchmarks the performance of a set of PHP functions in nanoseconds and generates a report comparing the performance.

```sh
$ php benchmarker.php --file="sample.php" --iterations=10000 --sort="avg:asc"

Name                                Time         Iterations   Min          Max          Average
bm_empty                            17738520     10000        1624         31080        1773
bm_declaring9elementarray           20088840     10000        1783         66498        2008
bm_foreachloop                      23093242     10000        2066         51026        2309
bm_sortinorderarray                 30171411     10000        2796         226557       3017
bm_forloop                          32375533     10000        2928         91255        3237
bm_sortarray                        33865642     10000        2912         174386       3386
```


## Installation
*Requires PHP 7.0 or higher.*

 1. `git clone` _this_ repository.
 2. Download composer: `curl -s https://getcomposer.org/installer | php`
 3. Install dependencies: `php composer.phar install`


## Usage

 - Create a php file.
 - In the file, wrap benchmark functions/procedures in functions. The names of these functions **MUST** start with *bm_*
 Example:
```php
<?php

function bm_declaring9ElementArray()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
}

function bm_sortArray()
{
    $array = [9, 8, 7, 6, 5, 4, 3, 2, 1];
    sort($array);
}

function bm_sortInOrderArray()
{
    $array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    sort($array);
}
```

- Run command
```sh
$ php benchmarker.php --file="path_to_file.php" --iterations=10000 --sort="avg:asc"
```
Output will be similar to:
```
Name                                Time         Iterations   Min          Max          Average
bm_declaring9elementarray           20088840     10000        1783         66498        2008
bm_sortinorderarray                 30171411     10000        2796         226557       3017
bm_sortarray                        33865642     10000        2912         174386       3386
```

- Run `php benchmarker.php —help` to see all options
```
$ php benchmarker.php --help
usage: benchmarker.php [<options>]

Benchmark the performance of given PHP functions and generate a report comparing
the performance.

OPTIONS
  -—file, -f         REQUIRED: The path to file that contains functions to
                     benchmark.
  --format, -fmt     The output format of results.
                     Default = 'screen'
                     ---
                     Available formats: 'screen', 'csv'
  --help, -?         Display this help.
  --iterations, -i   REQUIRED: The number of iterations to run each function.
  --sort, -s         The sorting method(s) to apply to performance results.
                     Will apply sort in order from first to last.
                     ---
                     Available methods: 'total', 'min', 'max', 'avg'
                     Optionally append ':desc' to change order. Default order is
                     ascending.
                     ---
                     Ex: --sort="avg:asc,total:desc,max:asc"
                     Will sort by average ascending, then total descending, then
                     max ascending.
```
