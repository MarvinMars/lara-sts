<?php

namespace App\Classes\Import\Classes;

use App\Classes\Import\Exceptions\IsNotGameFileException;
use App\Classes\Import\Exceptions\NotSupportedSportException;
use App\Classes\Import\Exceptions\WrongFileFormatException;
use App\Jobs\StoreImportLogJob;
use App\Models\Import;
use App\Models\Sport;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Mail;
use Parser;
use SimpleXMLElement;
use Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use XMLReader;

/**
 * Class AbstractImport
 * @package App\Classes\Import\Classes
 */
abstract class AbstractImport
{
    /**
     * @var Import
     */
    protected $import;
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $xml;
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $data;
    protected $row = [];

    protected $allowed_team_id;

    protected $output;

    protected $filePath;

    private $logs;

    /**
     * AbstractImport constructor.
     *
     * @param Import $import
     *
     * @internal param $file
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
        $this->xml = collect();
        $this->data = collect();
        $this->logs = collect();
        $this->output = new ConsoleOutput();
        $this->allowed_team_id = $this->getTeamIds();
    }

    /**
     * @param $filePath
     *
     * @return $this
     * @throws \App\Classes\Import\Exceptions\WrongFileFormatException
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Nathanmac\Utilities\Parser\Facades\Exceptions\ParserException
     * @throws \App\Classes\Import\Exceptions\IsNotGameFileException
     * @throws \App\Classes\Import\Exceptions\NotSupportedSportException
     */
    public function setFile($filePath)
    {
        $this->filePath = $filePath;
        $this->xml = collect();

        $fileContent = Storage::disk('import')->get($filePath);

        $this->checkFileContent($fileContent);

        $xml = Parser::xml($fileContent);

        $this->xml = collect($xml);

        return $this;
    }

    /**
     * Converting all available team ids to the array.
     *
     * @return mixed
     */
    private function getTeamIds(): array
    {
        $env_string = (string)config('stats.team_ids', '');
        $env_array = explode(',', $env_string);

        if (count($env_array) > 0) {
            foreach ($env_array as $key => $item) {
                if (!empty ($item)) {
                    $env_array[$key] = trim($item);
                } else {
                    unset($env_array[$key]);
                }
            }
            return $env_array ?: [];
        }


        return [];
    }

    /**
     * Return all items in the array
     * @return mixed
     */
    public function all()
    {
        return collect($this->row);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    protected function _parseAttribute($name)
    {
        return strtolower(str_replace(['@'], [''], $name));
    }

    /**
     * Send message to admin about any problems.
     *
     * @param string $title
     * @param array $data
     *
     *
     */
    protected final function notify(string $title, array $data = []): void
    {
        $adminEmail = config('stats.admin_email');

        if ($adminEmail) {
            Mail::send('emails.import.notify', ['data' => $data, 'import' => $this->import],
                function ($m) use ($title, $adminEmail) {
                    $m->from('robot@webmetech.com', 'Stats system Messaging');
                    $m->to($adminEmail)
                        ->subject($title ?? 'Message from stats system');
                });
        }
    }

    /**
     * Store import logs to the database.
     *
     * @param $content
     * @param string $type
     */
    protected final function log(string $content, string $type = 'info')
    {
        $this->output->writeln(sprintf('<%1$s>%2$s</%1$s>', $type, $content));

        $this->logs->push([
            'import_id' => $this->import->id,
            'type' => $type,
            'content' => $content,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        if ($this->logs->count() >= 500) {
            dispatch(new StoreImportLogJob($this->import, $this->logs));
            $this->logs = collect();
        }
    }

    /**
     * Check file content for correct data.
     *
     * @param $fileContent
     *
     * @throws \App\Classes\Import\Exceptions\WrongFileFormatException
     * @throws \App\Classes\Import\Exceptions\IsNotGameFileException
     * @throws \App\Classes\Import\Exceptions\NotSupportedSportException
     */
    private function checkFileContent($fileContent): void
    {
        $expectedDefinition = array_get(Sport::$gameFileDefinitions, $this->import->sport->type);

        if (!$expectedDefinition) {
            throw new NotSupportedSportException($this->import->sport->type);
        }

        $xml = null;

        try {
            $xml = new SimpleXMLElement($fileContent);
        } catch (Exception $e) {
            throw new WrongFileFormatException($this->filePath);
        }

        if ($xml instanceof SimpleXMLElement) {
            if ($xml->getName() !== $expectedDefinition) {
                throw new IsNotGameFileException($this->filePath, $expectedDefinition, $xml->getName());
            }
        }
    }

    public function __destruct()
    {
        if ($this->logs->isNotEmpty()) {
            dispatch(new StoreImportLogJob($this->import, $this->logs));
            $this->logs = collect();
        }
    }


}
