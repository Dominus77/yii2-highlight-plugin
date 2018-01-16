# yii2-highlight-plugin

[![Latest Stable Version](https://poser.pugx.org/dominus77/yii2-highlight-plugin/v/stable)](https://packagist.org/packages/dominus77/yii2-highlight-plugin)
[![License](https://poser.pugx.org/dominus77/yii2-highlight-plugin/license)](https://github.com/Dominus77/yii2-highlight-plugin/blob/master/LICENSE.md)
[![Build Status](https://travis-ci.org/Dominus77/yii2-highlight-plugin.svg?branch=master)](https://travis-ci.org/Dominus77/yii2-highlight-plugin)
[![Code Coverage](https://scrutinizer-ci.com/g/Dominus77/yii2-highlight-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-highlight-plugin/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dominus77/yii2-highlight-plugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-highlight-plugin/?branch=master)
[![Total Downloads](https://poser.pugx.org/dominus77/yii2-highlight-plugin/downloads)](https://packagist.org/packages/dominus77/yii2-highlight-plugin)

Yii2 Syntax highlighting with support for line numbering for the Web.

176 languages and 79 styles

The plugin is based on [highlight.js](https://highlightjs.org/), added support for line numbering with the plugin [highlightjs-line-numbers.js](https://github.com/wcoder/highlightjs-line-numbers.js)


Auto language definition
```
<pre><code>...</code></pre>
```
Explicit language specification
```
<pre><code class="php">...</code></pre>
<pre><code class="css">...</code></pre>
<pre><code class="json">...</code></pre>
...
```
Add class hljs, render full block code
```
<pre><code class="php hljs">...</code></pre>
<pre><code class="css hljs">...</code></pre>
<pre><code class="json hljs">...</code></pre>
...
```
Watch [demo](https://highlightjs.org/static/demo/)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require dominus77/yii2-highlight-plugin "*"
```

or add

```
"dominus77/yii2-highlight-plugin": "*"
```

to the require section of your `composer.json` file.

## Usage

Once the extension is installed, simply use it in your code by  View:
```
<?php
/** $this \yii\web\View */
\dominus77\highlight\Plugin::register($this);
```
## Configure plugin

### Theme
See the following link for supported topics [Styles](https://github.com/Dominus77/yii2-highlight-plugin/tree/master/src/styles)
```
<?php
\dominus77\highlight\Plugin::$options = [
    'theme' => 'paraiso-dark',// Styles       
];
/** $this \yii\web\View */
\dominus77\highlight\Plugin::register($this);
```
### Line Numbers
By default, line numbers are disabled
```
<?php
\dominus77\highlight\Plugin::$options = [
    //...
    'lineNumbers' => true,    // Show line numbers
    'singleLine' => true,     // Show number if one line    
];
/** $this \yii\web\View */
\dominus77\highlight\Plugin::register($this);
```
### Custom init
```
<?php
\dominus77\highlight\Plugin::$options = [
    //...
    // Custom init Highlight
    'highlightInit' => new \yii\web\JsExpression("
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    "),
    // Custom init Highlight Line Numbers
    'lineNumbersInit' => new \yii\web\JsExpression("
        $('code.hljs').each(function(i, block) {
            hljs.lineNumbersBlock(block);
        });
    "),
];
/** $this \yii\web\View */
\dominus77\highlight\Plugin::register($this);
```
## Testing
```
$ phpunit
```
### More Information
Please, check the [highlight.js](https://highlightjs.org/) and [highlightjs-line-numbers.js](https://github.com/wcoder/highlightjs-line-numbers.js)

### License
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-highlight-plugin/blob/master/LICENSE.md) for more information.
