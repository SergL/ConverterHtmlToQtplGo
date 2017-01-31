# ConverterHtmlToQtplGo
Techology:Yii 2


Start convert 
<site>/templater/create/

Default config
<pre>
class TemplaterController extends Controller
{ /**
      * @var string -  relative path prototype files
      */
  private $sourcePath = '/data/scr';>
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
    private $flagDataInQtpl = true;
</pre>
