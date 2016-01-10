<?php

namespace App\Console\Commands;

use Illuminate\Console\Command as BaseCommand;

class Command extends BaseCommand
{
    protected $date_format = 'Y-m-d H:i:s';

    public function comment($string, $verbosity = null)
    {
        $this->output->writeln(sprintf('<comment>[%s] %s</comment>', date($this->date_format), $string));
    }

    public function error($string, $verbosity = null)
    {
        $this->output->writeln(sprintf('<error>[%s] %s</error>', date($this->date_format), $string));
    }

    public function info($string, $verbosity = null)
    {
        $this->output->writeln(sprintf('<info>[%s] %s</info>', date($this->date_format), $string));
    }

    public function line($string, $style = null, $verbosity = null)
    {
        $this->output->writeln(sprintf('[%s] %s', date($this->date_format), $string));
    }
}
