<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class TemplaterController
 * @package app\controllers
 */
class TemplaterController extends Controller
{

    /**
     * @var string -  relative path prototype files
     */
    private $sourcePath = '/data/scr';
    /**
     * @var string -extencion prototype files
     */
    private $sourceExt = 'html';
    /**
     * @var string relative path for convertered files
     */
    private $outputPath = '/data/qtpl/';
    /**
     * @var string - extencion files convertered
     */
    private $outputExt = 'qtpl';
    private $dataExt = 'json';
    private $flagDataInQtpl = true;
    /**
     * @var array -templates
     */
    private $templates = [
        'import' => '{% import (
    "strings"
    "fmt"
) %}',
        'func_empty' => '',
        'func_page' => '{% func renderNewPage(name string) %}',
        'func_html' => '{% func renderHtml() %}',
        'func_form' => '{% func renderNewform(key,  title string, idx int, enctype, method, action, target,  dataJson string) %}',
        'func_input' => '{% func renderNewInput(key, title string, idx int, typeinput, value, dataJson string) %}',
        'func_textarea' => '{% func renderNewTextarea(key, name string, idx int, placeholder, value,  dataJson string) %}',

        'str_form' => '<form name="{%s key %}{%s idx %}"  enctype="{%s enctype %}" method="{%s method %}"  action="{%s action %}" target="{%s target %}" {%s dataJson %} >',
        'str_form' => '</form>',
        'func_checkbox' => '{% func renderCheckBox(key, val, title string, idx int, checked, events, dataJson string) %}',
        'func_radio' => '{% func renderRadioBox(key, val, title string, idx int, checked, events, dataJson string) %}',
        'endfunc' => '{% endfunc %}',

        'tmpl_tag' => '<<<tag>> <<strAttr>> />',
        'tmpl_tag_combine' => '<<<tag>> <<strAttr>> > <<content>></<<tag>>>',
        'tmpl_base' => "<<endfunc>><<func>>\n <<strTag>>\n <<endfunc>><<func_html>>",
        'tmpl_base_tag' => "<<endfunc>><<func>>\n <<strTag>>\n <<endfunc>><<func_html>>",
        'tmpl_input' => "<<endfunc>><<func>>\n <<strTag>> <<endfunc>><<func_html>>",
        'tmpl_attr' => ' <<attr>>="<<val>>"',
