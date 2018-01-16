<?php

namespace tests;

use dominus77\highlight\Plugin;
use yii\web\AssetBundle;

/**
 * Class PluginTest
 * @package tests
 */
class PluginTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function testRegisterPlugin()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        Plugin::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\highlight\\Plugin'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('highlight.pack.js', $content);
    }

    /**
     * @inheritdoc
     */
    public function testRegisterPluginTheme()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        Plugin::$options = [
            'theme' => 'paraiso-dark',  // Styles
        ];
        Plugin::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\highlight\\Plugin'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('paraiso-dark.css', $content);
        $this->assertContains('highlight.pack.js', $content);
    }

    /**
     * @inheritdoc
     */
    public function testRegisterPluginLineNumberOn()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        Plugin::$options = [
            'theme' => 'paraiso-dark',  // Styles
            'lineNumbers' => true,      // Show line numbers
            'singleLine' => true,       // Show number if one line
        ];
        Plugin::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\highlight\\Plugin'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('paraiso-dark.css', $content);
        $this->assertContains('highlight.pack.js', $content);
        $this->assertContains('highlightjs-line-numbers.min.js', $content);
    }

    /**
     * @inheritdoc
     */
    public function testRegisterPluginLineNumberOff()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        Plugin::$options = [
            'theme' => 'paraiso-dark',  // Styles
            'lineNumbers' => false,     // Show line numbers
            'singleLine' => true,       // Show number if one line
        ];
        Plugin::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\highlight\\Plugin'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('paraiso-dark.css', $content);
        $this->assertContains('highlight.pack.js', $content);
        $this->assertNotContains('highlightjs-line-numbers.min.js', $content);
    }
}
