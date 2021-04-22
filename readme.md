### Install
Run command: `composer install`
### Run from CLI
`./name-sorter ./unsorted-names-list.txt`  
*The prefix ./ might be needed on your system*

* When there's no option  
  `./name-sorter`  
  Output: *The CLI script needs one and only one option*
### Unit test
Run:  
`./vendor/bin/phpunit ./tests/NameSorterTest.php`  
*Please change forward-slash to backslash on Windows*