//        'tmpl_textare' => "<<func>>\n <<strTag>> <<val>>",
    ];
    private $flagDataInFile = false;
    /**
     * @var string -root path (from relative folders)
     */
    private $rootPath = '/';
    /**
     * @var array required attributes for converted tags
     */
    private $requiredAttr = array(
        'input' => array(
            'name',
            'value'
        ),
        'textarea' => array(
            'name',
            'value'
        )
    );
    /**
     * @var - params attributes from prototype files
     */
    private $dataTags;
    /**
     * @var array - names attributes for convertered tags
     */
    private $templNameAttr = array(
        'input' => array(
            'name' => '{%s inputs[i]nameinput %}',
            'value' => '{%s inputs[i]val %}',
            'placeholder' => '{%s inputs[i]placeholder%}',
        ),

        'checkbox' => array(
            'name' => '{%s checkboxkey %}',
            'value' => '{%s val %}',
            'checked' => '{%s= checked %}',
            'id' => '{%s key %}{%d idx %}',
        ),
        'textarea' => array(
            'name' => '{%s name %}',
            'value' => '{%s val %}',
            'placeholder' => '{%s placeholder %}',
        )
    );
    /**
     * @var array - converterd tags or regexp pattern for find this tags
     */
    private $convertedTags = array(
        'input' => '/(<(input)\s*([^>]*)?>)/is',
        'textarea' => '/(<(textarea).*?>)(.*?)<\/textarea>/is',
    );

    /**
     * @var array - regexp pattern and replace for remove
     */
    private $erasePattern = array(
        'pattern' => array(
            '/<!DOCTYPE html[^>]*?>\s/',
            '/<(\/)?html[^>]*?>\s/',
            '/<(\/)?head[^>]*?>\s/',
            '/<(\/)?meta[^>]*?>\s/',
            '/<(\/)?body[^>]*?>\s/',
            '/<title.+<\/title>\s/',
            '/<link[^>]*?>\s/',
            '/<script(.*?)>(.*?)<\/script>\s/is',
        ),
        'replace' => array(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',

        ),
    );

    public function actionCreate()
    {
        $this->rootPath = Yii::$app->basePath;
        $filelist = scandir($this->rootPath . $this->sourcePath);
        $fileName = 'individual_enterpreneur.html';
//        foreach ($filelist as $fileName) {

            if (preg_match('/.+\.' . $this->sourceExt . '$/', $fileName)) {
                $this->convertFile($fileName);
                print_r($fileName . '</br>');
            }
//        }

//        return $this->render('index');
    }

    /**
     * @param $filename
     * Method for converted one file
     */
    private function convertFile($filename)
    {
        if (!empty($this->dataTags)) {
            $this->resetObject($this->dataTags);
        }

        $file_source_path = $this->rootPath . $this->sourcePath . '/' . $filename;


        if (file_exists($file_source_path)) {
            $fileContent = file_get_contents($file_source_path);
            $fileContent = $this->removeBOM($fileContent);
            $saveData = $this->clearContent($fileContent);
            $saveData = $this->convertTags($saveData);
            $saveData = trim($saveData);

            $func_html = $this->getTemplate('func_html');
            $endfunc = $this->getTemplate('endfunc');

            if (!empty((array)$this->dataTags)) {
                print_r('<pre>');
                print_r($this->dataTags);
                print_r('</pre>');
                $dataFile = json_encode($this->dataTags);
//                $func = $this->getTemplate('func_form');
//                $saveData = $this->getTemplateParam('tmpl_base', ['func'=>$func, 'strTag'=>$saveData, 'endfunc'=>$endfunc] );
                if ($this->flagDataInFile) {
                    $file_output_data = $this->rootPath . $this->outputPath . '/'
                        . str_replace('.' . $this->sourceExt, '', $filename) . '.' . $this->dataExt;

                    if (file_put_contents($file_output_data, $dataFile)) {
                        chmod($file_output_data, 0777);
                    } else {
                        $err = 1;
                        echo "Не получилось записать файл данных исходника" . $file_output_data;
                    };
                }
                if ($this->flagDataInQtpl) {
                    $saveData = '<!--' . $dataFile . "-->\n" . $saveData;
                }

            }


            $saveData = $func_html . $saveData . $endfunc;

            $file_output_path = $this->rootPath . $this->outputPath . '/'
                . str_replace('.' . $this->sourceExt, '', $filename) . '.' . $this->outputExt;
            if (file_put_contents($file_output_path, $saveData)) {
                chmod($file_output_path, 0777);
            } else {
                $err = 1;
                echo "Не получилось записать cконвертированный файл " . $file_output_path;
            };


        } else {
            $err = 1;
            echo "Не получилось открыть файл " . $file_source_path . '<br>';
        }
    }

    /**
     * @param $content
     * @return mixed
     * Method for clear not necessary tags
     */
    private function clearContent($content)
    {
        $content = preg_replace($this->erasePattern['pattern'], $this->erasePattern['replace'], $content);
        return $content;
    }

    /**
     * @param $content
     * @return mixed
     * Method converted required tags
     */
    private function convertTags($content)
    {
        foreach ($this->convertedTags as $tag => $pattern) {
            $content = preg_replace_callback($pattern, array($this, 'callReplaceTags'), $content);
        }

        return $content;
    }

    /**
     * @param $matches
     * @return string
     * Callback function for  preg_replace_callback in convertTags
     */
    public function callReplaceTags($matches)
    {
        $replaceString = $this->convertTag($matches, $matches[2]);
        return $replaceString;
    }


    /**
     * @param $content
     * @param $tag
     * @return array
     * Method getting attributes for required tags
     * @output array('attr1'=>'val1', 'attr2'=>'val2')
     */
    private function getTagAttributes($content, $tag)
    {
        $strAttributes = str_replace('<' . $tag, '',
            str_replace('/>' . $tag, '',
                str_replace('</' . $tag, '>',
                    $content)
            ));

        preg_match_all("/\b(\w+=([\"'])[^\\2]*?\\2)/", $strAttributes, $pairs);
        $pairs = $pairs[0];


        $attrs = Array();
        foreach ($pairs AS $pair) {
            $atr = array_map(array($this, "trim_quotes"), preg_split("/\s*=\s*/", $pair));
            $attrs[$atr[0]] = $atr[1];
        }
        return $attrs;
    }

    /**
     * @param $data
     * @return mixed
     * Trimming quotes
     */
    private function trim_quotes($data)
    {
        $data = preg_replace("/(^['\"]|['\"]$)/", "", $data);
        return $data;
    }

    /**
     * @param $obj
     * Method clear not emty object variables
     * use for clear  convertFile
     */
    private function resetObject($obj)
    {
        foreach ($obj as $key => $value) {
            unset($obj->$key);
        }
    }

    private function getTemplate($nametemplate)
    {
        return $this->templates[$nametemplate];
    }

    private function getTemplateParam($nametemplate, $params = array())
    {
        $result = $this->templates[$nametemplate];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $result = str_replace('<<' . $key . '>>', $value,
                    $result);
            }
        }
        preg_replace('/<<[^>]+?>>/', '', $result);

        return $result;
    }


    /**
     * @param $matches
     * @param string $tag
     * @return string
     * Method convertation required tags
     */
    public function convertTag($matches, $tag = 'input')
    {
//        $result = '<' . $tag;
        $usedAttr = [];
//        $templateTag  ='tmpl_tag';
//        $templateResutl = 'tmpl_base';
        $templateName = $tag;
        switch ($tag) {
            case 'input':
                $attributes = $this->getTagAttributes($matches[0], $tag);

                if (!empty($attributes)
                    && isset($attributes['type'])
                    && $attributes['type'] == 'checkbox'
                ) {
                    $templateName = 'checkbox';
                }
                break;
            case 'textarea':
                $attributes = $this->getTagAttributes($matches[1], $tag);
                break;
            default:
                $attributes = $this->getTagAttributes($matches[0], $tag);
        }
        $strAttr = '';
        foreach ($attributes as $attribute => $value) {
            if (in_array($attribute, $this->requiredAttr[$tag])) {
                $strAttr .= $this->getTemplateParam('tmpl_attr',
                    array('attr' => $attribute, 'val' => $this->templNameAttr[$templateName][$attribute]));
                $usedAttr[] = $attribute;
            } else {
                $strAttr .= $this->getTemplateParam('tmpl_attr', array('attr' => $attribute, 'val' => $value));
            }
        }
        foreach ($this->requiredAttr[$tag] as $require) {
            if (!in_array($require, $usedAttr)) {
                if (!($tag == 'textarea' && $require == 'value')) {
                    $strAttr .= $this->getTemplateParam('tmpl_attr',
                        array('attr' => $require, 'val' => $this->templNameAttr[$templateName][$require]));
                }
            }
        }
//        print_r($strAttr);
        if ($tag != 'textarea') {
            $strTag = $this->getTemplateParam('tmpl_tag', array('tag' => $tag, 'strAttr' => $strAttr));
        } else {
            $strTag = $this->getTemplateParam('tmpl_tag_combine',
                array('tag' => $tag, 'strAttr' => $strAttr, 'content' => $matches[3]));
            $attributes['value'] = $matches[3];
        }


        $func = $this->getTemplate('func_' . $templateName);
        $func_html = $this->getTemplate('func_html');
        $endfunc = $this->getTemplate('endfunc');
        $this->dataTags->$templateName[] = $attributes;
        $result = $this->getTemplateParam('tmpl_base', [
            'func' => $func,
            'strTag' => $strTag,
            'endfunc' => $endfunc,
            'func_html' => $func_html
        ]);
        return $result;
    }

    function removeBOM($str = "")
    {
        if (substr($str, 0, 3) == pack('CCC', 0xef, 0xbb, 0xbf)) {
            $str = substr($str, 3);
        }
        return $str;
    }
}
