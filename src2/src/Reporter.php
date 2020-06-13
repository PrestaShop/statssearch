<?php


namespace PrestaShop\HeaderStamp;

/**
 * Reporter in charge of reporting what HeaderStamp has done
 */
class Reporter
{
    private $report = [
        'fixed' => [],
        'ignored' => [],
        'failed' => [],
    ];

    public function reportLicenseHasBeenFixed($fixedFilename)
    {
        $this->report['fixed'][] = $fixedFilename;
    }

    public function reportLicenseWasFine($fixedFilename)
    {
        $this->report['nothing to fix'][] = $fixedFilename;
    }

    public function reportLicenseCouldNotBeFixed($fixedFilename)
    {
        $this->report['failed'][] = $fixedFilename;
    }

    /**
     * @return array[]
     */
    public function getReport()
    {
        return $this->report;
    }
}
