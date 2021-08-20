<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2021 Amasty (https://www.amasty.com)
 * @package Amasty_ExportPro
 */


namespace Amasty\ExportPro\Export\FileDestination\Type\SftpFile;

interface ConfigInterface
{
    /**
     * @return string|null
     */
    public function getHost(): ?string;

    /**
     * @param string|null $host
     *
     * @return \Amasty\ExportPro\Export\FileDestination\Type\SftpFile\ConfigInterface
     */
    public function setHost(?string $host): ConfigInterface;

    /**
     * @return string|null
     */
    public function getUser(): ?string;

    /**
     * @param string|null $user
     *
     * @return \Amasty\ExportPro\Export\FileDestination\Type\SftpFile\ConfigInterface
     */
    public function setUser(?string $user): ConfigInterface;

    /**
     * @return string|null
     */
    public function getPassword(): ?string;

    /**
     * @param string|null $password
     *
     * @return \Amasty\ExportPro\Export\FileDestination\Type\SftpFile\ConfigInterface
     */
    public function setPassword(?string $password): ConfigInterface;

    /**
     * @return string|null
     */
    public function getPath(): ?string;

    /**
     * @param string|null $path
     *
     * @return \Amasty\ExportPro\Export\FileDestination\Type\SftpFile\ConfigInterface
     */
    public function setPath(?string $path): ConfigInterface;

    /**
     * @return string|null
     */
    public function getFilename(): ?string;

    /**
     * @param string|null $filename
     *
     * @return \Amasty\ExportPro\Export\FileDestination\Type\SftpFile\ConfigInterface
     */
    public function setFilename(?string $filename): ConfigInterface;
}
