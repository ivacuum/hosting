<?php namespace App\Utilities;

class MetricsHelper
{
    protected $fp;
    protected $metrics;

    public function __construct()
    {
        $address = config('cfg.metrics_address');

        if ($address) {
            $this->fp = fsockopen($address);
        }
    }

    public function export()
    {
        if (empty($this->metrics)) {
            return false;
        }

        if (\App::environment('local')) {
            foreach ($this->metrics as $metric) {
                \Log::debug(json_encode($metric));
            }
        }

        if (is_null($this->fp)) {
            return false;
        }

        fwrite($this->fp, json_encode($this->metrics));
        fclose($this->fp);

        return true;
    }

    public function push(array $data)
    {
        $this->metrics[] = $data;
    }
}
