<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
//use yii\console\Controller;

/**
 * Class TemplaterController
 * @package app\controllers
 */
class TemplaterController extends Controller
{

    /**
     * @var string -  relative path prototype files
     */
//    /home/serg/work/site/travel/prototype/Travel_Axure
//    /home/serg/work/site/uvoteam-test/htdocs
    private $sourcePath = '/data/scr';
//    private $sourcePath = '/../../travel/prototype/Travel_Axure';
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
    private $dataExt = 'go';
    private $flagDataInQtpl = true;
    /**
     * @var array -templates
     */

    private $templates = [
        'import' => '{% import (
    "strings"
    "fmt"
) %}',
       'code'=>"\n{% code
                    type inputData struct {
                                name string;
                                typeinput string;
                                title string;
                    }
                    
                    type textareaData struct {
                                name string;
                                typeinput string;
                                title string;
                                value string;
                    
                    
                    }
                    
                     
type checkboxData struct {
    key         string;
    val         string;
    title       string;
    idx         int; 
    checked     string;
    events      string; 
    dataJson    string;
}
    
type dataHtml struct{
    checkboxArr []checkboxData;
    inputArr []inputData;
    textareaArr []textareaData;
%}\n",

        'data_beg' =>"
    if data1 == (dataHtml{}) && data1 ==\"\"{\n
         data := dataHtml{\n",
        'tag_struct_beg' =>"    <<tag>>s: []<<tag>>Data{\n",
        'tag_struct_line' =>"          <<tag>>Data{<<strAttrs>>},\n",
        'tag_struct_str_attrs' =>' <<attr>>: "<<val>>",',
        'tag_struct_end' =>"    },\n",

        'data_end' =>"}else{
    data := data1
}\n",
        'func_empty' => '',
        'func_page' => '{% func renderNewPage(name string) %}',
        'imp_func_rendeCheckbox1' => '
{% func renderCheckBox1(key, val, title string, idx int, checked, events, dataJson string) %}
    <!--<label class="checkbox" for="{%s key %}{%d idx %}">-->
        <input type="checkbox" id="{%s key %}{%d idx %}" name="{%s key %}" value="{%s val %}" {%s= checked %}
                {%s= events %} {%s= dataJson %}
        />
        <!--{%s title %}
    </label>-->
{% endfunc %}
        ',

        'func_html' => "\n{% func renderHtml(data1 *dataHtml ) %}\n",
        'func_form' => '{% func renderNewform(key,  title string, idx int, enctype, method, action, target,  dataJson string) %}',
        'func_input' => '{% func renderNewInput(key, title string, idx int, typeinput, value, dataJson string) %}',
        'func_textarea' => '{% func renderNewTextarea(key, name string, idx int, placeholder, value,  dataJson string) %}',
        'func_checkbox' => '{%= func (data.<<ind>> * checkboxData) renderCheckBox1(key, val, title string, idx int, checked, events, dataJson string) %}',
        'func_radio' => '{% func renderRadioBox(key, val, title string, idx int, checked, events, dataJson string) %}',


        'str_form' => '<form name="{%s key %}{%s idx %}"  enctype="{%s enctype %}" method="{%s method %}"  action="{%s action %}" target="{%s target %}" {%s dataJson %} >',
        'str_form' => '</form>',
        'endfunc' => "\n{% endfunc %}",

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
            'value',
            'title',
        ),
        'textarea' => array(
            'name',
            'value',
        ),
        'checkbox' => array(
            'name',
            'value',
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
            'name' => '{%s data.inputs[<<ind>>].nameinput %}',
            'value' => '{%s data.inputs[<<ind>>].val %}',
            'placeholder' => '{%s data.inputs[<<ind>>].placeholder%}',
            'typeinput' => '{%s data.inputs[<<ind>>].typeinput%}',
            'title' => '{%s data.inputs[<<ind>>].title%}',
            'type' => '{%s data.inputs[<<ind>>].typeattr%}',
        ),
