<?php

namespace App\Rules;

use DOMDocument;
use Illuminate\Contracts\Validation\Rule;
use App\Classes\Import\Exceptions\NotSupportedSportException;
use App\Classes\Import\Exceptions\WrongFileFormatException;
use Storage;
use XMLReader;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class XMLApiValidation implements Rule
{

    protected $message = 'is not valid';
    protected $fileName;
    protected $sport;
    protected $xmlFile;
    protected $xsdFile;
    protected $sports =  [
        'bsgame', 'fbgame', 'bbgame',
        'sogame', 'hkgame', 'vbgame',
        'lcgame',

        'bbseas', 'bsseasons', 'bsseas',
        'fbseas', 'soseas', 'hkseas',
        'vbseas','lcseas'
    ];

    /**
     * Determine if the validation rule passes.
     * Checked is XML, is sport type, is match sport type
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value instanceof UploadedFile){
            $this->fileName = $value->getClientOriginalName() ? $value->getClientOriginalName() : $attribute;
        } else {
            $this->fileName = pathinfo($value, PATHINFO_FILENAME).pathinfo($value, FILEINFO_EXTENSION);
        }

        try {
            /* Check if file is XML */
            if (!$xml = simplexml_load_file( $value->getRealPath(),'SimpleXMLElement',LIBXML_COMPACT) ) {
                throw new WrongFileFormatException($this->fileName);
            }

            $this->xmlFile = $value;
            $this->sport = $xml->getName();

            $localname = sprintf(
                'name_%s_sport_%s_gameid_%s_version_%s.xml',
                str_replace('.','_', $this->fileName),
                $this->sport,
                $xml->venue->attributes()->gameid ,
                str_replace('.','-', $xml->attributes()->version)
            );

            $xsd_exist = Storage::disk('xsd')->exists(sprintf('%s.xsd', $this->sport)) ;

            if (!$xsd_exist) {
                throw new Exception(sprintf('XSD file %s.xsd not found.', $this->sport));
            }

            $this->xsdFile = Storage::disk('xsd')->get(sprintf('%s.xsd', $this->sport)) ;

            /* Check if file has sport tag */

            if (!in_array( $this->sport,$this->sports)) {
                throw new NotSupportedSportException($this->sport);
            }
            /* Check if file has right sport tag */
            libxml_use_internal_errors(true);

            $reader = new XMLReader();
            $reader->open($this->xmlFile);

            $reader->setParserProperty(XMLReader::VALIDATE, true);

            //validating xml
            if (!$reader->isValid()) {
                $errors = $this->getXMLErrorsString();
                $copy = $this->putFile($this->xmlFile, $localname);
                if($copy) {
                    $this->log('XML', $localname, $errors);
                }else{
                    $this->log('XML', $this->fileName, $errors);
                }
                throw new Exception('File format is not valid XML');
            }

            //validating with xsd
            $xml = new DOMDocument();
            $xml->load($this->xmlFile);

            if (!$this->xsdFile) {
                throw new Exception('You must provide a XSD file is missed.');
            }

            if (!$xml->schemaValidateSource($this->xsdFile)) {
                $errors = $this->getXMLErrorsString();
                $copy = $this->putFile($this->xmlFile, $localname);
                if( $copy ) {
                    $this->log('XSD', $localname, $errors);
                }else{
                    $this->log('XSD', $this->fileName, $errors);
                }
                throw new Exception('File format is not correct. XSD validate failed. ');
            }

        } catch ( Exception | WrongFileFormatException | NotSupportedSportException  $e ) {
            $this->message = $e->getMessage();
            return false;
        }

        return true ;

    }

    public function getXMLErrorsString()
    {
        $errorsString = '';
        $errors = libxml_get_errors();
        foreach ($errors as $key => $error) {
            $time = Carbon::now();
            $level = $error->level === LIBXML_ERR_WARNING ? 'Warning' : $error->level === LIBXML_ERR_ERROR ? 'Error' : 'Fatal';
            $errorsString .= sprintf("[%s] - [%s] [%s]  %s", $time , $level,$this->fileName, $error->message);
        }
        return $errorsString;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return sprintf('[%s] %s', $this->fileName, $this->message);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function putFile($oldpath,$newpath)
    {
        $result = Storage::putFileAs('failedXml', $oldpath,$newpath);

        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function log($tag, $filename, $errors)
    {
        $result = Log::channel('xsdlog')->info(sprintf("[%s][%s]:%s ", $tag, $filename, $errors));
        return $result;
    }
}
