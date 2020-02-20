<?php

namespace App\Rules;


use App\Models\Sport;
use SimpleXMLElement;
use Illuminate\Contracts\Validation\Rule;
use App\Classes\Import\Exceptions\NotSupportedSportException;
use App\Classes\Import\Exceptions\IsNotGameFileException;
use App\Classes\Import\Exceptions\MissingTeamException;
use App\Classes\Import\Exceptions\WrongFileFormatException;

class XMLStatsValidation implements Rule
{

    public $message = 'is not valid';
    public $fileName;
    public $sport;
    public $expectedDefinition;
    /**
     * A rule is created with a sports id for validation.
     *
     * @param  int  $g_id
     */

    public function __construct($g_id)
    {
        /* if the sport is not specified then we do not validate the file  */
        $this->sport = Sport::find($g_id);

        if( $this->sport ) {
            $this->expectedDefinition = array_get(Sport::$gameFileDefinitions, $this->sport->type);
        }
    }

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
        /* if the sport is not specified then we do not validate the file  */
        if( empty( $this->sport )) {
            $this->message = 'Sport not found';
            return false;
        }

        $this->fileName = $value->getClientOriginalName() ? $value->getClientOriginalName() : $attribute;

        try {
            /* Check if file is XML */
            if ( !$xml = simplexml_load_file( $value->getRealPath(),'SimpleXMLElement',LIBXML_COMPACT) ){
                throw new WrongFileFormatException($this->fileName);
            }
            /* Check if file has team section */
            if ( empty ( $xml->team ) || $xml->team->count() !== 2) {
                throw new MissingTeamException();
            }

            $type = $xml->getName();

            /* Check if file has sport tag */
            if (!$this->expectedDefinition) {
                throw new NotSupportedSportException($type);
            }
            /* Check if file has right sport tag */
            if ($type !== $this->expectedDefinition) {
                throw new IsNotGameFileException($this->sport->type, $this->expectedDefinition, $type);
            }

        } catch (WrongFileFormatException | NotSupportedSportException | IsNotGameFileException | MissingTeamException $e ) {
            $this->message = $e->getMessage();
            return false;
        }

        return true ;

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
}
