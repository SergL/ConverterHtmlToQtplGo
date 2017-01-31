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
//    private $sourcePath = '/data/scr';
    private $sourcePath = '/../../travel/prototype/Travel_Axure';
    /**
     * @var string -extencion prototype files
     */
    private $sourceExt = 'html';
    /**
     * @var string relative path for convertered files
     */
    private $outputPath = '/data/templates/';
    /**
     * @var string - extencion files convertered
     */
    private $outputExt = 'qtpl';
    private $dataExt = 'go';
    private $fileNameCur = '';
    private $fileGoStruct = 'template_struct';
    private $flagDataInQtpl = true;
    /**
     * @var array -templates
     */

    private $templates = [

//        'import' => '{% import (
//    "strings"
//    "fmt"
//) %}',
        'package'=>"package templates\n\n",
    'go_struct'=>"package templates\n",
       'code'=>"\n
//{% code
    type InputData struct {
        Key         string;
        Nameinput   string;
        Typeinput   string;
        Title       string;
        Val         string;
        Placeholder string;
    }
                    
    type TextareaData struct {
        Key         string;
        Name        string;
        Typeinput   string;
        Title       string;
        Val       string;
        Placeholder string;
    }

    type CheckboxData struct {
        Name        string;
        Key         string;
        Typeinput   string;
        Val         string;
        Title       string;
        Idx         int; 
        Checked     string;
        Events      string; 
        DataJson    string;
    }
    
    type DataHtml struct{
        Checkboxs   []CheckboxData;
        Inputs      []InputData;
        Textareas   []TextareaData;
    }
//%}
\n",

        'data_beg' =>"\n
           package templates\n
         var Data<<filenameBrief>> = DataHtml{\n",
        'tag_struct_beg' =>"    <<tag>>s: []<<tag>>Data{\n",
        'tag_struct_line' =>"          <<tag>>Data{<<strAttrs>>},\n",
        'tag_struct_str_attrs' =>' <<attr>>: "<<val>>",',
        'tag_struct_end' =>"    },\n",

        'data_end' =>"}\n",
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

        'func_html' => "\n{% func (Data *DataHtml) <<filenameBrief>>() %}\n",
        'func_form' => '{% func renderNewform(key,  title string, idx int, enctype, method, action, target,  dataJson string) %}',
        'func_input' => '{% func renderNewInput(key, title string, idx int, typeinput, value, dataJson string) %}',
        'func_textarea' => '{% func renderNewTextarea(key, name string, idx int, placeholder, value,  dataJson string) %}',
        'func_checkbox' => '{%= func (Data.<<ind>> * checkboxData) renderCheckBox1(key, val, title string, idx int, checked, events, dataJson string) %}',
        'func_radio' => '{% func renderRadioBox(key, val, title string, idx int, checked, events, dataJson string) %}',


        'str_form' => '<form name="{%s key %}{%s idx %}"  enctype="{%s enctype %}" method="{%s method %}"  action="{%s action %}" target="{%s target %}" {%s dataJson %} >',
        'str_form_end' => '</form>',
        'endfunc' => "\n{% endfunc %}",

        'tmpl_tag' => '<<<tag>> <<strAttr>> />',
        'tmpl_tag_combine' => '<<<tag>> <<strAttr>> > <<content>></<<tag>>>',
        'tmpl_base' => "<<endfunc>><<func>>\n <<strTag>>\n <<endfunc>><<func_html>>",
        'tmpl_base_tag' => "<<endfunc>><<func>>\n <<strTag>>\n <<endfunc>><<func_html>>",
        'tmpl_input' => "<<endfunc>><<func>>\n <<strTag>> <<endfunc>><<func_html>>",
        'tmpl_attr' => ' <<attr>>="<<val>>"',
        // templates in format sprintf

        'tmpl_sprintf_file_head' => "\n<h1>Convert file: '%s'</h1>",
        'tmpl_sprintf_not_require_attr' => "Not require attribute  in file '%s' for tags '%s'['%s'], attribute '%s'<br>",
        'tmpl_sprintf_not_attr_in_struct' => "Not NameAttr in  tag structure ='%s' for attribute='%s'<br>",
        'tmpl_sprintf_error_write_to_file' =>"Error write to file: '%s'<br>",
        'tmpl_sprintf_error_open_file' =>"Error open file: '%s'<br>",
        'tmpl_sprintf_source_file' =>'/* source file: %s<br>',
//        'tmpl_textare' => "<<func>>\n <<strTag>> <<val>>",
    ];
    private $flagDataInFile = true;
    /**
     * @var string -root path (from relative folders)
     */
    private $rootPath = '/';
    /**
     * @var array required attributes for converted tags
     */

    private $dataNameAttr = array(
        'input' => array(
            'name'=>'Nameinput',
            'value'=>'Val',
            'title'=>'Title',
            'type'=>'Typeinput',
            'id'=>'Key',
            'placeholder'=>'Placeholder',
        ),

        'checkbox' => array(
            'name'=>'Name',
            'value'=>'Val',
            'title'=>'Title',
            'type'=>'Typeinput',
            'id'=>'Key',
        ),
        'textarea' => array(
            'name'=>'Name',
            'value'=>'Val',
            'title'=>'Title',
            'type'=>'Typeinput',
            'id'=>'Key',
        ),
    );
    private $requiredAttr = array(
        'input' => array(
            'name',
            'value',
            'title',
            'placeholder',
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
            'name' => '{%s Data.Inputs[<<ind>>].Nameinput %}',
            'value' => '{%s Data.Inputs[<<ind>>].Val %}',
            'placeholder' => '{%s Data.Inputs[<<ind>>].Title%}',
//            'placeholder' => '{%s DataInputs[<<ind>>].Placeholder%}',
            'typeinput' => '{%s DataInputs[<<ind>>].typeinput%}',
            'title' => '{%s Data.Inputs[<<ind>>].Title%}',
            'type' => '{%s Data.Inputs[<<ind>>].Typeattr%}',
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
            'name' => '{%s Data.Checkboxs[<<ind>>].Name %}',
            'value' => '{%s Data.Checkboxs[<<ind>>].Val %}',
            'checked' => '{%s Data.Checkboxs[<<ind>>].Checked %}',
//            'id' => '{%s Data.Checkboxs[<<ind>>].Ket %}'
            'id' => '{%s Data.Checkboxs[<<ind>>].Key %}',
//            'title' => '{%s Data.Checkboxs[<<ind>>].title%}',
        ),
        'textarea' => array(
            'name' => '{%s Data.Textareas[<<ind>>].Name %}',
            'value' => '{%s Data.Textareas[<<ind>>].Val %}',
            'placeholder' => '{%s Data.Textareas[<<ind>>].Placeholder %}',
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
        $counter = 0;
        foreach ($filelist as $fileName) {

            if (preg_match('/.+\.' . $this->sourceExt . '$/', $fileName)) {
                $counter++;
                printf($this->getTemplate('tmpl_sprintf_file_head'), $fileName);
                $this->convertFile($fileName);
                if ($counter === 1){

                    $dataStruct = $this->getTemplate('go_struct');
                    $this->writeToFile($this->rootPath . $this->outputPath, $this->fileGoStruct, $this->dataExt, $dataStruct);
                }
            }

        }

//        return $this->render('index');
    }

    /**
     * @param $filename
     * Method for converted one file
     */
    private function convertFile($filename)
    {
        $result = true;
        if (!empty($this->dataTags)) {
            $this->resetObject($this->dataTags);
        }

        $file_source_path = $this->rootPath . $this->sourcePath . '/' . $filename;

        if (file_exists($file_source_path)) {


            $fileContent = file_get_contents($file_source_path);
            $fileContent = $this->removeBOM($fileContent);

            $this->fileNameCur =  $this->getNameForQtpl($filename);
            $dataQtpl = $this->clearContent($fileContent);
            $dataQtpl = $this->convertTags($dataQtpl);
            $dataQtpl = trim($dataQtpl);
            $qtplBegin = sprintf($this->getTemplate('tmpl_sprintf_source_file'), $file_source_path );
            $qoDataBegin = '';
//            $qoDataBegin .=
            $qoDataBegin .= $this->getTemplate('code');

            $endfunc = $this->getTemplate('endfunc');
            $qtplBegin .= $this->getTemplateParam('func_html',['filenameBrief'=>ucfirst($this->fileNameCur)]);
            if (!empty((array)$this->dataTags)) {

//                $dataFile = json_encode($this->dataTags);
////                $func = $this->getTemplate('func_form');
////                $dataQtpl = $this->getTemplateParam('tmpl_base', ['func'=>$func, 'strTag'=>$dataQtpl, 'endfunc'=>$endfunc] );
                if ($this->flagDataInFile) {


                    $qoDataBegin .= $this->getStrConvertDataTags();
                    // запись данных для формы в файл
                    $this->writeToFile($this->rootPath . $this->outputPath, $this->fileNameCur, $this->dataExt, $qoDataBegin);


                }
//                if ($this->flagDataInQtpl) {
//                    $dataQtpl = '<!--' . $dataFile . "-->\n" . $dataQtpl;
//                }
//;

            }


            $dataQtpl = $qtplBegin . $dataQtpl . $endfunc;

            // запись данных для формы в файл
            $this->writeToFile($this->rootPath . $this->outputPath, $this->fileNameCur, $this->outputExt, $dataQtpl);


        } else {
            printf( $this->getTemplate('tmpl_sprintf_error_open_file') , $file_source_path );
        }
        return $result;
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
            $value = $this->replEmpty($value);

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
                    $strAttr .= $this->getStrTmplAttribute('tmpl_attr', $templateName, $require, $ind);
                    printf($this->getTemplate('tmpl_sprintf_not_require_attr'),
                        $this->fileNameCur,$templateName, $ind, $require);

                    $attributes[$require] = "";
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
        $this->dataTags->$templateNames[] = $this->saveData($attributes, $templateName);
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
//        $attrName = $this->getAttrName($templateName, $attribute);
        $result = $this->getTemplateParam($templateBase,
                                        array('attr' => $attribute, 'val' => $strConvert));
        return $result;
    }

    private function getAttrName($attribute, $templateName){
        $result = '';
        if (!isset($this->dataNameAttr[$templateName][$attribute])){
            printf($this->getTemplate('tmpl_sprintf_not_attr_in_struct'),
                $templateName, $attribute);
            $result = $attribute;
        } else{
            $result = $this->dataNameAttr[$templateName][$attribute];
        }

        return $result;
    }

    private function saveData($attributes, $templateName){
        $result =[];
        foreach ($attributes as $attribute=>$value){
            $attrName = $this->getAttrName($attribute, $templateName);
            $result[$attrName] = $this->replEmpty($value);
        }
        return $result;
    }
/*
 *         'data_beg' =>'{% code
             data := DataHtml{',
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
        $result =$this->getTemplateParam('data_beg', ['filenameBrief'=>ucfirst($this->fileNameCur)]);
            foreach ($this->dataTags as $tag=>$arr){
                $result .=$this->getTemplateParam('tag_struct_beg',['tag'=>ucfirst($tag)]);
                foreach ($arr as $datatag){
                    $strAttrs='';
                    foreach ($datatag as $attr=>$val){
                        $strAttrs .= $this->getTemplateParam('tag_struct_str_attrs',['attr'=>$attr,'val'=>$val]);
                    }
                    $result .= $this->getTemplateParam('tag_struct_line',['tag'=>ucfirst($tag), 'strAttrs' =>$strAttrs]);
                }
                $result .= $this->getTemplate('tag_struct_end');
            }
        $result .= $this->getTemplate('data_end');
        return $result;
    }

    private function replEmpty($str){
        $search =[
            "\n"
        ];
        $replace = [
          '\n'
        ];
        $result = str_replace($search, $replace, $str);

        return $result;
    }

    private function writeToFile($path, $filename, $fileExt, $data){
        $result =true;
        $fileFullName = $path . '/' . $filename . '.' . $fileExt;
        if (file_put_contents($fileFullName, $data)) {
            chmod($fileFullName, 0777);
        } else {
            $result =false;
            printf( $this->getTemplate('tmpl_sprintf_error_write_to_file') , $fileFullName );
        };
        return $result;
    }

    private function getNameForQtpl($filename){
        $result = str_replace('.' . $this->sourceExt, '', $filename);

        $patterns = [
            "/[-]/",
            "/[А-Яа-я ]/"

        ];
        $replacements = ["_",
            "_"
        ];

        $result =  preg_replace($patterns, $replacements, $result);
        print_r("$result\n<br>");
        return $result;
    }
}
