Truncate
========

A simple Blocks CMS plugin/Twig filter.

Usage
=====

{{ entry.body | truncate('words', '150', '...') }}

Params
======

- Unit: words or chars. Defaults to chars.
- Limit: Defaults to 150.
- Ending: Defaults to an empty string.
