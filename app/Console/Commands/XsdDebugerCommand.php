<?php

namespace App\Console\Commands;

use App\Classes\Import\Exceptions\NotSupportedSportException;
use App\Classes\Import\Exceptions\WrongFileFormatException;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Illuminate\Console\Command;
use Storage;
use XMLReader;
use Illuminate\Support\Facades\Log;

class XsdDebugerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xsd:debuger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created for debugging xsd files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = Storage::disk('failedXml')->files();
        $sports =  ['bsgame', 'fbgame', 'bbgame', 'sogame', 'hkgame', 'vbgame','lcgame'];
        if(!empty($files)) {
            foreach ($files as $file) {
                $this->info('XML FILE:      '.$file);

                $file_d = Storage::disk('failedXml')->path($file);

                $xml = simplexml_load_file($file_d, 'SimpleXMLElement', LIBXML_COMPACT);

                $sport = $xml->getName();

                $xsd_exist = Storage::disk('xsd')->exists(sprintf('%s.xsd', $sport));

                if (!$xsd_exist) {
                    $this->error(sprintf('XSD file %s.xsd not found.', $sport));
                }

                $xsdFile = Storage::disk('xsd')->get(sprintf('%s.xsd', $sport));
                $xsdpath = Storage::disk('xsd')->path(sprintf('%s.xsd', $sport));
                $this->info('XSD FILE:      '.$xsdpath);
                /* Check if file has right sport tag */
                libxml_use_internal_errors(true);

                $reader = new XMLReader();
                $reader->open($file_d);

                $reader->setParserProperty(XMLReader::VALIDATE, true);

                //validating xml
                if (!$reader->isValid()) {
                    $errors = $this->getXMLErrorsString($file);
                   $this->error('File format is not valid XML');
                }

                //validating with xsd
                $xml = new DOMDocument();
                $xml->load($file_d);

                if (!$xsdFile) {
                    $this->error('You must provide a XSD file is missed.');
                }

                if (!$xml->schemaValidateSource($xsdFile)) {
                    $this->getXMLErrorsString($file);
                    $this->error('File format is not correct. XSD validate failed. ');
                }
            }
        }
    }

    public function log($tag, $filename, $errors)
    {
        $result = Log::channel('xsdlog')->info(sprintf("[%s][%s]:%s ", $tag, $filename, $errors));
        return $result;
    }

    public function getXMLErrorsString($filename)
    {
        $errorsString = '';
        $errors = libxml_get_errors();
        foreach ($errors as $key => $error) {
            $time = Carbon::now();
            $level = $error->level === LIBXML_ERR_WARNING ? 'Warning' : $error->level === LIBXML_ERR_ERROR ? 'Error' : 'Fatal';
            $errorsString .= sprintf("[%s] - [%s] [%s]  %s", $time , $level, $filename , $error->message);
        }
        $this->error($errorsString);
        return $errorsString;
    }
}
