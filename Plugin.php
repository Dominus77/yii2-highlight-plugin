<?php

namespace dominus77\highlight;

use Yii;
use yii\web\AssetBundle;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class Plugin
 * @package dominus77\highlight
 *
 * Connect to View:
 * \dominus77\highlight\Plugin::register($this);
 *
 */
class Plugin extends AssetBundle
{
    /**
     * @var array
     */
    public static $options = [];

    /**
     * @var string
     */
    public $sourcePath;

    /**
     * @var array
     */
    public $css = [];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/src';
        $this->initPlugin();
    }

    /**
     * Initialize Highlight Plugin
     */
    public function initPlugin()
    {
        $options = ArrayHelper::merge([
            'theme' => 'darkula',     // Themes
            'lineNumbers' => false,   // Show line numbers
            'singleLine' => false,    // Show number if one line
            'cssLineNumbers' => true, // CSS style Line Numbers true/false (Optionals)
            'highlightInit' => new JsExpression("hljs.initHighlightingOnLoad();"), // init Highlight
            'lineNumbersInit' => '',  // init Line Numbers
        ], self::$options);

        $view = Yii::$app->getView();
        $this->css[] = 'styles/' . $options['theme'] . '.css';
        $this->js[] = 'highlight.pack.js';
        $view->registerJs($options['highlightInit'], $view::POS_END);

        if ($options['lineNumbers'] === true) {
            $this->initLineNumbers($options);
        }
    }

    /**
     * LineNumbers
     * @param array $options
     */
    public function initLineNumbers($options = [])
    {
        $view = Yii::$app->getView();
        $this->css[] = ($options['cssLineNumbers'] === true) ? 'css/highlightjs-line-numbers.css' : '';
        $this->js[] = 'highlightjs-line-numbers.min.js';

        if (empty($options['lineNumbersInit'])) {
            $lineNumbersOptions = $this->getOptionsLine($options);
            $options['lineNumbersInit'] = new JsExpression("
                hljs.initLineNumbersOnLoad({$lineNumbersOptions});
            ");
        }
        $view->registerJs($options['lineNumbersInit'], $view::POS_END);
    }

    /**
     * Options highlightjs-line-numbers
     * @param $options array
     * @return string
     */
    public function getOptionsLine($options = [])
    {
        return Json::encode([
            'singleLine' => $options['singleLine'],
        ]);
    }
}
