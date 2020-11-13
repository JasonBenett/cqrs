# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [2.1.0] - 2020-11-13
### Added
* Middleware abstractions provided for Command and Query Buses. 

## [2.0.0] - 2020-11-13
### Changed
* Command Handlers and Command Buses returns now a `CommandResponseInterface`.

## [1.0.0] - 2020-10-31
### Added
* `CommandHandlerInterface` and `QueryHandlerInterface` to handle Command and Query objects
* `DirectCommandBus` and `DirectQueryBus` to route Command and Query objects to their handlers directly.
* Exceptions thrown when no handler found for a query or for a command.
* `QueryResponseInterface` to encapsulate the data to get back on a query.
