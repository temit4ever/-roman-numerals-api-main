## Design Approach
The Purpose of the work is to create a RESTful API for converting integers number to Roman numerals, storing them in
a database before returning a Json response, and providing two other endpoints to retrieve recently converted integers 
and the top 10 of most-converted integers. The solution was designed with Laravel's best practices, features, and using 
MVC architecture, and focusing on maintainability, testability, and compliance with modern PHP(8.3) standards (PSR-12).

## Reasons for the approach are below
- Separation of Concerns (SOC) - SOLID PRINCIPLE
The controller is used to handle request and specific logic that belongs to specific method is delegated
to the actions class which in-turn execute a specific method of the interface.
Implemented ConversionResource to structure the API responses consistently for a cleaner output format.
Introduced an IntegerConverterService to encapsulate the logic of converting integers
to Roman numerals. This adheres to the Single Responsibility Principle and ensures reusability and
testability.
- Validation
The use of Laravel's FormRequest class helps to validate user inputs especially when a string is input as an integer, 
the use of an anonymous function helps to address the problem. Also, validation is also provided
for integer range between 1-1339
- Implementation of design pattern - Interface design driven
The IntegerConverterInterface define the contract(IntegerConverterService) for conversion logic, get
the recent conversion and the top ten conversion. This allows easy substitution of different implementations if needed
- Test Coverage
Wrote unit tests to ensure the IntegerConverterInterface and its implementation work as expected.

Finally, the implementation of the task has involved the utilization of development best practices like
SOLID Principles, Design Pattern and TDD (using PHPUnit), these create chance for
scalability, maintainability, readability, Consistency.
