# PHP code challenge goal
This code is refactored version of [SullysMustyRuby/php_code_challenge](https://github.com/SullysMustyRuby/php_code_challenge) master branch as of June 27 - 2022. It delivered as as assignment to Hivelocity Inc.

# Requirements
- PHP is installed in your machine.
- PHP version install should be >= 7.3.
- Composer(dependency management for PHP) is installed in your machine.

## Install Dev dependencies
```
$ cd /path/to/php_code_challenge
$ composer install
```

## Directory & files structure
```
├── ...
├── .gitignore                       # Contains list of files to ignore when committing project.
├── src                              # Directory where all logic is written.
│   ├── CommonConst.php              # Common constant varaibles file.
│   ├── FinalResult.php              # Business logic file.
├── tests                            # Directory for tests.
|   ├── support                      # Directory containing files used for testing.
|   |   ├─ data_sample.tmp.csv       # Data sample file used for PHP unit testing of bl.
├── composer.json                    # Common project properties/meta/dependencies. 
├── README.md                        # Essential guide for repo.
└── ...
```

## Test Cases 
Before performing test cases, make sure dev dependecies are completely installed.

| Test Case Condition | Command to Run | Expected Response | Result |
| --- | --- |--- | --- |
| Sample CSV file don't exist | composer run-script test-case-sample-file-not-exists | File not found | :ok: |
| Sample CSV file don't have read permissions | composer run-script test-case-sample-file-permissions-error | Read Permission denied to file | :ok: |
| Sample CSV file exist & have read permissions & is Empty | composer run-script test-case-sample-file-empty | Empty file | :ok: |
| Sample CSV file exist & have read permissions & is NOT Empty | composer run-script run-unit-test | Ok | :ok: |