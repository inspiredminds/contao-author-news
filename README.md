[![](https://img.shields.io/packagist/v/inspiredminds/contao-author-news.svg)](https://packagist.org/packages/inspiredminds/contao-author-news)
[![](https://img.shields.io/packagist/dt/inspiredminds/contao-author-news.svg)](https://packagist.org/packages/inspiredminds/contao-author-news)

Contao Author News
=====================

Contao extension to provide an author filter for the news list.

## Usage

Simply create a newslist module and enable the author filter. You will then be able to select a default author, by which the news items will be filtered. This filter can be overriden via an `author` GET parameter. e.g. by using `?author=…` or `\Input::setGet('author', …)`.

This extension is also compatible with the `news_categories` extension. So you can filter by a category _and_ and an author, if you wish to.
