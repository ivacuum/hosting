<?php namespace App\Utilities;

class MetricsHelper
{
    protected $fp = null;
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
        if (empty($this->metrics) || is_null($this->fp)) {
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
