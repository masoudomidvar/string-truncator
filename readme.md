# String Truncator

The purpose of this small application is to truncate a given string to a specified length with below conditions:<br/>
    - The preview should never be longer than 1000 characters.<br/>
    - When possible, the preview should end after a complete sentence.

It is implemented with Pure PHP.

## Prerequisites

- PHP 8.1 or higher
- An available localhost

## Project Information

I have implemented the single functionality of this app in a module called StringTruncator.

Some design patterns like Factory and Facade and Data Transfer Object are used inside this module.

Various OOP principles are used in this application.

StringTruncatorTransfer class is used as the DTO to handle data used inside StringTruncator module.

StringTruncatorFacade class has a truncateString method which is considered as the main API to this module.

StringTruncatorFactory class is used to instantiate the classes inside the StringTruncator module.

## Test

StringTruncatorTest class is used to test this module.

A bunch of different test scenarios are defined in the examples method.

Each scenario consists of:<br/>
- String: The original string to be truncated.<br/>
- Limit: An integer to specify the length of truncation.<br/>
- Expected: Expected string after truncation.<br/>
- Points: Points recieved after truncation.

## Run

1. Clone the project in your localhost directory

    ```sh
    git clone https://github.com/masoudomidvar/string-truncator.git
    ```

2. Open the string-truncator directory in your localhost. By doing this, the test will be executed.

    ```sh
    http://localhost/string-truncator
    ```
