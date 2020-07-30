<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Jane\OpenApi2\JsonSchema\Model;

class Response extends \ArrayObject
{
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var Schema|FileSchema|null
     */
    protected $schema;
    /**
     * @var Header[]|null
     */
    protected $headers;
    /**
     * @var mixed[]|null
     */
    protected $examples;

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Schema|FileSchema|null
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param Schema|FileSchema|null $schema
     *
     * @return self
     */
    public function setSchema($schema): self
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * @return Header[]|null
     */
    public function getHeaders(): ?iterable
    {
        return $this->headers;
    }

    /**
     * @param Header[]|null $headers
     *
     * @return self
     */
    public function setHeaders(?iterable $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return mixed[]|null
     */
    public function getExamples(): ?iterable
    {
        return $this->examples;
    }

    /**
     * @param mixed[]|null $examples
     *
     * @return self
     */
    public function setExamples(?iterable $examples): self
    {
        $this->examples = $examples;

        return $this;
    }
}
