<?php

namespace App\Console\Commands;

abstract class Command extends \Illuminate\Console\Command
{
    protected $dateFormat = 'Y-m-d H:i:s';

    public function comment($string, $verbosity = null)
    {
        $this->line(
            sprintf('[%s] <comment>%s</comment>', date($this->dateFormat), $this->replaceSpaces($string)),
            null,
            $verbosity
        );
    }

    public function error($string, $verbosity = null)
    {
        $this->line(
            sprintf('[%s] <error>%s</error>', date($this->dateFormat), $this->replaceSpaces($string)),
            null,
            $verbosity
        );
    }

    public function info($string, $verbosity = null)
    {
        $this->line(
            sprintf('[%s] <info>%s</info>', date($this->dateFormat), $this->replaceSpaces($string)),
            null,
            $verbosity
        );
    }

    public function question($string, $verbosity = null)
    {
        $this->line(
            sprintf('[%s] <question>%s</question>', date($this->dateFormat), $this->replaceSpaces($string)),
            null,
            $verbosity
        );
    }

    protected function replaceSpaces(string $string): string
    {
        return str_replace('&thinsp;', ' ', $string);
    }
}
