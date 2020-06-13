<?php


namespace PrestaShop\HeaderStamp;

/**
 * Class responsible of loading license file in memory and returning its content
 */
class LicenseHeader
{
    /**
     * Header content
     *
     * @param string $content
     */
    private $content;

    /**
     * Path to the file
     *
     * @param string $filePath
     */
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return string Getter for Header content
     */
    public function getContent()
    {
        if (null === $this->content) {
            $this->loadFile();
        }

        return $this->content;
    }

    /**
     * Checks the file and loads its content in memory
     */
    private function loadFile()
    {
        if (!\file_exists($this->filePath)) {
            // If the file is not found, we might have a relative path
            // We check this before throwing any exception
            $fromRelativeFilePath = getcwd() . '/' . $this->filePath;
            $fromSrcFolderFilePath = __DIR__ . '/../' . $this->filePath;

            if (\file_exists($fromRelativeFilePath)) {
                $this->filePath = $fromRelativeFilePath;
            } elseif (\file_exists($fromSrcFolderFilePath)) {
                $this->filePath = $fromSrcFolderFilePath;
            } else {
                throw new \Exception('File ' . $this->filePath . ' does not exist.');
            }
        }

        if (!\is_readable($this->filePath)) {
            throw new \Exception('File ' . $this->filePath . ' cannot be read.');
        }

        $this->content = \file_get_contents($this->filePath);
    }
}