/*
 *     key         string;
    val         string;
    title       string;
    idx         int;
    checked     string;
    events      string;
    dataJson    string;
 */
        'checkbox' => array(
            'id' => '{%s key %}{%d idx %}',
            'name' => '{%s data.checkboxes[<<ind>>].name %}',
            'value' => '{%s data.checkboxes[<<ind>>].val %}',
            'checked' => '{%s data.checkboxes[<<ind>>].checked %}',
            'id' => '{%s data.checkboxes[<<ind>>].id %}',
//            'title' => '{%s data.checkboxes[<<ind>>].title%}',
        ),
        'textarea' => array(
            'name' => '{%s data.textareas[<<ind>>].name %}',
            'value' => '{%s data.textareas[<<ind>>].val %}',
            'placeholder' => '{%s data.textareas[<<ind>>].placeholder %}',
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
                print_r("\n<br / >". $fileName );
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
        $filenameBrief = str_replace('.' . $this->sourceExt, '', $filename);
        $file_source_path = $this->rootPath . $this->sourcePath . '/' . $filename;


        if (file_exists($file_source_path)) {

            $fileContent = file_get_contents($file_source_path);
            $fileContent = $this->removeBOM($fileContent);
            $saveData = $this->clearContent($fileContent);
            $saveData = $this->convertTags($saveData);
            $saveData = trim($saveData);
            $qtplBegin = '';
            $qtplBegin .= $this->getTemplate('import');
            $qtplBegin .= $this->getTemplate('code');

            $endfunc = $this->getTemplate('endfunc');
            $qtplBegin .= $this->getTemplate('func_html');
            if (!empty((array)$this->dataTags)) {

//                print_r('<pre>');
//                print_r($this->dataTags);
//                print_r('</pre>');
//                $dataFile = json_encode($this->dataTags);
////                $func = $this->getTemplate('func_form');
////                $saveData = $this->getTemplateParam('tmpl_base', ['func'=>$func, 'strTag'=>$saveData, 'endfunc'=>$endfunc] );
//                if ($this->flagDataInFile) {
//                    $file_output_data = $this->rootPath . $this->outputPath . '/'
//                        . $filenameBrief . '.' . $this->dataExt;
//
//                    if (file_put_contents($file_output_data, $dataFile)) {
//                        chmod($file_output_data, 0777);
//                    } else {
//                        $err = 1;
//                        echo "Не получилось записать файл данных исходника" . $file_output_data;
//                    };
//                }
//                if ($this->flagDataInQtpl) {
//                    $saveData = '<!--' . $dataFile . "-->\n" . $saveData;
//                }
                $qtplBegin .= $this->getStrConvertDataTags();

            }


            $saveData = $qtplBegin . $saveData . $endfunc;

            $file_output_path = $this->rootPath . $this->outputPath . '/'
                . $filenameBrief . '.' . $this->outputExt;
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
        $template = $this->templates[$nametemplate];

        return $this->getProcessTemplateParam($template, $params);
    }

    private function getProcessTemplateParam($template, $params = array())
    {
        $result = $template;
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
       ;
        $templateNames = $templateName;
        $dataTagsCopy = (array)$this->dataTags;
        if (isset($dataTagsCopy[$templateNames])){
            $ind = count($dataTagsCopy[$templateNames]);
        } else{
            $ind = 0;
        }


        $strAttr = '';
        foreach ($attributes as $attribute => $value) {
            if (in_array($attribute, $this->requiredAttr[$templateName])) {
                $strAttr .= $this->getStrTmplAttribute('tmpl_attr', $templateName, $attribute, $ind);
                $usedAttr[] = $attribute;
            } else {
                $strAttr .= $this->getTemplateParam('tmpl_attr', array('attr' => $attribute, 'val' => $value));
            }
        }

        foreach ($this->requiredAttr[$templateName] as $require) {
            if (!in_array($require, $usedAttr)) {
                if (!($tag == 'textarea' && $require == 'value')) {
                    $this->getStrTmplAttribute('tmpl_attr', $templateName, $require, $ind);
                }
            }
        }

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
        $func = $endfunc = $func_html = '';
        $this->dataTags->$templateNames[] = $attributes;
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

    /**
     * @param $templateBase
     * @param $templateName
     * @param $attribute
     * @param $ind
     * @return string
     */
    private function getStrTmplAttribute($templateBase, $templateName, $attribute, $ind)
    {

        $strConvert = $this->getProcessTemplateParam($this->templNameAttr[$templateName][$attribute],
                                        array('ind'=> $ind));
        $result = $this->getTemplateParam($templateBase,
                                        array('attr' => $attribute, 'val' => $strConvert));
        return $result;
    }

/*
 *         'data_beg' =>'{% code
             data := dataHtml{',
        'tag_struct_beg' =>'<<tag>>s: []<<tag>>Data{',
        'tag_struct_line' =>'<<tag>>Data{<<strAttrs>>},',
        'tag_struct_str_attrs' =>' <<attr>>: "<<val>>",',
        'tag_struct_end' =>'},',
        'data_end' =>'}
             %}',
 */
    /**
     *
     * @return string
     */
    private function getStrConvertDataTags(){
        $result =$this->getTemplate('data_beg');
            foreach ($this->dataTags as $tag=>$arr){
                $result .=$this->getTemplateParam('tag_struct_beg',['tag'=>$tag]);
                foreach ($arr as $datatag){
                    $strAttrs='';
                    foreach ($datatag as $attr=>$val){
                        $strAttrs .= $this->getTemplateParam('tag_struct_str_attrs',['attr'=>$attr,'val'=>$val]);
                    }
                    $result .= $this->getTemplateParam('tag_struct_line',['tag'=>$tag, 'strAttrs' =>$strAttrs]);
                }
                $result .= $this->getTemplate('tag_struct_end');
            }
        $result .= $this->getTemplate('data_end');
//        print_r('<pre>');
//        print_r($result);
//            print_r('</pre>');
        return $result;
    }
}
